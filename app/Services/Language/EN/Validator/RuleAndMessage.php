<?php

namespace App\Services\Language\EN\Validator;

class RuleAndMessage
{
    public $validator =  [

        'users' => [
            'rules' => [
                'name' => 'required',
                'username' => 'required|unique:users',
                'email' => 'required|unique:users',
            ],
            'messages' => [
                'name.required' => ':attribute must be filled',
                'username.required' => ':attribute must be filled',
                'email.required' => ':attribute must be filled',
            ]
        ],

        'roles' => [
            'rules' => [
                'name' => 'required',
            ],
            'messages' => [
                'name.required' => ':attribute must be filled',
            ]
        ],

        'menus' => [
            'rules' => [
                'name' => 'required',
                'link' => 'required',
                'path' => 'required',
                'icon' => 'required',
            ],
            'messages' => [
                'name.required' => ':attribute must be filled',
                'link.required' => ':attribute must be filled',
                'path.required' => ':attribute must be filled',
                'icon.required' => ':attribute must be filled',
            ]
        ],
        'espresences' => [
            'rules' => [
                'type' => 'required',
                'date' => 'required',
                // 'path' => 'required',
                // 'icon' => 'required',
            ],
            'messages' => [
                'type.required' => ':attribute must be filled',
                'date.required' => ':attribute must be filled',
                //     'path.required' => ':attribute must be filled',
                //     'icon.required' => ':attribute must be filled',
            ]
        ],




    ];
}
