<?php

namespace Ree\Services;

use Illuminate\Mail\Message;
use Illuminate\Mail\Mailer;
use Ree\Models\User;

/**
 * User Service
 * 
 * Provide these services:
 * + create new user
 *
 * @author Hieu Le <letrunghieu.cse09@gmail.com>
 */
class UserService
{

    /**
     * Mailer instance
     *
     * @var Mailer
     */
    protected $mailer;

    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function createUser($input, $activate = false)
    {
        $user = User::create($input);

        if ($activate) {
            $user->confirm()->save();
        } else {
            $this->mailer->send('emails.register', ['user' => $user], function(Message $msg) use ($user) {
                $msg->to($user->email, $user->username);
                $msg->subject("Confirm your account");
            });
        }

        return $user;
    }
}
