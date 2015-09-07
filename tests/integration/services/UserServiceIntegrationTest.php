<?php
use Ree\Testbench\Traits\EmailTest;

/**
 * Description of UserServiceIntegrationTest
 *
 * @author Hieu Le <letrunghieu.cse09@gmail.com>
 */
class UserServiceIntegrationTest extends IntegrationTestCase
{

    use EmailTest;

    public function setUp()
    {
        parent::setUp();

        $this->initMailService();
    }

    public function testNoEmailSent()
    {
        $this->expectNoMailSent();
    }
}
