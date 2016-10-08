<?php

namespace Tests\AppBundle\Controller\Lecturer;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class DefaultController extends WebTestCase
{


    public function testLecturer()
    {
        $testing = self::createClient();
        $testing->request('GET', '/Lecturer');
        $this->assertTrue($testing->getResponse()->isSuccessful());
    }

    public function testEmp_students()
    {
        $testing = self::createClient();
        $testing->request('GET', '/emp_students');
        $this->assertTrue($testing->getResponse()->isSuccessful());
    }
    public function testUnemp_students()
    {
        $testing = self::createClient();
        $testing->request('GET', '/unemp_students');
        $this->assertTrue($testing->getResponse()->isSuccessful());
    }
    public function testComments_student_cv()
    {
        $testing = self::createClient();
        $testing->request('GET', '/comments_student_cv');
        $this->assertTrue($testing->getResponse()->isSuccessful());
    }
    public function testComments_student_cv_specific()
    {
        $testing = self::createClient();
        $testing->request('GET', '/comments_student_cv_specific');
        $this->assertTrue($testing->getResponse()->isSuccessful());
    }
    public function testAdd_new_student()
    {
        $testing = self::createClient();
        $testing->request('GET', '/add_new_student');
        $this->assertTrue($testing->getResponse()->isSuccessful());
    }
  
   public function testAdd_new_job()
    {
        $testing = self::createClient();
        $testing->request('GET', '/add_new_job');
        $this->assertTrue($testing->getResponse()->isSuccessful());
    }
    public function testAdd_new_employer()
    {
        $testing = self::createClient();
        $testing->request('GET', '/add_new_employer');
        $this->assertTrue($testing->getResponse()->isSuccessful());
    }
  
}
