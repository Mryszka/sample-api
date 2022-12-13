<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest as ParentFromRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class FormRequest extends ParentFromRequest {
    
    public function failedValidation(Validator $validator)
    {
       throw new HttpResponseException(response()->json([
         'success'   => false,
         'message'   => 'Validation errors',
         'data'      => $validator->errors()
       ],400));
    }
}
