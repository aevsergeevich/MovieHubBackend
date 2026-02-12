<?php

namespace App\Http\Requests\V1\Movie;

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
            'genres.*.integer' => __('responses.movies.genres.*.integer'),
            'genres.*.exists' => __('responses.movies.genres.*.exists'),

            'date_from.date' => __('responses.movies.date_from.date'),
            'date_to.date' => __('responses.movies.date_to.date'),
            'date_to.after_or_equal' => __('responses.movies.date_to.after_or_equal'),

            'sort.string' => __('responses.sort.string'),
            'sort.in' => __('responses.sort.in'),

            'perPage.integer' => __('responses.perPage.integer'),
            'perPage.min' => __('responses.perPage.min'),
            'perPage.max' => __('responses.perPage.max'),

            'page.integer' => __('responses.page.integer'),
            'page.min' => __('responses.page.min')
        ];
    }

}
