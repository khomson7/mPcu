<?php

$url = "https://api.github.com/users/nategood";
$response = \HttpFull\Request::get($url)
    ->expectsJson()
    ->withXTrivialHeader('Just as a demo')
    ->send();

echo "{$response->body->name} joined GitHub on " .
                        date('M jS', strtotime($response->body->created_at)) ."\n";