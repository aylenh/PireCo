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
        $rules = array(
            'efectivo',
            'directo',
            'nombre' => 'required',
            'domicilio' => 'required',
            'telefono' => 'required',
            'horario_de' => 'required',
            'horario_hasta' => 'required',
            'total' => 'required'
        );
        if($this->directo == false){
            $rules['distribuidor_id'] = 'required';
        }

        if($this->efectivo == true){
            $rules['correo'] = 'required';
        }

        return $rules;
        
    }
}
