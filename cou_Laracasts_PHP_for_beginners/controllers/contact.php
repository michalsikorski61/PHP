<?php

$_SESSION['user']['last'] = 'Doe';

view("index", [
    'heading' => "Contact Us",
]);