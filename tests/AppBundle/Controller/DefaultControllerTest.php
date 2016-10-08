<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testLecturer_login()
    {
        $testing = self::createClient();
        $testing->request('GET', '/');
        $this->assertTrue($testing->getResponse()->isSuccessful());
    }
    public function testStudent_login()
    {
        $testing = self::createClient();
        $testing->request('GET', '/student_login');
        $this->assertTrue($testing->getResponse()->isSuccessful());
    }
    public function testEmployer_login()
    {
        $testing = self::createClient();
        $testing->request('GET', '/employer_login');
        $this->assertTrue($testing->getResponse()->isSuccessful());
    }
    public function testSign_out()
    {
        $testing = self::createClient();
        $testing->request('GET', '/sign_out');
        $this->assertTrue($testing->getResponse()->isSuccessful());
    }
}
