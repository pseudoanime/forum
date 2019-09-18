<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class registerRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed'
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if (!$this->validateRecaptcha()) {
                $validator->errors()->add('recaptcha', 'Unable to verify humanness');
            }
        });
    }

    private function validateRecaptcha()
    {
        $url = 'https://www.google.com/recaptcha/api/siteverify';
        $curlVars = 'secret=' . env("RECAPTCHA_SECRET") . '&response=' . $this->input('g-recaptcha-response');

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $curlVars);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $response = curl_exec($ch);

        $response = json_decode($response);

        foreach ($response as $key => $item) {
            if ($key == "success" && $item == false) {
                return false;
            }
        }

        return true;
    }
}
