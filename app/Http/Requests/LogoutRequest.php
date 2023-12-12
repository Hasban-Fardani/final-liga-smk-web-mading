<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LogoutRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function after(){
        return function(){
            header_remove('Cache-Control');
            header_remove('Pragma');
            header_remove('Expires');
        };
    }
}
