<?php

use Carbon\Carbon;
use Ree\Models\User;

/**
 * Description of UserTest
 *
 * @author Hieu Le <letrunghieu.cse09@gmail.com>
 * 
 * @package ReeCMSTest
 * @subpackage unit
 */
class UserTest extends TestCase
{

    /**
     * Given: a User object
     * 
     * When : we call `getAvatarUrl`
     * 
     * Then : we received the gravatar url based on the `email` field
     */
    public function testGravatarReturnedIfNoImage()
    {
        $user        = factory(User::class)->make();
        $user->email = 'john@ree-cms.com';
        $this->assertEquals('http://www.gravatar.com/avatar/b1bb20f9ed4781447efbf2969f885d78', $user->getAvatarUrl());

        $user->email = 'John@ree-cms.com';
        $this->assertEquals('http://www.gravatar.com/avatar/b1bb20f9ed4781447efbf2969f885d78', $user->getAvatarUrl(), 'Emails with uppercase letter are hashed incorrectly');
    }

    /**
     * Given: a User object
     * 
     * When : we call `confirm` method
     * 
     * Then : the value of `token` field is set to null
     * Then : the value of `confirmed_at` field is set to the current time
     */
    public function testUserConfirmation()
    {
        $user = factory(User::class)->make(['token' => str_random()]);
        $user->confirm()->save();

        $this->assertNull($user->token);
        $this->assertLessThan(2, Carbon::now()->diffInSeconds($user->confirmed_at));
    }
}
