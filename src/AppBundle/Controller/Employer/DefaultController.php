<?php

namespace AppBundle\Controller\Employer;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\db_students;
use AppBundle\Entity\db_jobs;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class DefaultController extends Controller
{
    /**
     * @Route("/employer", name="employer_homepage")
     */
    public function indexAction(Request $request)
    {
        $view_name = 'employer_base_view.html.twig';
        return $this->render( $view_name );
    }

    /**
     * @Route("/applied_applicants", name="applied_applicants")
     */
    public function applied_applicantsAction(Request $request)
    { 
        $single_array = array();
        $students_data = array();
        $jobs_data = array();
        $employer_id = $this->get('session')->get('id');
        $doctrine_con2 = $this->getDoctrine()->getRepository('AppBundle:db_jobs')->findBy(array('dbEmployerId' =>  $employer_id));
        foreach ($doctrine_con2 as $index => $data) {
                
            $doctrine_con = $this->getDoctrine()->getRepository('AppBundle:db_students')->findBy( array('dbJobId' => $data->getId()));

            foreach ($doctrine_con as $index => $data) {
                $single_array  = array(
                    'id'            => $data->getId() ,
                    'name'          => $data->getDbName(),
                    'email'         => $data->getDbEmail(),
                    'img'           =>  $data->getDbImage(),
                    'cv'            =>  $data->getDbCv()
                    );
                array_push($students_data, $single_array);
            }
        }

        $view_name = 'employer_view/applied_applicants_view.html.twig' ; 
        return $this->render( $view_name , ['students_data' => $students_data] ); 
    }


    /**
     * @Route("/view_student_cv/{id}", name="view_student_cv")
     */
    public function view_student_cvAction(Request $request,$id)
    {
        $employed = array();
        $unemployed = array();
        $single_array = array();
        $students_data = array();
        $doctrine_con = $this->getDoctrine()->getRepository('AppBundle:db_students')->findOneBy(array('id' => (int)$id));
        $student_data = $doctrine_con->getDbCv();
        $view_name = 'employer_view/view_student_cv_view.html.twig' ; 
        return $this->render( $view_name , ['student_data' => $student_data]); 
    }




    /**
     * @Route("/add_new_job_employer", name="add_new_job_employer")
     */
    public function add_new_job_employerAction(Request $request)
    { 
        $db_jobs_from = $this->createFormBuilder(new db_jobs())
        ->add('dbName', TextType::class, array('attr' => array('class' => 'form-control', 'placeholder' => 'Job title', 'style' => 'margin-bottom:15px', 'required' => 'required')))
        ->add('dbDetail', TextType::class, array('attr' => array('class' => 'form-control', 'placeholder' => 'Job Details', 'style' => 'margin-bottom:15px', 'required' => 'required')))
        ->add('dbDeadline', DateType::class, array('attr' => array('class' => 'form-control', 'placeholder' => 'Deadline', 'style' => 'margin-bottom:15px', 'required' => 'required')))
        ->add('Submit', SubmitType::class, array('label' => 'Submit', 'attr' => array('class' => 'btn btn-primary', 'placeholder' => '', 'style' => 'margin-bottom:15px')))
        ->getForm();
        $db_jobs_from->handleRequest($request);
        if($db_jobs_from->isSubmitted() && $db_jobs_from->isValid()){
            $employer_id = $this->get('session')->get('id');
            $dbName = $db_jobs_from['dbName']->getData();
            $dbDetail = $db_jobs_from['dbDetail']->getData();
            $dbDeadline = $db_jobs_from['dbDeadline']->getData();
            $doctrine_manager = $this->getDoctrine()->getManager();
            $data = new db_jobs();
            $data->setDbName($dbName);
            $data->setDbDetail($dbDetail);
            $data->setDbDeadline($dbDeadline);
            $data->setDbEmployerId($employer_id);
            $doctrine_manager->persist($data);
            $doctrine_manager->flush();

            echo '<script language="javascript">';
            echo 'alert(" successfully Added")';  //not showing an alert box.
            echo '</script>';

            return $this->redirectToRoute("add_new_job_employer");

        }
 
        $view_name = 'employer_view/add_new_job_employer_view.html.twig' ; 
        $form_view = $db_jobs_from->createView();
        return $this->render( $view_name ,[ 'db_jobs_from' => $form_view ] ); 

    }


}
