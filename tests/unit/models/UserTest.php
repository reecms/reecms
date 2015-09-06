<?php
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
     * Given: a user
     * 
     * When : we want to get his/her avatar image url
     * 
     * The  : we received the gravatar url based on his/her email
     */
    public function testGravatarReturnedIfNoImage()
    {
        /* @var $user User */
        $user = factory(User::class)->make();
        $user->email = 'john@ree-cms.com';
        $this->assertEquals('http://www.gravatar.com/avatar/b1bb20f9ed4781447efbf2969f885d78', $user->getAvatarUrl());

        $user->email = 'John@ree-cms.com';
        $this->assertEquals('http://www.gravatar.com/avatar/b1bb20f9ed4781447efbf2969f885d78', $user->getAvatarUrl(), 'Emails with uppercase letter are hashed incorrectly');
    }
}
