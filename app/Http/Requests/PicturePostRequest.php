<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PicturePostRequest extends FormRequest
{
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
			'name' => 'required',
            'file' => 'required|image|mimes:jpeg,png,jpg|max:2048' 
        ];
    }
	
	public function messages()
    {
        return [
            'name.required' => 'Поле Название картинки обязательно для заполнения',
            'file.required' => 'Пожалуйста, добавьте картинку',
            'file.mimes' => 'Неверный формат изображения',
            'file.image' => 'Неверный формат изображения',
            'file.max' => 'Размер файла не поддерживается'
        ];
    }
}
