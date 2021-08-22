<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LanguageRequest extends FormRequest
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
        // Check Create or Update
        if ($this->method() == 'PATCH') {
            $this->_nameRules = 'unique:languages,name,' . $this->language->id;
            $this->_localeRules = 'unique:languages,locale,' . $this->language->id;
        }

        if ($this->method() == 'POST') {
            $this->_nameRules = 'unique:languages,name';
            $this->_localeRules = 'unique:languages,locale';
        }

        return [
            'name' => 'required|max:255|string|' . $this->_nameRules,
            'locale' => 'required|max:12|' . $this->_localeRules,
        ];
    }

}
