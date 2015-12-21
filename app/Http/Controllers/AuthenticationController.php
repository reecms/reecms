<?php

namespace Ree\Http\Controllers;

use HieuLe\Taki\Traits\TakiTrait;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Ree\Services\UserService;

class AuthenticationController extends Controller
{
    use ThrottlesLogins, TakiTrait;

    public function getSignUp()
    {
        return view('pages.auth.sign_up');
    }
}