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

    'accepted' => 'The :group_attribute must be accepted.',
    'active_url' => 'The :group_attribute is not a valid URL.',
    'after' => 'The :group_attribute must be a date after :date.',
    'after_or_equal' => 'The :group_attribute must be a date after or equal to :date.',
    'alpha' => 'The :group_attribute may only contain letters.',
    'alpha_dash' => 'The :group_attribute may only contain letters, numbers, dashes and underscores.',
    'alpha_num' => 'The :group_attribute may only contain letters and numbers.',
    'array' => 'The :group_attribute must be an array.',
    'before' => 'The :group_attribute must be a date before :date.',
    'before_or_equal' => 'The :group_attribute must be a date before or equal to :date.',
    'between' => [
        'numeric' => 'The :group_attribute must be between :min and :max.',
        'file' => 'The :group_attribute must be between :min and :max kilobytes.',
        'string' => 'The :group_attribute must be between :min and :max characters.',
        'array' => 'The :group_attribute must have between :min and :max items.',
    ],
    'boolean' => 'The :group_attribute field must be true or false.',
    'confirmed' => 'The :group_attribute confirmation does not match.',
    'date' => 'The :group_attribute is not a valid date.',
    'date_equals' => 'The :group_attribute must be a date equal to :date.',
    'date_format' => 'The :group_attribute does not match the format :format.',
    'different' => 'The :group_attribute and :other must be different.',
    'digits' => 'The :group_attribute must be :digits digits.',
    'digits_between' => 'The :group_attribute must be between :min and :max digits.',
    'dimensions' => 'The :group_attribute has invalid image dimensions.',
    'distinct' => 'The :group_attribute field has a duplicate value.',
    'email' => 'The :group_attribute must be a valid email address.',
    'ends_with' => 'The :group_attribute must end with one of the following: :values.',
    'exists' => 'The selected :group_attribute is invalid.',
    'file' => 'The :group_attribute must be a file.',
    'filled' => 'The :group_attribute field must have a value.',
    'gt' => [
        'numeric' => 'The :group_attribute must be greater than :value.',
        'file' => 'The :group_attribute must be greater than :value kilobytes.',
        'string' => 'The :group_attribute must be greater than :value characters.',
        'array' => 'The :group_attribute must have more than :value items.',
    ],
    'gte' => [
        'numeric' => 'The :group_attribute must be greater than or equal :value.',
        'file' => 'The :group_attribute must be greater than or equal :value kilobytes.',
        'string' => 'The :group_attribute must be greater than or equal :value characters.',
        'array' => 'The :group_attribute must have :value items or more.',
    ],
    'image' => 'The :group_attribute must be an image.',
    'in' => 'The selected :group_attribute is invalid.',
    'in_array' => 'The :group_attribute field does not exist in :other.',
    'integer' => 'The :group_attribute must be an integer.',
    'ip' => 'The :group_attribute must be a valid IP address.',
    'ipv4' => 'The :group_attribute must be a valid IPv4 address.',
    'ipv6' => 'The :group_attribute must be a valid IPv6 address.',
    'json' => 'The :group_attribute must be a valid JSON string.',
    'lt' => [
        'numeric' => 'The :group_attribute must be less than :value.',
        'file' => 'The :group_attribute must be less than :value kilobytes.',
        'string' => 'The :group_attribute must be less than :value characters.',
        'array' => 'The :group_attribute must have less than :value items.',
    ],
    'lte' => [
        'numeric' => 'The :group_attribute must be less than or equal :value.',
        'file' => 'The :group_attribute must be less than or equal :value kilobytes.',
        'string' => 'The :group_attribute must be less than or equal :value characters.',
        'array' => 'The :group_attribute must not have more than :value items.',
    ],
    'max' => [
        'numeric' => 'The :group_attribute may not be greater than :max.',
        'file' => 'The :group_attribute may not be greater than :max kilobytes.',
        'string' => 'The :group_attribute may not be greater than :max characters.',
        'array' => 'The :group_attribute may not have more than :max items.',
    ],
    'mimes' => 'The :group_attribute must be a file of type: :values.',
    'mimetypes' => 'The :group_attribute must be a file of type: :values.',
    'min' => [
        'numeric' => 'The :group_attribute must be at least :min.',
        'file' => 'The :group_attribute must be at least :min kilobytes.',
        'string' => 'The :group_attribute must be at least :min characters.',
        'array' => 'The :group_attribute must have at least :min items.',
    ],
    'not_in' => 'The selected :group_attribute is invalid.',
    'not_regex' => 'The :group_attribute format is invalid.',
    'numeric' => 'The :group_attribute must be a number.',
    'password' => 'The password is incorrect.',
    'present' => 'The :group_attribute field must be present.',
    'regex' => 'The :group_attribute format is invalid.',
    'required' => 'The :group_attribute field is required.',
    'required_if' => 'The :group_attribute field is required when :other is :value.',
    'required_unless' => 'The :group_attribute field is required unless :other is in :values.',
    'required_with' => 'The :group_attribute field is required when :values is present.',
    'required_with_all' => 'The :group_attribute field is required when :values are present.',
    'required_without' => 'The :group_attribute field is required when :values is not present.',
    'required_without_all' => 'The :group_attribute field is required when none of :values are present.',
    'same' => 'The :group_attribute and :other must match.',
    'size' => [
        'numeric' => 'The :group_attribute must be :size.',
        'file' => 'The :group_attribute must be :size kilobytes.',
        'string' => 'The :group_attribute must be :size characters.',
        'array' => 'The :group_attribute must contain :size items.',
    ],
    'starts_with' => 'The :group_attribute must start with one of the following: :values.',
    'string' => 'The :group_attribute must be a string.',
    'timezone' => 'The :group_attribute must be a valid zone.',
    'unique' => 'The :group_attribute has already been taken.',
    'uploaded' => 'The :group_attribute failed to upload.',
    'url' => 'The :group_attribute format is invalid.',
    'uuid' => 'The :group_attribute must be a valid UUID.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "group_attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given group_attribute rule.
    |
    */

    'custom' => [
        'group_attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our group_attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
