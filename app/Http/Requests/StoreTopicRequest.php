<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTopicRequest extends FormRequest {

    public function rules(): array
    {
        return [
            'name' => 'required|unique:topics,name',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

}
