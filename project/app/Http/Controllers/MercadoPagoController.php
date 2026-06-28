<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\Exceptions\MPApiException;
use App\Models\Participants;
use Exception;

use Illuminate\Support\Facades\Log;


class MercadoPagoController extends Controller

{

    public function createPaymentPreference(Request $request)
    {
        $this->authenticate();

        // Paso 1: Validar que los datos del formulario sean correctos
        $validated = $request->validate([
            'event_id' => 'required|integer',
            'full_name' => 'required|string|max:255',
            'dni' => 'required|string|max:20',
            'email' => 'required|string|email|max:255',
            'role' => 'required|in:profesor,alumno,oyente',
            'modality' => 'required|in:in_person,virtual',
            'payment_method' => 'required|in:mercado_pago,cash',
            'product' => 'required|array',
        ]);

        try {
            // Paso 2: Crear el participante pendiente en la base de datos
            $participant = Participants::create([
                'event_id' => $validated['event_id'],
                'full_name' => $validated['full_name'],
                'dni' => $validated['dni'],
                'email' => $validated['email'],
                'role' => $validated['role'],
                'modality' => $validated['modality'],
                'payment_method' => $validated['payment_method'],
                'payment_status' => 'pending',
                'registered_at' => now(),
            ]);

            Log::info('Participante pendiente creado', ['participant_id' => $participant->id]);

            // Paso 3: Información del comprador
            $payer = [
                "name" => explode(' ', $validated['full_name'])[0],
                "surname" => trim(str_replace(explode(' ', $validated['full_name'])[0], '', $validated['full_name'])),
                "email" => $validated['email'],
            ];

            // Paso 4: Crear la solicitud de preferencia 
            $baseUrl = config('app.url') ?: $request->getSchemeAndHttpHost();
            $requestData = $this->createPreferenceRequest(
                $request->input('product'), 
                $payer, 
                $baseUrl, 
                'participant_' . $participant->id
            );

            $client = new PreferenceClient();
            $preference = $client->create($requestData);

            Log::info('Preferencia creada en Mercado Pago', ['preference_id' => $preference->id, 'participant_id' => $participant->id]);

            return response()->json([
                'id' => $preference->id,
                'init_point' => $preference->init_point,
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validación fallida', $e->errors());
            return response()->json(['error' => 'Validación fallida', 'errors' => $e->errors()], 422);
        } catch (MPApiException $error) {
            Log::error('Error de Mercado Pago API', ['error' => $error->getMessage()]);
            $statusCode = $error->getApiResponse()->getStatusCode() ?: 500;
            return response()->json([
                'error' => 'Error al crear la preferencia en Mercado Pago',
                'details' => $error->getApiResponse()->getContent(),
            ], $statusCode);
        } catch (\Exception $e) {
            Log::error('Error inesperado al crear preferencia', ['error' => $e->getMessage()]);
            return response()->json([
                'error' => 'Error inesperado: ' . $e->getMessage(),
            ], 500);
        }
    }


    // Autenticación con Mercado Pago 
    protected function authenticate()
    {
        $mpAccessToken = config('services.mercadopago.access_token');
        if (!$mpAccessToken) {
            throw new Exception("El token de acceso de Mercado Pago no está configurado.");
        }
        MercadoPagoConfig::setAccessToken($mpAccessToken);
        MercadoPagoConfig::setRuntimeEnviroment(MercadoPagoConfig::SERVER);
    }

    // Función para crear la estructura de preferencia 
    protected function createPreferenceRequest($items, $payer, string $baseUrl, string $externalReference): array
    {
        return [
            "items" => $items,
            "payer" => $payer,
            "payment_methods" => [
                "excluded_payment_methods" => [],
                "excluded_payment_types" => [],
                "installments" => 12,
                "default_installments" => 1,
            ],
            "back_urls" => [
                'success' => $baseUrl . '/mercadopago/success',
                'failure' => $baseUrl . '/mercadopago/failed',
                'pending' => $baseUrl . '/mercadopago/pending',
            ],
            "notification_url" => $baseUrl . '/webhook/mercadopago',
            "auto_return" => "approved",
            "statement_descriptor" => "Jornadas SEDES",
            "external_reference" => $externalReference,
            "expires" => false,
        ];
    }


    public function success()
    {
        return view('mercadopago.success');
    }

    public function failed()
    {
        return view('mercadopago.failed');
    }

    public function pending()
    {
        return view('mercadopago.pending');
    }
}