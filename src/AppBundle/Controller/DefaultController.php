<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\db_users;
use AppBundle\Entity\db_students;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="lecturer_login")
     */
    public function lecturer_loginAction(Request $request)
    {

        $db_users_from = $this->createFormBuilder(new db_users())
        ->add('dbEmail', EmailType::class, array( 'attr' => array('class' => 'form-control', 'placeholder' => 'Email address', 'style' => 'margin-bottom:15px', 'required' => 'required')))
        ->add('dbPassword', PasswordType::class, array('attr' => array('class' => 'form-control','placeholder' => 'Password', 'style' => 'margin-bottom:15px', 'required' => 'required')))
        ->add('Submit', SubmitType::class, array('label' => 'Log In', 'attr' => array('class' => 'btn btn-primary', 'placeholder' => '', 'style' => 'margin-bottom:15px')))
        ->getForm();
        $db_users_from->handleRequest($request);
        if($db_users_from->isSubmitted() && $db_users_from->isValid()){
            $dbEmail = $db_users_from['dbEmail']->getData();
            $dbPassword = $db_users_from['dbPassword']->getData();
        	$doctrine_con = $this->getDoctrine()->getRepository('AppBundle:db_users')->findOneBy(array('dbEmail' => $dbEmail ,'dbPassword' => md5($dbPassword)));
 
        	if(count($doctrine_con) > 0){
	        		echo '<script language="javascript">';
				  	echo 'alert(" successfully Login")';  //not showing an alert box.
				  	echo '</script>';
					echo $doctrine_con->getId();
					$this->get('session')->set('id', $doctrine_con->getId());
            		return $this->redirectToRoute("Lecturer_homepage");
        	}else{
        		  echo '<script language="javascript">';
				  echo 'alert("Login Failed Try Again")';  //not showing an alert box.
				  echo '</script>';
        	} 
        }

        $form_view = $db_users_from->createView();
        $view_name = 'login_view/lecturer_login_view.html.twig';
        return $this->render( $view_name ,  [ 'db_users_from' => $form_view ]  );
    }


    /**
     * @Route("/student_login", name="student_login")
     */
    public function student_loginAction(Request $request)
    { 
    	$db_users_from = $this->createFormBuilder(new db_students())
        ->add('dbEmail', EmailType::class, array( 'attr' => array('class' => 'form-control', 'placeholder' => 'Email address', 'style' => 'margin-bottom:15px', 'required' => 'required')))
        ->add('dbPassword', PasswordType::class, array('attr' => array('class' => 'form-control','placeholder' => 'Password', 'style' => 'margin-bottom:15px', 'required' => 'required')))
        ->add('Submit', SubmitType::class, array('label' => 'Log In', 'attr' => array('class' => 'btn btn-primary', 'placeholder' => '', 'style' => 'margin-bottom:15px')))
        ->getForm();
        $db_users_from->handleRequest($request);
        if($db_users_from->isSubmitted() && $db_users_from->isValid()){
            $dbEmail = $db_users_from['dbEmail']->getData();
            $dbPassword = $db_users_from['dbPassword']->getData();
        	$doctrine_con = $this->getDoctrine()->getRepository('AppBundle:db_students')->findOneBy(array('dbEmail' => $dbEmail ,'dbPassword' => md5($dbPassword)));
 
        	if(count($doctrine_con) > 0){
	        		echo '<script language="javascript">';
				  	echo 'alert(" successfully Login")';  //not showing an alert box.
				  	echo '</script>';
					echo $doctrine_con->getId();
					$this->get('session')->set('id', $doctrine_con->getId());
                    if($doctrine_con->getDbEmployed() == 1 ){
                       return $this->redirectToRoute("student_emp_homepage");
                    } 
            		return $this->redirectToRoute("student_homepage");
        	}else{
        		  echo '<script language="javascript">';
				  echo 'alert("Login Failed Try Again")';  //not showing an alert box.
				  echo '</script>';
        	} 
        }

        $form_view = $db_users_from->createView();
        $view_name = 'login_view/student_login_view.html.twig';
        return $this->render( $view_name ,  [ 'db_users_from' => $form_view ]  );
    }

    /**
     * @Route("/employer_login", name="employer_login")
     */
    public function employer_loginAction(Request $request)
    { 

        $db_users_from = $this->createFormBuilder(new db_users())
        ->add('dbEmail', EmailType::class, array( 'attr' => array('class' => 'form-control', 'placeholder' => 'Email address', 'style' => 'margin-bottom:15px', 'required' => 'required')))
        ->add('dbPassword', PasswordType::class, array('attr' => array('class' => 'form-control','placeholder' => 'Password', 'style' => 'margin-bottom:15px', 'required' => 'required')))
        ->add('Submit', SubmitType::class, array('label' => 'Log In', 'attr' => array('class' => 'btn btn-primary', 'placeholder' => '', 'style' => 'margin-bottom:15px')))
        ->getForm();
        $db_users_from->handleRequest($request);
        if($db_users_from->isSubmitted() && $db_users_from->isValid()){
            $dbEmail = $db_users_from['dbEmail']->getData();
            $dbPassword = $db_users_from['dbPassword']->getData();
        	$doctrine_con = $this->getDoctrine()->getRepository('AppBundle:db_users')->findOneBy(array('dbEmail' => $dbEmail ,'dbPassword' => md5($dbPassword)));
 
        	if(count($doctrine_con) > 0){
	        		echo '<script language="javascript">';
				  	echo 'alert(" successfully Login")';  
				  	echo '</script>';
					echo $doctrine_con->getId();
					$this->get('session')->set('id', $doctrine_con->getId());
            		return $this->redirectToRoute("employer_homepage");
        	}else{
        		  echo '<script language="javascript">';
				  echo 'alert("Login Failed Try Again")';  
				  echo '</script>';
        	} 
        }

        $form_view = $db_users_from->createView();
        $view_name = 'login_view/employer_login_view.html.twig';
        return $this->render( $view_name ,  [ 'db_users_from' => $form_view ]  );
    }

    /**
    * @Route("/sign_out", name="sign_out")
    */
    public function sign_outAction(Request $request)
    {
        $this->get('session')->clear();
        return $this->redirectToRoute('lecturer_login');
    }

}
