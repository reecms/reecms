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
        $user           = factory(User::class)->make();
        $user->password = 'bla123';
        $user->save();
        $this->assertTrue(Hash::check('bla123', $user->password));
    }

    /**
     * When : create new User model and save it to database
     * 
     * Then : the value of `token` field is set to a random 32 character string
     */
    public function testTokenIsGeneratedWhenCreateNewUser()
    {
        $user = factory(User::class)->create();

        $this->assertNotNull($user->token);
        $this->assertEquals(32, strlen($user->token));
    }

    /**
     * Given: a User object
     * 
     * When : call the `save` method to save other fields
     * 
     * Then : the value of `token` is not change
     */
    public function testTokenValueIsNotChangeWhenSavingUser()
    {
        $user = factory(User::class)->create();

        $token      = $user->token;
        $user->name = 'New name';
        $user->save();
        $this->assertEquals($token, $user->token);

        $user->token = null;
        $user->save();
        $this->assertNull($user->token);

        $user->name = 'Another name';
        $user->save();
        $this->assertNull($user->token);
    }
}
