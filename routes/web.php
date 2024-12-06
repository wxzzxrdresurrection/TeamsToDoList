<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function(){
    return Inertia::render("Login");
});

Route::get('/join/team', function(){
    return Inertia::render("CreateOrJoinTeam");
});

Route::get('/tasks', function (){
    return Inertia::render("Tasks");
});

Route::get('/task/new/{id}', function (){
    return Inertia::render("CreateTask");
});

Route::get('/register', function (){
    return Inertia::render("Register");
});

Route::get('/teams', function (){
    return Inertia::render("Teams");
});

Route::get('/team/new', function (){
    return Inertia::render("CreateTeam");
});

Route::get('/team/{id}', function (){
    return Inertia::render("TeamTasks");
});

