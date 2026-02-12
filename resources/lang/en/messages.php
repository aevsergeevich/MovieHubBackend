<?php

return [
    'movies' => [
        'genres' => [
            '*' => [
                'integer' => 'Each genres item must be an integer',
                'exists' => 'The specified genre does not exist'
            ],
        ],

        'date_from' => [
            'date' => 'The start date must be a valid date'
        ],

        'date_to' => [
            'date' => 'The end date must be a valid date',
            'after_or_equal' => 'The end date must be equal to or later than the start date'
        ],
    ],

    'sort' => [
        'string' => 'The sort field must be a string',
        'in' => 'Invalid sort value. Available values: id_asc, id_desc,title_asc,title_desc,release_date_asc,release_date_desc'
    ],

    'perPage' => [
        'integer' => 'The perPage value must be an integer',
        'min' => 'The perPage value must be at least 1',
        'max' => 'The perPage value may not be greater than 100'
    ],

    'page' => [
        'integer' => 'The page number must be an integer',
        'min' => 'The page number must be at least 1'
    ]
];
