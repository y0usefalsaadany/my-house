<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

foreach (glob(__DIR__ . '/apis/*.php') as $file_name) {
    include $file_name;
}


// admins
foreach (glob(__DIR__ . '/apis/admins/*.php') as $file_name) {
    include $file_name;
}
