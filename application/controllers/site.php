<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Site extends CI_Controller {


    private $use;

    public function __construct(){

        parent::__construct();

        $this->use = new class_loader();

        $this->use->use_lib('');

    }

    public function index(){

        $this->use->use_lib('site/render_pages');

        $page= new render_pages();

        $page->page_home();

    }



    public function elect(){

        $this->use->use_lib('site/render_pages');

        $page= new render_pages();

        $page->page_elect();

    }



    public function contact_us(){


    }


    public function about(){

        $this->use->use_lib('site/render_pages');

        $page= new render_pages();

        $page->page_about();

    }

    public function check_elect(){

        $this->use->use_lib('site/sessions');

        $session = new sessions();

        if($session ->get_login()){

            $this->use->use_lib('site/students');

            $students = new students();

           if($students->check_elect()){

               $students->new_elect();

               echo json_encode(array('valid'=>true,'massage'=>'<div class="alert alert-success alert-dismissable" style="margin-top:15px;"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><h4>Alert!</h4> <strong>Thank you for your election, to view the results <br><a href="'.site_url('site/elect').'" class="btn btn-default">Click here</a> </strong></div>'));

           }else{
               echo json_encode(array('valid'=>false,'massage'=>'<div class="alert alert-danger alert-dismissable" style="margin-top:15px;"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><h4>Alert!</h4> <strong>I was elected by to view the results <br><a href="'.site_url('site/elect').'" class="btn btn-warning">Click here</a> </strong></div>'));
           }

        }else{

          exit;

        }
    }

    public function logout(){

        $this->use->use_lib('site/sessions');

        $session = new sessions();

        if($session ->get_login()){

           $session->remove_login();

            redirect(site_url('site'));

        }else{

            redirect(site_url('site'));

        }

    }

    public function check_login(){

        $this->use->use_lib('site/sessions');

        $session = new sessions();

        if($session ->get_login()){

            echo 'is login';
        }else{

            echo 'not login';

        }
    }

    public function login_now(){

        $this->use->use_lib('site/sessions');

        $session = new sessions();

        if($session ->get_login()){

           exit;

        }else{

            $this->use->use_lib('site/students');

            $students = new students();

            echo  $students->find_student_login();
        }

    }

}