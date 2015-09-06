<?php
use Ree\Models\User;

/**
 * Description of UserTest
 *
 * @author Hieu Le <letrunghieu.cse09@gmail.com>
 * 
 * @package ReeCMSTest
 * @subpackage integration
 */
class UserIntegrationTest extends IntegrationTestCase
{

    /**
     * Given: a new user with a raw password
     * 
     * When : we save that user into database
     * 
     * Then : his/her password is hashed correctly before being saved
     */
    public function testPasswordIsHashedBeforeSaved()
    {
        /* @var $user User */
        $user = factory(User::class)->make();
        $user->password = 'bla123';
        $user->save();
        $this->assertTrue(Hash::check('bla123', $user->password));
    }
}
