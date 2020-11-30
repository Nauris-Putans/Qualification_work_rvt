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

    'accepted'             => 'Šis lauks ir jāpieņem.',
    'active_url'           => 'Šis nav derīgs URL.',
    'after'                => 'Tam jābūt datumam pēc :date.',
    'after_or_equal'       => 'Tam jābūt datumam pēc vai vienādam ar :date.',
    'alpha'                => 'Šajā laukā drīkst būt tikai burti.',
    'alpha_dash'           => 'Šajā laukā drīkst būt tikai burti, cipari, domuzīmes un pasvītras.',
    'alpha_num'            => 'Šajā laukā drīkst būt tikai burti un cipari.',
    'array'                => 'Šim laukam jābūt masīvam.',
    'before'               => 'Tam jābūt datumam pirms :date.',
    'before_or_equal'      => 'Tam jābūt datumam pirms vai vienādam ar :date.',
    'between'              => [
        'numeric' => 'Šai vērtībai jābūt starp :min un :max.',
        'file'    => 'Šim failam jābūt starp :min un :max kilobaitiem.',
        'string'  => 'Šai virknei jābūt starp :min un :max rakstzīmēm.',
        'array'   => 'Šim saturam jābūt starp :min un :max vienumiem.',
    ],
    'boolean'              => 'Šim laukam jābūt patiesam vai nepatiesam.',
    'confirmed'            => 'Apstiprinājums nesakrīt.',
    'date'                 => 'Šis nav derīgs datums.',
    'date_equals'          => 'Tam jābūt datumam, kas vienāds ar :date.',
    'date_format'          => 'Tas neatbilst formātam :format.',
    'different'            => 'Šai vērtībai ir jāatšķiras no :other.',
    'digits'               => 'Tam jābūt :digits cipariem.',
    'digits_between'       => 'Tam jābūt no :min līdz :max cipariem.',
    'dimensions'           => 'Šim attēlam ir nederīgi izmēri.',
    'distinct'             => 'Šim laukam ir dublikāta vērtība.',
    'email'                => 'Tai jābūt derīgai e-pasta adresei.',
    'ends_with'            => 'Tam jābeidzas ar vienu no šīm vērtībām: :values.',
    'exists'               => 'Atlasītā vērtība nav derīga.',
    'file'                 => 'Saturam jābūt failam.',
    'filled'               => 'Šim laukam ir jābūt vērtībai.',
    'gt'                   => [
        'numeric' => 'Vērtībai jābūt lielākai par :value.',
        'file'    => 'Faila lielumam jābūt lielākam par :value kilobaitiem.',
        'string'  => 'Virknei jābūt lielākai par :value rakstzīmēm.',
        'array'   => 'Saturā jābūt vairāk nekā :value vienumiem.',
    ],
    'gte'                  => [
        'numeric' => 'Vērtībai jābūt lielākai vai vienādai par :value.',
        'file'    => 'Faila lielumam jābūt lielākam vai vienādam par :value kilobaitiem.',
        'string'  => 'Virknei jābūt lielākai vai vienādai par :value rakstzīmēm.',
        'array'   => 'Saturā jābūt vismaz :value vienumiem vai vairāk.',
    ],
    'image'                => 'Tam jābūt attēlam.',
    'in'                   => 'Atlasītā vērtība nav derīga.',
    'in_array'             => 'Šī vērtība nepastāv iekša :other.',
    'integer'              => 'Tam jābūt veselam skaitlim.',
    'ip'                   => 'Tai jābūt derīgai IP adresei.',
    'ipv4'                 => 'Tam jābūt derīgai IPv4 adresei.',
    'ipv6'                 => 'Tam jābūt derīgai IPv6 adresei.',
    'json'                 => 'Tam jābūt derīgai JSON virknei.',
    'lt'                   => [
        'numeric' => 'Vērtībai jābūt mazākai par :value.',
        'file'    => 'Faila lielumam jābūt mazākam par :value kilobaitiem.',
        'string'  => 'Virknei jābūt mazākai par :value rakstzīmēm.',
        'array'   => 'Saturs nedrīkst būt mazāks par :value vienumiem.',
    ],
    'lte'                  => [
        'numeric' => 'Vērtībai jābūt mazākai vai vienādai ar :value.',
        'file'    => 'Faila lielumam jābūt mazākam par vai vienādam ar :value kilobaitiem.',
        'string'  => 'Virknei jābūt mazākai par :value rakstzīmēm vai vienādām ar tām.',
        'array'   => 'Saturā nedrīkst būt vairāk par :value vienumiem.',
    ],
    'max'                  => [
        'numeric' => 'Vērtība nedrīkst būt lielāka par :max.',
        'file'    => 'Faila lielums nedrīkst pārsniegt :max kilobaitus.',
        'string'  => 'Virkne nedrīkst būt garāka par :max rakstzīmēm.',
        'array'   => 'Saturā nedrīkst būt vairāk par :max vienumiem.',
    ],
    'mimes'                => 'Tam jābūt šāda veida failam: :values.',
    'mimetypes'            => 'Tam jābūt šāda veida failam: :values.',
    'min'                  => [
        'numeric' => 'Vērtībai jābūt vismaz :mix.',
        'file'    => 'Faila lielumam jābūt vismaz :min kilobaiti.',
        'string'  => 'Virknei jābūt vismaz :min rakstzīmēm.',
        'array'   => 'Vērtībā jābūt vismaz :min vienumiem.',
    ],
    'not_in'               => 'Atlasītā vērtība nav derīga.',
    'not_regex'            => 'Šis formāts nav derīgs.',
    'numeric'              => 'Tam jābūt skaitlim.',
    'password'             => 'Parole nav pareiza.',
    'present'              => 'Šim laukam jābūt klāt.',
    'regex'                => 'Šis formāts nav derīgs.',
    'required'             => 'Šis lauks ir obligāts.',
    'required_if'          => 'Šis lauks ir obligāts, ja :other ir :value.',
    'required_unless'      => 'Šis lauks ir obligāts, ja vien nav :other ir iekšā :values.',
    'required_with'        => 'Šis lauks ir obligāts, ja atrodas :values.',
    'required_with_all'    => 'Šis lauks ir obligāts, ja ir :values.',
    'required_without'     => 'Šis lauks ir obligāts, ja :values nav.',
    'required_without_all' => 'Šis lauks ir obligāts, ja nav nevienas :values.',
    'same'                 => 'Šī lauka vērtībai ir jāsakrīt ar vērtību no :other.',
    'size'                 => [
        'numeric' => 'Vērtības lielumam jābūt :size.',
        'file'    => 'Faila lielumam jābūt :size kilobaiti.',
        'string'  => 'Virknei jābūt :size rakstzīmēm.',
        'array'   => 'Saturā jābūt :size vienumiem.',
    ],
    'starts_with'          => 'Tam jāsākas ar kādu no šīm darbībām: :values.',
    'string'               => 'Tam jābūt virknei.',
    'timezone'             => 'Tai jābūt derīgai zonai.',
    'unique'               => 'Tas jau ir pieņemts.',
    'uploaded'             => 'To neizdevās augšupielādēt.',
    'url'                  => 'Šis formāts nav derīgs.',
    'uuid'                 => 'Tam jābūt derīgam UUID.',

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

];
