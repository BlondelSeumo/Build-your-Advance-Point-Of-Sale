<?php
return [
    'directories' => [
        'app',
        'resources',
    ],

    'patterns' => [
        '*.php',
        '*.vue',
        '*.js',
    ],

    'allow-newlines' => false,

    'functions' => [
        '__',
        '_t',
        '\$t',
        '\$i18n.t',
        '@lang',
    ],

    'sort-keys' => true,
    'add-persistent-strings-to-translations' => true,

];
