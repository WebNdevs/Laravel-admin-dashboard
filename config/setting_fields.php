<?php

return [
    /*'app' => [
        'title' => 'General',
        'desc' => 'All the general settings for application.',
        'icon' => 'fas fa-cube',

        'elements' => [
            [
                'type' => 'text', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'app_name', // unique name for field
                'label' => 'App Name', // you know what label it is
                'rules' => 'required|min:2|max:50', // validation rule of laravel
                'class' => '', // any class for input
                'value' => 'SMS Reminder', // default value if you want
            ],
            [
                'type' => 'text', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'footer_text', // unique name for field
                'label' => 'Footer Text', // you know what label it is
                'rules' => 'required|min:2', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '<a href="https://github.com/webndevs/laravel-starter/" class="text-muted">Built with ♥ from Bangladesh</a>', // default value if you want
            ],
            [
                'type' => 'checkbox', // input fields type
                'data' => 'text', // data type, string, int, boolean
                'name' => 'show_copyright', // unique name for field
                'label' => 'Show Copyright', // you know what label it is
                'rules' => '', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '1', // default value if you want
            ],
        ],
    ],
    'email' => [
        'title' => 'Email',
        'desc' => 'Email settings for app',
        'icon' => 'fas fa-envelope',

        'elements' => [
            [
                'type' => 'email', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'email', // unique name for field
                'label' => 'Email', // you know what label it is
                'rules' => 'required|email', // validation rule of laravel
                'class' => '', // any class for input
                'value' => 'info@example.com', // default value if you want
            ],
        ],

    ],*/

    'Twilio' => [
        'title' => 'Twili Settings',
        'desc' => 'Setup your Twilio account details here',
        'icon' => 'fas fa-envelope',

        'elements' => [
            [
                'type' => 'text', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'twilio_account_sid', // unique name for field
                'label' => 'Account SID', // you know what label it is
                'rules' => 'required|min:2|max:150', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '', // default value if you want
            ],
            [
                'type' => 'text', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'twilio_account_token', // unique name for field
                'label' => 'Account Token', // you know what label it is
                'rules' => 'required|min:2|max:150', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '', // default value if you want
            ],
            [
                'type' => 'text', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'twilio_phono_number', // unique name for field
                'label' => 'Phone Number', // you know what label it is
                'rules' => 'required|min:2|max:150', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '', // default value if you want
            ],
            [
                'type' => 'text', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'testing_phono_number', // unique name for field
                'label' => 'Number for Test', // you know what label it is
                'rules' => 'required|min:2|max:150', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '', // default value if you want
            ],
        ],

    ]
];
