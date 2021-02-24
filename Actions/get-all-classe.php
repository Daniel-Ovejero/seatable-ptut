<?php

$optsClass = [
    'http' => [
        'method'  => 'GET',
        'header'  => "Content-Type: application/json\r\n".
            "Authorization: Token ".TOKEN."\r\n",
    ]
];

$context  = stream_context_create($optsClass);
$url = "https://cloud.seatable.io/dtable-server/api/v1/dtables/".UUID."/rows/?table_name=Classe";
$classes = file_get_contents($url, false, $context);
$classes = json_decode($classes)->rows;