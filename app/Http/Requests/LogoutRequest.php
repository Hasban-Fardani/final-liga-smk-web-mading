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
        return auth()->check();
    }

    public function after(){
        return function(){
            // disable prevent back after logout
            $this->headers->set('Cache-Control','nocache, no-store, max-age=0, must-revalidate');
            $this->headers->set('Pragma','no-cache');
            $this->headers->set('Expires','Fri, 01 Jan 1990 00:00:00 GMT');
        };
    }
}
