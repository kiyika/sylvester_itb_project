<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class DefaultController extends WebTestCase
{
  public function tetIndex()
  {
    $testing = self::createClient();
    $testing->request('GET', '/student_homepage');
    $this->assertTrue($testing->getResponse()->isSuccessful());
  }

  public function testView_cv_details()
  {
    $testing = self::createClient();
    $testing->request('GET', '/view_cv_details');
    $this->assertTrue($testing->getResponse()->isSuccessful());
  }

  public function testUpload_picture()
  {
    $testing = self::createClient();
    $testing->request('GET', '/upload_picture');
    $this->assertTrue($testing->getResponse()->isSuccessful());
  }


  public function testUpdate_cv()
  {
    $testing = self::createClient();
    $testing->request('GET', '/update_cv');
    $this->assertTrue($testing->getResponse()->isSuccessful());
  }


  public function testView_all_jobs()
  {
    $testing = self::createClient();
    $testing->request('GET', '/view_all_jobs');
    $this->assertTrue($testing->getResponse()->isSuccessful());
  }


  public function testView_all_comments()
  {
    $testing = self::createClient();
    $testing->request('GET', '/view_all_comments');
    $this->assertTrue($testing->getResponse()->isSuccessful());
  }

  public function testStudent_emp_homepage()
  {
    $testing = self::createClient();
    $testing->request('GET', '/student_emp_homepage');
    $this->assertTrue($testing->getResponse()->isSuccessful());
  }
    }
