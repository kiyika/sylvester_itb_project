<?php
namespace Tests\AppBundle\Controller\Employer;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class DefaultController extends WebTestCase
{
    public function testEmployer()
    {
        $testing = self::createClient();
        $testing->request('GET', '/employer');
        $this->assertTrue($testing->getResponse()->isSuccessful());
    }
    public function testApplied_applicants()
    {
        $testing = self::createClient();
        $testing->request('GET', '/applied_applicants');
        $this->assertTrue($testing->getResponse()->isSuccessful());
    }
    public function testAdd_new_job_employer()
    {
        $testing = self::createClient();
        $testing->request('GET', '/add_new_job_employer');
        $this->assertTrue($testing->getResponse()->isSuccessful());
    }
 }
