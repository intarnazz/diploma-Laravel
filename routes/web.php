<?php

use Illuminate\Support\Facades\Route;
use App\Events\PrivateEve;
use App\Events\Hello;

Route::get('/', function () {
    return "hfgfhghhf";
});

Route::get('/broadcast', function () {
    $user = \App\Models\User::find(3);
    Hello::dispatch();
    return 'sent ' . $user->login;
});

Route::get('/broadcast-private',function(){
    $user = App\Models\User::find(2);
    broadcast(new PrivateEve($user));
    return "Event has been sent!";
});

