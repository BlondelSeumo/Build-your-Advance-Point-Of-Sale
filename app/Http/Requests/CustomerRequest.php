<?php

/**
 * This file implements Customer Request.
 *
 * PHP version 7.2
 *
 * @category Class
 * @package  CustomerRequest
 * @author   Rose-Finch <info.codehas@gmail.com>
 * @license  https://codecanyon.net/licenses/standard  Standard Licenses
 * @link     https://codecanyon.net/user/rose-finch
 */

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * This class describes a category request.
 *
 * @category Class
 * @package  CustomerRequest
 * @author   Rose-Finch <info.codehas@gmail.com>
 * @license  https://codecanyon.net/licenses/standard  Standard Licenses
 * @link     https://codecanyon.net/user/rose-finch
 */
class CustomerRequest extends FormRequest
{
    private $_nameRules = 'required';
    private $_emailRules = 'required';
    private $_vatRules = 'required';
    /**
     * Authorization
     *
     * @return boolean
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Request Validation
     *
     * @return array
     */
    public function rules()
    {
        // Check Create or Update
        if ($this->method() == 'PATCH') {
            $this->_nameRules  = 'unique:customers,name,' . $this->customer->id;
            $this->_emailRules = 'unique:customers,email,' . $this->customer->id;
            $this->_vatRules   = 'unique:customers,vat,' . $this->customer->id;
        }

        if ($this->method() == 'POST') {
            $this->_nameRules   = 'unique:customers,name';
            $this->_emailRules  = 'unique:customers,email';
            $this->_vatRules    = 'unique:customers,vat';
        }

        return [
            'name'          => 'required|string|max:35|' . $this->_nameRules,
            'email'         => 'required|email|' . $this->_emailRules,
            'phone'         => 'required|max:30',
            'vat'           => 'required|max:30|' . $this->_vatRules,
            'address'       => 'required|max:255',
        ];
    }
}
