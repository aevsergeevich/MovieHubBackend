<?php

namespace App\Http\Requests\V1Movie;

use Illuminate\Foundation\Http\FormRequest;

class IndexMovieRequest extends FormRequest
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
            'genres' => ['nullable', 'array'],
            'genres.*' => ['integer', 'exists:genres,id'],

            'date_from' => ['nullable', 'date'],
            'date_to' => ['nullable', 'date', 'after_or_equal:date_from'],

            'sort' => ['sometimes', 'string', 'in:id_asc,id_desc,title_asc,title_desc,release_date_asc,release_date_desc'],

            'perPage' => ['sometimes', 'integer', 'min:1', 'max:100'],
            'page' => ['sometimes', 'integer', 'min:1']
        ];
    }

    public function messages(): array
    {
        return [
            'genres.*.integer' => 'Каждый элемент genres должен быть числом',
            'genres.*.exists' => 'Указанный жанр не существует',

            'date_from.date' => 'Дата начала должна быть корректной датой',
            'date_to.date' => 'Дата конца должна быть корректной датой',
            'date_to.after_or_equal' => 'Дата конца должна быть равна или позже даты начала',

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
