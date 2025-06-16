<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReservaTourRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'reserva_id' => 'required|exists:reservas,id',
            'tour_id' => 'required|exists:tours,id',
            'precio_final' => 'nullable|numeric|min:0',
            'fecha_salida' => 'nullable|date',
        ];
    }
}
