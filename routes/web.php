<?php

use Illuminate\Support\Facades\Route;
use App\Events\PrivateEve;
use App\Events\Hello;

Route::get('/', function () {
    return "hfgfhghhf";
});

Route::get('/broadcast', function () {
    $user = \App\Models\User::find(1);
    Hello::dispatch();
    return 'sent ' . $user->name;
});

Route::get('/broadcast-private',function(){
    $user = App\Models\User::find(1);
    broadcast(new PrivateEve($user));
    return "Event has been sent!";
});

