<?php

namespace AppBundle\Controller\Student;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response; 
use AppBundle\Entity\db_comments;
use AppBundle\Entity\db_students;
use AppBundle\Entity\db_users;
use AppBundle\Entity\db_jobs;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class DefaultController extends Controller
{
    /**
     * @Route("/student_homepage", name="student_homepage")
     */
    public function indexAction(Request $request)
    {
      $view_name = 'unemp_student_base_view.html.twig';
      return $this->render( $view_name );
    }

    /**
     * @Route("/student_emp_homepage", name="student_emp_homepage")
     */
    public function student_emp_homepageAction(Request $request)
    {
      $view_name = 'emp_student_base_view.html.twig';
      return $this->render( $view_name );
    }

    /**
     * @Route("/view_all_comments", name="view_all_comments")
     */
    public function view_all_commentsAction(Request $request)
    {
      $student_id = $this->get('session')->get('id');
      $doctrine_manager = $this->getDoctrine()->getRepository('AppBundle:db_comments')->findAll();
      $students_data = array( );   
      $all_comments = array( );   
      foreach ($doctrine_manager as $index => $data) {
          if($data->getDbUserId() == 0 || $data->getDbUserId() == $student_id){
            array_push($all_comments,   $data->getDbText());
          } 
      } 
        $view_name = 'student_view/view_all_comments_view.html.twig' ; 
        return $this->render( $view_name , ['students_data' => $students_data, 'all_comments' => $all_comments] ); 
    }

    /**
     * @Route("/view_all_jobs", name="view_all_jobs")
     */
    public function view_all_jobsAction(Request $request)
    { 
      $jobs_data = array( );
      $doctrine_con = $this->getDoctrine()->getRepository('AppBundle:db_jobs')->findAll();

      foreach ($doctrine_con as $index => $data) {
        $getDbDeadline =  $data->getDbDeadline();
        $getDbDeadline =  $getDbDeadline->format('Y-m-d');
        $today = new \Datetime("now");
        $today = $today->format('Y-m-d');
        if(strtotime($getDbDeadline) > strtotime($today)){
          $single_array  = array(
            'id'            => $data->getId() ,
            'name'          => $data->getDbName(),
            'detail'         => $data->getDbDetail(),
            'deadline'       =>  $getDbDeadline,
            );
          array_push($jobs_data, $single_array);
        }
        }
        $view_name = 'student_view/view_all_jobs_view.html.twig' ; 
        return $this->render( $view_name , ['jobs_data' => $jobs_data] ); 
    }

    /**
     * @Route("/update_cv", name="update_cv")
     */
    public function update_cvAction(Request $request)
    {
      $student_id = $this->get('session')->get('id');
      $doctrine_manager = $this->getDoctrine()->getRepository('AppBundle:db_students')->findOneBy(array('id' => $student_id));
      $students_data = array( );   
      $student_name = null;
      $student_cv = null;
      if(count($doctrine_manager) > 0 ){
        $student_name = $doctrine_manager->getDbName();
        $student_cv = $doctrine_manager->getDbCv();
      }  
      $view_name = 'student_view/update_cv_view.html.twig' ; 
      return $this->render( $view_name , ['students_data' => $students_data , 'student_cv' => $student_cv ]); 
    }

    /**
     * @Route("/update_cv_ajax", name="update_cv_ajax")
     */
    public function update_cv_ajaxAction(Request $request)
    {
      $student_id = $this->get('session')->get('id');
      $response = new Response();
      $response->setStatusCode(Response::HTTP_OK);
      $doctrine_manager = $this->getDoctrine()->getManager();
      $student_cv = $doctrine_manager->getRepository('AppBundle:db_students')
      ->findOneBy(array('id' => $student_id));
      $student_cv->setDbCv($request->request->get('cv'));
      $response->headers->set('Content-Type', 'text/html');
      $doctrine_manager->persist($student_cv);
      $doctrine_manager->flush();
      $response->setContent("success");
      return  $response;      
  
    }

   /**
     * @Route("/upload_picture", name="upload_picture")
     */
    public function upload_pictureAction(Request $request)
    { 
      $students_data = array( );          
      $student_id = $this->get('session')->get('id');
      $doctrine_manager = $this->getDoctrine()->getManager();
      $student_data = $doctrine_manager->getRepository('AppBundle:db_students')
      ->findOneBy(array('id' => $student_id));
      $student_image =  $student_data->getDbImage();
      $db_students_from = $this->createFormBuilder(new db_students())
      ->add('dbImage', FileType::class,  array( 'data_class' => null, 'attr' => array('class' => 'form-control',  'style' => 'margin-bottom:15px', 'required' => 'required')))
      ->add('Submit', SubmitType::class, array('label' => 'upload', 'attr' => array('class' => 'btn btn-primary')))
      ->getForm();
      $db_students_from->handleRequest($request);
      if($db_students_from->isSubmitted() && $db_students_from->isValid()){
        $dbImage = $student_data->getDbEmail().".jpg";
        $doctrine_manager = $this->getDoctrine()->getManager();
        $student_cv = $doctrine_manager->getRepository('AppBundle:db_students')
        ->findOneBy(array('id' => $student_id));
        $student_cv->setDbImage($student_data->getDbEmail());
        $doctrine_manager->persist($student_cv);
        $doctrine_manager->flush();
        $uploadDir = $this->container->getParameter('images_directory');
        foreach($request->files as $uploadedFile) {
         $file = $uploadedFile['dbImage']->move($uploadDir, $dbImage);
       }
     }



      $form_view = $db_students_from->createView();
      $view_name = 'student_view/upload_picture_view.html.twig' ; 
      return $this->render( $view_name ,[ 'db_students_from' => $form_view, 'student_image' => $student_image ] ); 
    }

    /**
     * @Route("/view_cv_details", name="view_cv_details")
     */
    public function view_cv_detailsAction(Request $request)
    {
      $students_data = array();
      $student_id = $this->get('session')->get('id');
      $doctrine_con = $this->getDoctrine()->getRepository('AppBundle:db_students')->findOneBy(array('id' => (int)$student_id));
      $student_data = $doctrine_con->getDbCv();
      $view_name = 'student_view/view_cv_details_view.html.twig' ; 
      return $this->render( $view_name , ['student_data' => $student_data]); 
    }

    /**
     * @Route("/view_job_details", name="view_job_details")
     */
    public function view_job_detailsAction(Request $request)
    {
      $student_id = $this->get('session')->get('id');
      $students_data = array();
      $doctrine_con = $this->getDoctrine()->getRepository('AppBundle:db_students')->findOneBy(array('id' => (int)$student_id));
      $student_data = $doctrine_con->getDbCv();
      $student_job_id = $doctrine_con->getDbJobId();
      $doctrine_con_job = $this->getDoctrine()->getRepository('AppBundle:db_jobs')->findOneBy(array('id' => (int)$student_job_id));
      if(count($doctrine_con_job) > 0 ){
        $student_job_detail = $doctrine_con_job->getDbDetail() ;
        $student_job_title = $doctrine_con_job->getDbName() ;
      }
        

        $view_name = 'student_view/view_job_details_view.html.twig' ; 
        return $this->render( $view_name , ['student_data' => $student_data , 'student_job_detail' => $student_job_detail, 'student_job_title' => $student_job_title]); 
      }



    /**
     * @Route("/hire_student/{job_id}", name="hire_student")
     */
    public function hire_studentAction(Request $request, $job_id)
    {
      $student_id = $this->get('session')->get('id');
      $doctrine_manager = $this->getDoctrine()->getManager();
      $student_cv = $doctrine_manager->getRepository('AppBundle:db_students')
      ->findOneBy(array('id' => $student_id));
      $student_cv->setDbJobId($job_id);
      $doctrine_manager->persist($student_cv);
      $doctrine_manager->flush();
      return $this->redirectToRoute('student_emp_homepage');

    }



}
