<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */
    'required' => 'Il campo :attribute è obbligatorio!',

    'exists' => 'Una o più :attribute selezionate non sono valide',

    'thumb' => [
        'image' => 'Il file :attribute deve essere un immagine valida.',

        'max' => [
            'file' => 'Il file :attribute non può essere più grande di :max Kb.',
        ],
    ],

    'min' => [
        'string' => 'Il campo :attribute deve contenere almeno :min caratteri.',
    ],

    'max' => [
        'string' => 'Il campo :attribute non deve contenere più di :max caratteri.',
    ],



    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        'title' => 'Titolo',
        'thumb' => 'Immagine',
        'description' => 'Descrizione',
        'content' => 'Contenuto',
        'project_url' =>  'Url del progetto',
        'git_url' =>  'Git Url del progetto',
        'name' => 'Nome',
        'technologies' => 'Tecnologie',
        'type_id' => 'Tipologie'
    ],

];
