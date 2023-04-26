<?php

namespace App\Http\Requests\Api\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateFormRequest extends FormRequest
{
    public static $postFields = [
        'name',
        'email',
        'message',
    ];

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
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'message' => ['required', 'string', 'max:255'],
        ];
    }

    public function data()
    {
        $postData = $this->all();

        foreach ($postData as $key => $item)
            if (!in_array($key, self::$postFields))
                unset($postData[$key]);

        return $postData;
    }
}