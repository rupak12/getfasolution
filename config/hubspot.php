<?php

/**
 * Maps site form keys to HubSpot form field names.
 * Field names must match your HubSpot form (Marketing → Forms → field internal names).
 */
return [
    'submit_url' => 'https://api.hsforms.com/submissions/v3/integration/submit',

    'contact_field_map' => [
        'first_name' => 'firstname',
        'last_name' => 'lastname',
        'email' => 'email',
        'phone' => 'phone',
        'job_title' => 'jobtitle',
        'institution' => 'company',
        'message' => 'message',
    ],

    'newsletter_field_map' => [
        'first_name' => 'firstname',
        'last_name' => 'lastname',
        'email' => 'email',
    ],
];
