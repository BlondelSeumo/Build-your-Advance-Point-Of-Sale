<?php

/**
 * This file implements Supplier Request.
 *
 * PHP version 7.2
 *
 * @category Class
 * @package  SupplierRequest
 * @author   Rose-Finch <info.codehas@gmail.com>
 * @license  https://codecanyon.net/licenses/standard  Standard Licenses
 * @link     https://codecanyon.net/user/rose-finch
 */

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * This class describes a supplier request.
 *
 * @category Class
 * @package  SupplierRequest
 * @author   Rose-Finch <info.codehas@gmail.com>
 * @license  https://codecanyon.net/licenses/standard  Standard Licenses
 * @link     https://codecanyon.net/user/rose-finch
 */
class SupplierRequest extends FormRequest
{
    private $_vatRules = 'required';
    private $_emailRules = 'required';
    /**
     Determine if the user is authorized to make this request.

     @return bool
     */
    public function authorize()
    {
        return true;
    }
    /**
     Get the validation rules that apply to the request.

     @return array
     */
    public function rules()
    {
        // Check Create or Update
        if ($this->method() == 'PATCH') {
            $this->_vatRules  = 'unique:suppliers,vat,' . $this->supplier->id;
            $this->_emailRules = 'unique:suppliers,email,' . $this->supplier->id;
        }
        if ($this->method() == 'POST') {
            $this->_vatRules  = 'unique:suppliers,vat';
            $this->_emailRules = 'unique:suppliers,email';
        }

        return [
            'name'          => 'required|max:35',
            'email'         => 'required|email|' . $this->_emailRules,
            'company'       => 'required',
            'phone'         => 'required|max:30',
            'address'       => 'required|max:500',
            'vat'           => 'required|' . $this->_vatRules,
        ];
    }

}
