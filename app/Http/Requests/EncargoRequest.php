<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EncargoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nombre' => 'required',
            'domicilio' => 'required',
            'telefono' => 'required',
            'correo',
            'horario_de' => 'required',
            'horario_hasta' => 'required',
            'total' => 'required',
            'distribuidor_id' => 'required'
        ];
    }
}
