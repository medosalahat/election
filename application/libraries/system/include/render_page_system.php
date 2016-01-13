<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class render_page_system
{
    private $CI;

    private $temp;

    private $data;

    public function __construct()
    {
        $this->CI = &get_instance();

        $this->CI->load->library('system/users/session_user');

        $this->CI->load->library('system/users/info_user');



        $this->Name_site();

        $user = new session_user();

        if (!$user->is_login()) {

            $this->footer_page();
        }

        if ($user->is_login()) {

            $this->header_page();

            $this->column_page();

        }

    }

    public function Name_site()
    {

        $this->temp = new template_render();

        $this->temp->title('Reach 2.0');

    }


    public function footer_page()
    {

        $this->temp = new template_render('site/include/footer', 'footer');

        $this->temp->render_page();
    }

    public function header_page()
    {


        $this->temp = new template_render('site/include/header', 'header');

        $session = new session_user();

        $info_user = new info_user($session->get_id());

        $this->temp->set_data($info_user->get_name_user(),'get_name_user');

        $this->temp->set_data($info_user->get_image_user(),'get_image_user');

        $this->temp->render_page();

    }

    public function column_page()
    {

        $this->temp = new template_render('site/include/column', 'column');

        $session = new session_user();

        $info_user = new info_user($session->get_id());

        $this->temp->set_data($info_user->get_name_user(),'get_name_user');

        $this->temp->set_data($info_user->get_image_user(),'get_image_user');

        $this->temp->render_page();
    }
}