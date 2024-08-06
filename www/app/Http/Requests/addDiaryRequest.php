<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class addDiaryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'emotion_point' => 'required|numeric|between:0,10',
            'content' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'emotion_point.required' => '感情ポイント選択欄は必須です。',
            'content.required' => 'メールアドレスは必須です。',
            'emotion_point.numeric' => '数値を選んでください。',
            'emotion_point.between' => '0から10まで数値を選んでください。',
        ];
    }
}
