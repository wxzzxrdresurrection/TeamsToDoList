<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function(){
    return Inertia::render("Login");
});

Route::get('/new/group', function(){
    return Inertia::render("CreateGroup");
});

Route::get('/tasks', function (){
    return Inertia::render("Tasks");
});
