<?php

use Core\Session;

view('session/create', [
    'heading' => 'login',
    'errors' => Session::get('errors')

]);