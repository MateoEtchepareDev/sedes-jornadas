<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\Events;

class RegisterParticipantRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'event_id' => 'required|exists:events,id',
            'full_name' => 'required|string|max:255',
            'dni' => 'required|string|max:20',
            'modality' => 'required|in:virtual,in_person',
            'email' => 'required|email',
        ];
    }

    public function withValidator($validator){
        $validator->after (function ($validator) {
            $evente = Events::find($this->event_id); 
            if (!$event){
                return;
            } //ver si hay cupos disponibles
          if ($event->participants()->count() >= $event->max_participants){
            $validator->errors()->add(
                'event_id',
                'no hay cupos disponibles para este evento'
            );
          }
           if (
            now()->lt($event->registration_opens_at) ||
            now()->gt($event->registration_closes_at)
        ) {
            //fechas de inscripcion
            $validator->errors()->add(
                'event_id',
                'Las inscripciones para este evento no están disponibles.'
            );
        }   

        $alredyRegistered = $event->participants()
            ->where('email', $this->email)
            ->exists(); 

        if ($alredyRegistered){
            $validator -> errors() -> add(
                'email',
                'Este email ya está registrado para este evento.'
            );
        }
    });
    }
}   
