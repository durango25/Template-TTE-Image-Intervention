<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

use Laravel\Fortify\Rules\Password;

class R_TTE extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function passwordRules() {
        return ['required', 'string', (new Password)->length(6)->requireUppercase()->requireNumeric()];
    }

    public function rules(Request $request) {
        $form = $request->form;
        if ($form == 'add') {
			$conf_rules = [
                'name' => 'required|max:255',
                'nip' => 'required|max:18',
                'nik' => 'required|max:16',
                'position_institusion' => 'max:255',
            ];
        }
        elseif ($form == 'edit') {
			$conf_rules = [
                'name' => 'required|max:255',
                'nip' => 'required|max:18',
                'nik' => 'required|max:16',
                'position_institusion' => 'max:255',
            ];
        }
        return $conf_rules;
    }

    public function messages() {
        return [
            'required' => ':attribute mohon di isi !',
            'max' => ':attribute max :max karakter !',
        ];
    }

    public function attributes() {
        return [
            'name' => 'Nama',
            'nip' => 'NIP',
            'nik' => 'NIK',  
            'position_institusion' => 'Jabatan & Instansi',  
        ];
    }

}