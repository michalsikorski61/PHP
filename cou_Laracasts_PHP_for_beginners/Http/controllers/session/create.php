<?php

view('session/create', [
    'heading' => 'login',
    'errors' => $_SESSION['_flash']['errors'] ?? [],

]);