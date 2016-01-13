<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class render_admin
{
    private $CI;

    private $temp;

    public function __construct()
    {
        $this->CI = &get_instance();
    }

    public function page_index(){

        $this->temp = new template_render_ajax('admin/index','content');

        $this->temp->render_page();

        $this->temp->name_page('Welcome To site');

        $this->temp->render();

    }

    public function page_election(){

        $this->temp = new template_render_ajax('admin/election','content');

        $this->temp->render_page();

        $this->temp->name_page('Election');

        $this->temp->render();

    }

    public function page_college(){

        $this->temp = new template_render_ajax('admin/college','content');

        $this->temp->render_page();

        $this->temp->name_page('College');

        $this->temp->render();

    }

    public function page_specialty(){

        $this->temp = new template_render_ajax('admin/specialty','content');

        $this->temp->render_page();

        $this->temp->name_page('specialty');

        $this->temp->render();

    }

    public function page_students(){

        $this->temp = new template_render_ajax('admin/students','content');

        $this->temp->render_page();

        $this->temp->name_page('Students');

        $this->temp->render();

    }

    public function page_slider(){

        $this->temp = new template_render_ajax('admin/slider','content');

        $this->temp->render_page();

        $this->temp->name_page('slider');

        $this->temp->render();

    }


    public function page_users(){

        $this->temp = new template_render_ajax('admin/users','content');

        $this->temp->render_page();

        $this->temp->name_page('users');

        $this->temp->render();

    }

    public function page_login(){

        $this->temp = new template_render_ajax('admin/login','content');

        $this->temp->render_page();

        $this->temp->name_page('login admin');

        $this->temp->render();

    }

    public function page_elect(){

        $this->temp = new template_render('site/elect','content');

        $this->temp->render_page();

        $this->temp->name_page('Elect');

        $this->temp->render();

    }


}