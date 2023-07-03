<?php

$arr = [
    [
        "id" => 1,
        "text" => "test"
    ],
    [
        "id" => 2,
        "text" => "test2"
    ],
    [
        "id" => 3,
        "text" => "test3"
    ]
];
for ($i = 0; $i < count($arr); $i++) {
    if ($arr[$i]['id'] === 2) {
        var_dump($arr);
    }
}