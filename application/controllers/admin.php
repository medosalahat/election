<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin extends CI_Controller {


    private $use;

    public function __construct(){

        parent::__construct();

        $this->use = new class_loader();

    }

    public function index(){

        $this->use->use_lib('site/sessions');

        $session = new sessions();

        if($session->get_login_admin()){

            $this->use->use_lib('admin/render_admin');

            $page= new render_admin();

            $page->page_index();

        }else{

           $this->login();

        }

    }

    public function login(){

        $this->use->use_lib('admin/render_admin');

        $page= new render_admin();

        $page->page_login();

    }

    public function login_now(){


        $this->use->use_lib('site/sessions');

        $session = new sessions();

        if($session ->get_login_admin()){

           $this->index();

        }else{

            $this->use->use_lib('admin/users');

            $students = new users();

            echo  $students->find_users_login();
        }

    }

    public function logout(){

        $this->use->use_lib('site/sessions');

        $session = new sessions();

        if($session ->get_login_admin()){

            $session->remove_login_admin();

            redirect(site_url('admin'));

        }else{

            redirect(site_url('admin'));

        }

    }


    public function election(){

        $this->use->use_lib('admin/render_admin');

        $page= new render_admin();

        $page->page_election();

    }

    public function college(){

        $this->use->use_lib('admin/render_admin');

        $page= new render_admin();

        $page->page_college();

    }

    public function specialty(){

        $this->use->use_lib('admin/render_admin');

        $page= new render_admin();

        $page->page_specialty();

    }

    public function students(){

        $this->use->use_lib('admin/render_admin');

        $page= new render_admin();

        $page->page_students();

    }

    public function slider(){

        $this->use->use_lib('admin/render_admin');

        $page= new render_admin();

        $page->page_slider();

    }

    public function users(){

        $this->use->use_lib('admin/render_admin');

        $page= new render_admin();

        $page->page_users();

    }


    public function find_election_table_ajax(){


        $this->use->use_lib('admin/election_admin');

        $page= new election_admin();

        $page->find_all_election();

    }

    public function remove_election_row(){

        $this->use->use_lib('admin/election_admin');

        $page= new election_admin();

        $page->remove_election_row();

    }

    /** college*/
    public function find_all_college_table_ajax(){

        $this->use->use_lib('admin/college_admin');

        $page= new college_admin();

        $page->find_all_college();

    }

    public function remove_college_row(){

        $this->use->use_lib('admin/college_admin');

        $page= new college_admin();

        $page->remove_college_row();

    }

    public function add_new_college(){

        $this->use->use_lib('admin/college_admin');

        $page= new college_admin();

        $page->add_new_college();

    }

    public function update_college(){

        $this->use->use_lib('admin/college_admin');

        $page= new college_admin();

        $page->update_college();

    }
    /**end college*/


    /** specialty*/

    public function find_all_Specialty_table_ajax(){

        $this->use->use_lib('admin/specialty_admin');

        $page= new specialty_admin();

        $page->find_all_Specialty();

    }

    public function remove_Specialty_row(){

        $this->use->use_lib('admin/specialty_admin');

        $page= new specialty_admin();

        $page->remove_specialty_row();

    }

    public function add_new_Specialty(){

        $this->use->use_lib('admin/specialty_admin');

        $page= new specialty_admin();

        $page->add_new_specialty();

    }

    public function update_Specialty(){

        $this->use->use_lib('admin/specialty_admin');

        $page= new specialty_admin();

        $page->update_specialty();

    }

    public function find_specialty_select_lest(){

        $this->use->use_lib('admin/specialty_admin');

        $page= new specialty_admin();

        echo $page->find_all_specialty_select();
    }

    /** End specialty*/

    /** students*/

    public function find_all_Students_table_ajax(){

        $this->use->use_lib('admin/students_admin');

        $page= new students_admin();

        $page->find_all_students();

    }

    public function remove_Students_row(){

        $this->use->use_lib('admin/students_admin');

        $page= new students_admin();

        $page->remove_students_row();

    }

    public function add_new_Students(){

        $this->use->use_lib('admin/students_admin');

        $page= new students_admin();

        $page->add_new_students();

    }

    public function update_Students(){

        $this->use->use_lib('admin/students_admin');

        $page= new students_admin();

        $page->update_students();

    }

    public function update_students_elect(){

        $this->use->use_lib('admin/students_admin');

        $page= new students_admin();

        $page->update_students_elect();



    }

    public function image_student(){

        $this->use->use_lib('admin/students_admin');

        $page= new students_admin();

        $page->update_image_students();
    }


    /** End students*/

    public function find_all_slider_table_ajax(){

        $this->use->use_lib('admin/slider_admin');

        $page= new slider_admin();

        $page->find_all_slider();

    }

    public function update_status_slider(){

        $this->use->use_lib('admin/slider_admin');

        $page= new slider_admin();

        $page->update_status_slider();
    }

    public function image_slider(){

        $this->use->use_lib('admin/slider_admin');

        $page= new slider_admin();

        $page->update_image_students();
    }

    public function add_new_slider(){

        $this->use->use_lib('admin/slider_admin');

        $page= new slider_admin();

        $page->add_new_slider();

    }

    public function update_slider(){

        $this->use->use_lib('admin/slider_admin');

        $page= new slider_admin();

        $page->update_slider();
    }


    /** end slider*/

    /**users*/

    public function find_all_users_table_ajax(){

        $this->use->use_lib('admin/slider_admin');

        $page= new users_admin();

        $page->find_all_users();

    }

    public function remove_user(){

        $this->use->use_lib('admin/users_admin');

        $page= new users_admin();

        $page->remove_user_row();

    }

    public function update_user(){
        $this->use->use_lib('admin/users_admin');

        $page= new users_admin();

        $page->update_user();
    }

    public function new_user(){
        $this->use->use_lib('admin/users_admin');

        $page= new users_admin();

        $page->add_new_user();
    }

}