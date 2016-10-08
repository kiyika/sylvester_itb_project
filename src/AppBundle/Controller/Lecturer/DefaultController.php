<?php

namespace AppBundle\Controller\Lecturer;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\db_comments;
use AppBundle\Entity\db_students;
use AppBundle\Entity\db_users;
use AppBundle\Entity\db_jobs;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class DefaultController extends Controller
{
    /**
     * @Route("/Lecturer", name="Lecturer_homepage")
     */
    public function indexAction(Request $request)
    {
        $view_name = 'lecturer_base_view.html.twig' ; 
        return $this->render( $view_name ); 
    }

    /**
     * @Route("/emp_students", name="emp_students")
     */
    public function emp_studentsAction(Request $request)
    { 
        $single_array = array();
        $students_data = array();
        $doctrine_con = $this->getDoctrine()->getRepository('AppBundle:db_students')->findAll();
 
        foreach ($doctrine_con as $index => $data) {
            if($data->getDbEmployed() == "1"){
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

        $view_name = 'lecturer_view/emp_students_view.html.twig' ; 
        return $this->render( $view_name , ['students_data' => $students_data] ); 
    }

    /**
     * @Route("/unemp_students", name="unemp_students")
     */
    public function unemp_studentsAction(Request $request)
    { 
        $single_array = array();
        $students_data = array();
        $doctrine_con = $this->getDoctrine()->getRepository('AppBundle:db_students')->findAll();
 
        foreach ($doctrine_con as $index => $data) {
            if($data->getDbEmployed() == "0"){
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

        $view_name = 'lecturer_view/unemp_students_view.html.twig' ; 
        return $this->render( $view_name , ['students_data' => $students_data]); 
    }

    /**
     * @Route("/cv_student_view/{id}", name="cv_student_view")
     */
    public function cv_student_viewAction(Request $request,$id)
    {
        $employed = array();
        $unemployed = array();
        $single_array = array();
        $students_data = array();
        $doctrine_con = $this->getDoctrine()->getRepository('AppBundle:db_students')->findOneBy(array('id' => (int)$id));
        $student_data = $doctrine_con->getDbCv();
        $view_name = 'lecturer_view/cv_student_view.html.twig' ; 
        return $this->render( $view_name , ['student_data' => $student_data]); 
    }

    /**
     * @Route("/comments_student_cv", name="comments_student_cv")
     */
    public function comments_student_cvAction(Request $request)
    {

        $db_comments = new db_comments();
        $db_comments_from = $this->createFormBuilder($db_comments)
        ->add('dbText', TextType::class, array('attr' => array('class' => 'form-control', 'placeholder' => 'Comment here', 'style' => 'margin-bottom:15px', 'required' => 'required')))
        ->add('Submit', SubmitType::class, array('label' => 'Submit', 'attr' => array('class' => 'btn btn-primary', 'placeholder' => '', 'style' => 'margin-bottom:15px')))
        ->getForm();
        $db_comments_from->handleRequest($request);
        if($db_comments_from->isSubmitted() && $db_comments_from->isValid()){
            $comment = $db_comments_from['dbText']->getData();
            $db_comments = new db_comments();
            $db_comments->setDbUserId(0);
            $db_comments->setDbGeneral(1);
            $db_comments->setDbText($db_comments_from['dbText']->getData());
            $doctrine_manager = $this->getDoctrine()->getManager();
            $doctrine_manager->persist($db_comments);
            $doctrine_manager->flush();
            return $this->redirectToRoute("comments_student_cv");

        }
        $form_view = $db_comments_from->createView(); 
        $view_name = 'lecturer_view/comments_student_cv_view.html.twig' ; 
        return $this->render( $view_name ,[ 'db_comments_from' =>  $form_view ] ); 
    }

    /**
     * @Route("/comments_student_cv_specific", name="comments_student_cv_specific")
     */
    public function comments_student_cv_specificAction(Request $request)
    {
        $db_students = array();
        $doctrine_con = $this->getDoctrine()
        ->getRepository('AppBundle:db_students')
        ->findAll();
        foreach ($doctrine_con as $index => $data) {
            $db_students[   $data->getDbName() ] = $data->getId() ;
        }
        $db_comments = new db_comments();
        $db_comments_from = $this->createFormBuilder($db_comments)
        ->add('dbText', TextType::class, array('attr' => array('class' => 'form-control', 'placeholder' => 'Comment here', 'style' => 'margin-bottom:15px', 'required' => 'required')))
        ->add('dbUserId', ChoiceType::class, array('choices' =>   $db_students , 'attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px', 'required' => 'required')))
        ->add('Submit', SubmitType::class, array('label' => 'Submit', 'attr' => array('class' => 'btn btn-primary', 'placeholder' => '', 'style' => 'margin-bottom:15px')))
        ->getForm();
        $db_comments_from->handleRequest($request);
        if($db_comments_from->isSubmitted() && $db_comments_from->isValid()){
            $comment = $db_comments_from['dbText']->getData();
            $dbUserId = $db_comments_from['dbUserId']->getData();
            $db_comments = new db_comments();
            $db_comments->setDbUserId($dbUserId);
            $db_comments->setDbGeneral(1);
            $db_comments->setDbText($db_comments_from['dbText']->getData());
            $doctrine_manager = $this->getDoctrine()->getManager();
            $doctrine_manager->persist($db_comments);
            $doctrine_manager->flush();
            return $this->redirectToRoute("comments_student_cv_specific");

        } 

        $form_view = $db_comments_from->createView();
        $view_name = 'lecturer_view/comments_student_cv_specific_view.html.twig' ; 
        return $this->render( $view_name ,[ 'db_comments_from' => $form_view ] ); 
    }


    /**
     * @Route("/add_new_student", name="add_new_student")
     */
    public function add_new_studentAction(Request $request)
    {

        $db_students_from = $this->createFormBuilder(new db_students())
        ->add('dbName', TextType::class, array('attr' => array('class' => 'form-control', 'placeholder' => 'name', 'style' => 'margin-bottom:15px', 'required' => 'required')))
        ->add('dbEmail', EmailType::class, array('attr' => array('class' => 'form-control', 'placeholder' => 'email', 'style' => 'margin-bottom:15px', 'required' => 'required')))
        ->add('dbPassword', PasswordType::class, array('attr' => array('class' => 'form-control', 'placeholder' => 'password', 'style' => 'margin-bottom:15px', 'required' => 'required')))
        ->add('Submit', SubmitType::class, array('label' => 'Submit', 'attr' => array('class' => 'btn btn-primary', 'placeholder' => '', 'style' => 'margin-bottom:15px')))
        ->getForm();
        $db_students_from->handleRequest($request);
        if($db_students_from->isSubmitted() && $db_students_from->isValid()){
            $dbName = $db_students_from['dbName']->getData();
            $dbEmail = $db_students_from['dbEmail']->getData();
            $dbPassword = $db_students_from['dbPassword']->getData();
            $doctrine_manager = $this->getDoctrine()->getManager();
            $data = new db_students();
            $data->setDbName($dbName);
            $data->setDbEmail($dbEmail);
            $data->setDbPassword(md5($dbPassword));
            $data->setDbEmployed(0);
            $doctrine_manager->persist($data);
            $doctrine_manager->flush();
            return $this->redirectToRoute("add_new_student");
        }


        $form_view = $db_students_from->createView();
        $view_name = 'lecturer_view/add_new_student_view.html.twig' ; 
        return $this->render( $view_name ,[ 'db_students_from' => $form_view ] );  
    }


    /**
     * @Route("/add_new_employer", name="add_new_employer")
     */
    public function add_new_employerAction(Request $request)
    {

        $db_users_from = $this->createFormBuilder(new db_users())
        ->add('dbName', TextType::class, array('attr' => array('class' => 'form-control', 'placeholder' => 'name', 'style' => 'margin-bottom:15px', 'required' => 'required')))
        ->add('dbEmail', EmailType::class, array('attr' => array('class' => 'form-control', 'placeholder' => 'email', 'style' => 'margin-bottom:15px', 'required' => 'required')))
        ->add('dbPassword', PasswordType::class, array('attr' => array('class' => 'form-control', 'placeholder' => 'password', 'style' => 'margin-bottom:15px', 'required' => 'required')))
        ->add('dbContact', NumberType::class, array('attr' => array('class' => 'form-control', 'placeholder' => 'Contact', 'style' => 'margin-bottom:15px', 'required' => 'required')))
        ->add('Submit', SubmitType::class, array('label' => 'Submit', 'attr' => array('class' => 'btn btn-primary', 'placeholder' => '', 'style' => 'margin-bottom:15px')))
        ->getForm();
        $db_users_from->handleRequest($request);
        if($db_users_from->isSubmitted() && $db_users_from->isValid()){
            $dbName = $db_users_from['dbName']->getData();
            $dbEmail = $db_users_from['dbEmail']->getData();
            $dbPassword = $db_users_from['dbPassword']->getData();
            $dbContact = $db_users_from['dbContact']->getData();
            $doctrine_manager = $this->getDoctrine()->getManager();
            $data = new db_users();
            $data->setDbName($dbName);
            $data->setDbEmail($dbEmail);
            $data->setDbPassword(md5($dbPassword));
            $data->setDbContact($dbContact);
            $data->setDbEmployer(1);
            $doctrine_manager->persist($data);
            $doctrine_manager->flush();

            return $this->redirectToRoute("add_new_employer");

        }
 
        $view_name = 'lecturer_view/add_new_employer_view.html.twig' ; 
        $form_view = $db_users_from->createView();
        return $this->render( $view_name ,[ 'db_users_from' => $form_view ] ); 
    }


    /**
     * @Route("/add_new_job", name="add_new_job")
     */
    public function add_new_jobAction(Request $request)
    {
        $db_users = array();
        $doctrine_con = $this->getDoctrine()
        ->getRepository('AppBundle:db_users')
        ->findAll();


        foreach ($doctrine_con as $index => $data) {
            if( $data->getDbEmployer() ){
                $db_users[   $data->getDbName() ] = $data->getId() ;
            }
             // echo $dbEmployer;
        }
        // echo "<pre>";
        // var_dump($db_users);
        // die();
        $db_jobs_from = $this->createFormBuilder(new db_jobs())
        ->add('dbName', TextType::class, array('attr' => array('class' => 'form-control', 'placeholder' => 'Job title', 'style' => 'margin-bottom:15px', 'required' => 'required')))
        ->add('dbDetail', TextType::class, array('attr' => array('class' => 'form-control', 'placeholder' => 'Job Details', 'style' => 'margin-bottom:15px', 'required' => 'required')))
        ->add('dbDeadline', DateType::class, array('attr' => array('class' => 'form-control', 'placeholder' => 'Deadline', 'style' => 'margin-bottom:15px', 'required' => 'required')))
         ->add('dbEmployerId', ChoiceType::class, array('choices' =>   $db_users , 'attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px', 'required' => 'required')))
        ->add('Submit', SubmitType::class, array('label' => 'Submit', 'attr' => array('class' => 'btn btn-primary', 'placeholder' => '', 'style' => 'margin-bottom:15px')))
        ->getForm();
        $db_jobs_from->handleRequest($request);
        if($db_jobs_from->isSubmitted() && $db_jobs_from->isValid()){
            $dbName = $db_jobs_from['dbName']->getData();
            $dbDetail = $db_jobs_from['dbDetail']->getData();
            $dbDeadline = $db_jobs_from['dbDeadline']->getData();
            $dbEmployerId = $db_jobs_from['dbEmployerId']->getData();
            $doctrine_manager = $this->getDoctrine()->getManager();
            $data = new db_jobs();
            $data->setDbName($dbName);
            $data->setDbDetail($dbDetail);
            $data->setDbDeadline($dbDeadline);
            $data->setDbEmployerId($dbEmployerId);
            $doctrine_manager->persist($data);
            $doctrine_manager->flush();


                 echo '<script language="javascript">';
                  echo 'if(confirm("Some message")) { window.location.href="'.$request->get('_route').'/add_new_job" } else { confirm("Some message"); }';  //not showing an alert box.
                  echo '</script>';
            return $this->redirectToRoute("add_new_job");

        }
 
        $view_name = 'lecturer_view/add_new_job_view.html.twig' ; 
        $form_view = $db_jobs_from->createView();
        return $this->render( $view_name ,[ 'db_jobs_from' => $form_view ] ); 
    }




}
