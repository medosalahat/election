<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class render_pages
{
    private $CI;

    private $temp;

    public function __construct()
    {
        $this->CI = &get_instance();
    }

    public function page_home(){

        $this->temp = new template_render('site/home','content');

        $this->temp->render_page();

        $this->temp->name_page('Home');

        $this->temp->render();

    }

    public function page_about(){

        $this->temp = new template_render('site/about','content');

        $this->temp->render_page();

        $this->temp->name_page('About');

        $this->temp->render();

    }

    public function page_elect(){

        $this->temp = new template_render('site/elect','content');

        $this->temp->render_page();

        $this->temp->name_page('Elect');

        $this->temp->render();

    }


}