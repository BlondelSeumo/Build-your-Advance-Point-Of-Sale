<?php

/**
 * This file implements Category Request.
 *
 * PHP version 7.2
 *
 * @category Class
 * @package  CategoryRequest
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
 * @package  CategoryRequest
 * @author   Rose-Finch <info.codehas@gmail.com>
 * @license  https://codecanyon.net/licenses/standard  Standard Licenses
 * @link     https://codecanyon.net/user/rose-finch
 */
class CategoryRequest extends FormRequest
{
    private $_nameRules = 'required';
    private $_codeRules = 'numeric';

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
            $this->_nameRules = 'unique:categories,name,' . $this->category->id;
            $this->_codeRules = 'unique:categories,code,' . $this->category->id;
        }

        if ($this->method() == 'POST') {
            $this->_nameRules = 'unique:categories,name';
            $this->_codeRules = 'unique:categories,code';
        }

        return [
            'name' => 'required|string|' . $this->_nameRules,
            'code' => $this->_codeRules,
            'detail' => 'required'
        ];
    }

}
