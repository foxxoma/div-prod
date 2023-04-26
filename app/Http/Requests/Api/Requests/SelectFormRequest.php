<?php

namespace App\Http\Requests\Api\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SelectFormRequest extends FormRequest
{
    public static $postFields = [
        'page',
        'count',
        'sort',
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
        return [];
    }

    public function sortFields()
    {
        return [
            'id',
            'name',
            'email',
            'status',
            'message',
            'comment',
            'created_at',
            'updated_at',
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