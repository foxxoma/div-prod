<?php

namespace App\Http\Requests\Api\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnswerFormRequest extends FormRequest
{
    public static $postFields = [
        'id',
        'comment',
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
            'id' => ['required', 'exists:requests,id'],
            'comment' => ['required', 'string', 'max:255'],
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