<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProsesRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $this->redirect = url()->previous();
        return [
            'pengirim_id' => 'required',
            'asal_id' => 'required',
            'tujuan_id' => 'required',
            'no_hp' => 'required',
            'ket' => 'required',
            'supir_id' => 'required',
            'mobil_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Field ini perlu di isi',
        ];
    }
}
