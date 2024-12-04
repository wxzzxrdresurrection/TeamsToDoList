<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function(){
    return Inertia::render("Login");
});

Route::get('/new/team', function(){
    return Inertia::render("CreateGroup");
});

Route::get('/tasks', function (){
    return Inertia::render("Tasks");
});

Route::get('/task/new', function (){
    return Inertia::render("CreateTask");
});

Route::get('/register', function (){
    return Inertia::render("Register");
});

Route::get('/teams', function (){
    return Inertia::render("Teams");
});
