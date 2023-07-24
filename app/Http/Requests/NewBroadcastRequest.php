<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewBroadcastRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'content' => 'string',
            'auth_id' => 'int|exists:users,id',
            'partner_id' => 'int|exists:users,id',
            'category_id' => 'int|exists:categories,id'
        ];
    }
}
