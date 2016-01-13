<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class date_time{

    private $CI;

    public function __construct()
    {
        $this->CI = &get_instance();

    }

    public function Time_server_12()
    {

        return  date('Y-m-d h:i:s');
    }

    public function Time_server_24()
    {

        return  date('Y-m-d H:i:s');
    }

    public function set_time($value){

        return date('Y/m/d H:i', strtotime($value));
    }

    public function change_Date($value){

        return date('d/m/Y', strtotime($value));
    }

    public function change_time($value){

        return date('Y/m/d H:i:s', strtotime($value));
    }

    public function change_time_instagram($value){

        $time =  date('d-m-Y H:i', preg_replace('/[^\d]/','', $value)).":00";

        return date('Y-m-d H:i:s', strtotime($time));

    }

    public function get_date_name_excel(){

        return date('d-m-y');
    }

    public function get_date(){

        return date('Y-m-d');
    }
    public   function get_time_trends_twitter()
    {
        return  date('Y-m-d H:i', strtotime('-15 minutes'));
    }



}