<?php

use Carbon\Carbon;
use Ree\Testbench\Traits\EmailTest;
use Ree\Services\UserService;

/**
 * Description of UserServiceIntegrationTest
 *
 * @author Hieu Le <letrunghieu.cse09@gmail.com>
 */
class UserServiceIntegrationTest extends IntegrationTestCase
{

    use EmailTest;

    /**
     *
     * @var UserService 
     */
    private $_service;

    public function setUp()
    {
        parent::setUp();

        $this->_service = new UserService($this->app['mailer']);

        $this->initMailService();
    }

    /**
     * Given: a user service
     * 
     * When : create new user with the `activate` option set to false
     * 
     * Then : a new email is sent to the register email address with the title
     *        of "Confirm your account"
     * Then : the `password` is saved correctly
     */
    public function testCreateUserWithoutActivation()
    {
        $this->expectMailSendOnce(function(Swift_Message $msg) {
            $this->assertArrayHasKey('john@domain.com', $msg->getTo());
            $this->assertEquals('Confirm your account', $msg->getSubject());
        });

        $user = $this->_service->createUser([
            'username' => 'john',
            'email'    => 'john@domain.com',
            'password' => 'password',
        ]);

        $this->assertNotNull($user);
        $this->assertNotNull($user->token);
        $this->assertTrue(Hash::check('password', $user->password));
    }

    /**
     * Given: a user service
     * 
     * When : create new user with the `activate` option set to false
     * 
     * Then : no email sent
     * Then : the `token` field is null and the `confirmed_at` field is set to
     *        current time
     */
    public function testCreateUserWithActivation()
    {
        $this->expectNoMailSent();

        $user = $this->_service->createUser([
            'username' => 'john',
            'email'    => 'john@domain.com',
            'password' => 'password',
            ], true);

        $this->assertNotNull($user);
        $this->assertNull($user->token);
        $this->assertLessThan(2, Carbon::now()->diffInSeconds($user->confirmed_at));
    }
}
