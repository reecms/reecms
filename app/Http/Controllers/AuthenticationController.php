<?php

namespace Ree\Http\Controllers;

class AuthenticationController extends Controller
{
    public function getSignUp() {
        return view('pages.auth.sign_up');
    }
}