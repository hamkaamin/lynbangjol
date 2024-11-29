<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MajalahKategoriFormRequest extends FormRequest
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
            //
            'majalah_id' => 'required',
            'kategori_id' => 'required'
        ];
    }
}
