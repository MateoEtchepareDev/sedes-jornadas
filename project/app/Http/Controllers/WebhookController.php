<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Client\Payment\PaymentClient;
use App\Models\Participants;
use Illuminate\Support\Facades\Log;

class WebhookController extends Controller
{
    /**
     * Webhook endpoint para notificaciones de Mercado Pago
     */
    public function handleMercadoPagoWebhook(Request $request)
    {
        Log::info('Webhook recibido de Mercado Pago', $request->all());

        // Validar que sea una notificación de pago
        $type = $request->input('type') ?: $request->query('topic') ?: $request->input('topic');
        if ($type !== 'payment' && $type !== 'payment.created' && $type !== 'payment.updated' && $type !== 'payment.refunded') {
            Log::info('Webhook ignorado - No es de tipo payment: ' . json_encode($type));
            return response()->json(['status' => 'ignored'], 200);
        }

        // Obtener el ID del pago de la notificación
        $paymentId = $request->input('data.id') ?: $request->input('id') ?: $request->query('id');
        if (!$paymentId) {
            Log::error('Webhook rechazado - Sin payment ID', ['payload' => $request->all()]);
            return response()->json(['error' => 'Payment ID not found'], 400);
        }

        try {
            // Configurar Mercado Pago
            $this->authenticate();

            // Obtener detalles del pago desde Mercado Pago
            $client = new PaymentClient();
            $payment = $client->get($paymentId);

            Log::info('Detalles del pago obtenidos', [
                'payment_id' => $payment->id,
                'status' => $payment->status,
                'external_reference' => $payment->external_reference
            ]);

            // Obtener el participant_id del external_reference
            $externalReference = $payment->external_reference;
            
            if (!$externalReference) {
                Log::error('Webhook - Sin external_reference en el pago', ['payment_id' => $paymentId]);
                return response()->json(['error' => 'External reference not found'], 400);
            }

            if (!str_starts_with($externalReference, 'participant_')) {
                Log::error('Webhook - external_reference no válido', ['external_reference' => $externalReference]);
                return response()->json(['error' => 'Invalid external reference'], 400);
            }

            $participantId = intval(str_replace('participant_', '', $externalReference));

            // Buscar el participante
            $participant = Participants::find($participantId);
            if (!$participant) {
                Log::error('Participante no encontrado', ['participant_id' => $participantId]);
                return response()->json(['error' => 'Participant not found'], 404);
            }

            // Mapear estados de Mercado Pago a nuestros estados
            $paymentStatus = $this->mapPaymentStatus($payment->status);

            $participant->update([
                'payment_status' => $paymentStatus,
                'payment_external_id' => $payment->id,
                'paid_at' => $paymentStatus === 'approved' ? now() : null,
            ]);

            Log::info('Participante actualizado', [
                'participant_id' => $participantId,
                'payment_status' => $paymentStatus,
                'payment_external_id' => $payment->id
            ]);

            if ($paymentStatus === 'approved') {
                $this->sendPaymentApprovedEmail($participant);
            }

            return response()->json(['status' => 'success'], 200);

        } catch (\Exception $e) {
            Log::error('Error procesando webhook de Mercado Pago', [
                'error' => $e->getMessage(),
                'payment_id' => $paymentId
            ]);
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Mapear estados de Mercado Pago a estados de nuestra aplicación
     */
    protected function mapPaymentStatus(string $mpStatus): string
    {
        $statusMap = [
            'pending' => 'pending',
            'approved' => 'approved',
            'authorized' => 'approved',
            'in_process' => 'pending',
            'in_mediation' => 'pending',
            'rejected' => 'rejected',
            'cancelled' => 'cancelled',
            'refunded' => 'refunded',
            'charged_back' => 'charged_back',
        ];

        return $statusMap[$mpStatus] ?? 'pending';
    }

    /**
     * Autenticarse con Mercado Pago
     */
    protected function authenticate()
    {
        $mpAccessToken = config('services.mercadopago.access_token');
        if (!$mpAccessToken) {
            throw new \Exception("El token de acceso de Mercado Pago no está configurado.");
        }
        MercadoPagoConfig::setAccessToken($mpAccessToken);
        MercadoPagoConfig::setRuntimeEnviroment(MercadoPagoConfig::SERVER);
    }

    /**
     * Enviar email de confirmación de pago
     */
    protected function sendPaymentApprovedEmail(Participants $participant)
    {
        try {
            \Mail::to($participant->email)->send(
                new \App\Mail\FormularioMail($participant->full_name)
            );
            Log::info('Email de confirmación enviado', ['participant_id' => $participant->id]);
        } catch (\Exception $e) {
            Log::error('Error enviando email de confirmación', [
                'participant_id' => $participant->id,
                'error' => $e->getMessage()
            ]);
        }
    }
}
