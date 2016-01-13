<?php
class sessions{


    private $use;

    public function __construct()
    {
        $this->CI = &get_instance();

        $this->use = new class_loader();

        $this->use->use_lib('session');

    }

    public function get_login_admin(){

        if($this->CI->session->userdata('login_admin')){

            return true;
        }

        return false;
    }

    public function remove_login_admin(){

        $this->CI->session->set_userdata('login_admin',false);

        $this->CI->session->unset_userdata('login_admin');

        return true;

    }

    public function new_login_admin(){

        $this->CI->session->set_userdata('login_admin',true);

        return true;

    }

    public function get_login(){

        if($this->CI->session->userdata('login_student')){

            return true;
        }

        return false;
    }


    public function new_login(){

        $this->CI->session->set_userdata('login_student',true);

        return true;

    }

    public function info_user($data_user){

        $this->CI->session->set_userdata('info_user',$data_user);

        return true;

    }

    public function get_info_user(){

        return $this->CI->session->userdata('info_user');

    }



    public function remove_login(){

        $this->CI->session->set_userdata('login_student',false);

        $this->CI->session->unset_userdata('login_student');

        return true;

    }
}