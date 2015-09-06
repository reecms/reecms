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

    public function testGravatarReturnedIfNoImage()
    {
        /* @var $user User */
        $user = factory(User::class)->make();
        $user->email = 'john@ree-cms.com';
        $user->use_custom_avatar = false;
        $this->assertEquals('http://www.gravatar.com/avatar/b1bb20f9ed4781447efbf2969f885d78', $user->getAvatarUrl());
        
        $user->email = 'John@ree-cms.com';
        $this->assertEquals('http://www.gravatar.com/avatar/b1bb20f9ed4781447efbf2969f885d78', $user->getAvatarUrl(), 'Emails with uppercase letter are hashed incorrectly');
    }
}
