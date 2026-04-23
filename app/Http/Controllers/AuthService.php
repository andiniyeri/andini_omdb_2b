<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthService
{
    public function register_process($data)
    {
        $user = User::create([
            'full_name' => $data['full_name'],
            'email'     => $data['email'],
            'password'  => $data['password']
        ]);
    if($user) {
        return true;
    }
    return false;
    }
}

?><?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthService
{
    public function register_process($data)
    {
        $user = User::create([
            'full_name' => $data['full_name'],
            'email'     => $data['email'],
            'password'  => $data['password']
        ]);
    if($user) {
        return true;
    }
    return false;
    }
}

?>