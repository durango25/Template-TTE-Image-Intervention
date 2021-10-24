<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

use Laravel\Fortify\Rules\Password;

class R_User extends FormRequest {
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
                'email' => 'required|string|email|max:255|unique:tb_users',
                'name' => 'required|max:255',
                'phone_number' => 'required|max:15',
                'level' => 'required',
                'password' => $this->passwordRules(),
                'photo' => 'file|mimes:jpg,jpeg,png,gif|max:1024'
            ];
        }
        elseif ($form == 'edit') {
			$conf_rules = [
                'email' => 'required|string|email|max:255|'.Rule::unique('tb_users')->ignore($request->unique_old, 'email'),
                'name' => 'required|max:255',
                'phone_number' => 'required|max:15',
                'level' => 'required',
                'photo' => 'file|mimes:jpg,jpeg,png,gif|max:1024'
            ];
        }
        return $conf_rules;
    }

    public function messages() {
        return [
            'required' => ':attribute mohon di isi !',
            'string' => 'Type :attribute harus berupa string !',
            'email' => ':attribute tidak valid !',
            'max' => 'Max ukuran :attribute adalah :max kb !',
            'unique' => ':attribute sudah terdaftar, silahkan ganti dan ulangi !',
            'file' => ':attribute harus di isi melalui input type file !',
            'image' => 'Type :attribute harus berupa image !',
            'mimes' => 'Ekstensi yang diperbolehkan hanya : :values !',
            'photo.max' => 'Max ukuran :attribute adalah :max kb !',
        ];
    }

    public function attributes() {
        return [
            'email' => 'Email',
            'name' => 'Nama',
            'phone_number' => 'No. HP',
            'level' => 'Level',
            'photo' => 'Foto',  
            'password' => 'Password',
        ];
    }

}