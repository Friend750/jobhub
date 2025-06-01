<?php

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Log;

use function Illuminate\Log\log;

Broadcast::channel('App.Models.User.{id}', function ($user, $id)
{
    return (int) $user->id === (int) $id;
});


Broadcast::channel('users.{id}', function ($user, $id)
{
   
    return (int) $user->id === (int) $id;
});

