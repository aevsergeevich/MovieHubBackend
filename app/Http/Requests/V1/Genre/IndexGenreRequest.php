<?php

namespace App\Http\Requests\V1\Genre;

use Illuminate\Foundation\Http\FormRequest;

class IndexGenreRequest extends FormRequest
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
            'sort' => ['sometimes', 'string', 'in:id_asc,id_desc'],
            'perPage' => ['sometimes', 'integer', 'min:1', 'max:100'],
            'page' => ['sometimes', 'integer', 'min:1']
        ];
    }

    public function messages(): array
    {
        return [
            'sort.string' => 'Поле сортировки должно быть строкой',
            'sort.in' => 'Недопустимое значение сортировки. Доступные значения: id_asc, id_desc',

            'perPage.integer' => 'Количество элементов на странице должно быть числом',
            'perPage.min' => 'Количество элементов на странице должно быть не меньше 1',
            'perPage.max' => 'Количество элементов на странице не должно превышать 100',

            'page.integer' => 'Номер страницы должен быть числом',
            'page.min' => 'Номер страницы должен быть не меньше 1'
        ];
    }
}
