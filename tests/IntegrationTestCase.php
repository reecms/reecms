<?php

class IntegrationTestCase extends TestCase
{

    public function setUp()
    {
        parent::setUp();
        // reset MongoDB database before any test
        DB::getMongoDB()->drop();
    }
}
