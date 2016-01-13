<?php

class students
{

    private $CI;

    private $use;

    public function __construct()
    {
        $this->CI = &get_instance();

        $this->use = new class_loader();
    }


    public function find_elect()
    {

        $this->use->use_model('data_base');

        $this->use->use_lib('table/tpl_students');

        $this->use->use_lib('table/tpl_specialty');

        $this->use->use_lib('table/tpl_college');

        $tpl = new tpl_students();

        $tpl_college = new tpl_college();

        $tpl_specialty= new tpl_specialty();

        $db = new data_base(
            $tpl->table(),
            array(
                $tpl->id(),
                $tpl->last_name(),
                $tpl->first_name(),
                '( select ' . $tpl_college->name() . ' from ' . $tpl_college->table() . ' where ' . $tpl_college->id() . ' = ' . $tpl->table() . '.' . $tpl->id_college() . ' ) ' . $tpl->id_college(),
                '( select ' . $tpl_specialty->name() . ' from ' . $tpl_specialty->table() . ' where ' . $tpl_specialty->id() . ' = ' . $tpl->table() . '.' . $tpl->id_specialty() . ' ) ' . $tpl->id_specialty(),
                $tpl->id_students(),
                $tpl->image(),
            ), array(
                $tpl->elect() => 1,
            )
        );

        return $db->get_where();
    }

    public function find_student_login()
    {

        if (isset($_POST['number']) && isset($_POST['password'])) {

            if (!empty($_POST['number']) && !empty($_POST['password'])) {

                $this->use->use_model('data_base');

                $this->use->use_lib('table/tpl_students');

                $tpl = new tpl_students();

                $db = new data_base(
                    $tpl->table(),
                    array(
                        $tpl->id()
                    ), array(
                        $tpl->id_students() => $_POST['number'],
                        $tpl->password() => md5($_POST['password'])
                    )
                );

                $data = $db->get_where();


                if (!empty($data)) {

                    $this->use->use_lib('site/sessions');

                    $session = new sessions();

                    if($session->new_login()){

                        $session->info_user($data);

                        return json_encode(array('valid' => true, 'massage' => '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><h4>Alert!</h4> <strong>welcome Back </strong></div>'));

                    }else{

                        return json_encode(array('valid' => false, 'massage' => '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><h4>Alert!</h4> <strong>Error login</strong></div>'));
                    }



                } else {

                    return json_encode(array('valid' => false, 'massage' => '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><h4>Alert!</h4> <strong>Incorrect password or ID number </strong></div>'));

                }

            } else {

                return json_encode(array('valid' => false, 'massage' => '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><h4>Alert!</h4> <strong>The field is required and can\'t be empty</strong></div>'));
            }

        } else {

            return json_encode(array('valid' => false, 'massage' => '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><h4>Alert!</h4> <strong>The field is required and can\'t be empty</strong></div>'));
        }

    }

    public function check_elect(){

        $this->use->use_model('data_base');

        $this->use->use_lib('site/sessions');

        $this->use->use_lib('table/tpl_election');

        $tpl = new tpl_election();

        $session = new sessions();

        $id_login = array_shift(array_shift($session->get_info_user()));

        $db = new data_base(
            $tpl->table(),
            array(
                $tpl->id()
            ),array(
                $tpl->id_students()=>$id_login
            )
        );

        $data = $db->get_where();

        if(empty($data)){

            return true;

        }else{

            return false;

        }

    }

    public function new_elect(){

        if(isset($_POST['id_ele'])){

            if(!empty($_POST['id_ele'])){

                $this->use->use_model('data_base');

                $this->use->use_lib('site/sessions');

                $this->use->use_lib('table/tpl_election');

                $tpl = new tpl_election();

                $session = new sessions();

                $id_login = $session->get_info_user();

                $db = new data_base(
                    $tpl->table(),
                    array(
                        $tpl->id_elect()=>$_POST['id_ele'],
                        $tpl->id_students()=>$id_login[0]['id'],
                        $tpl->date()=>date('Y-m-d H:i:s')
                    )
                );

               $db->add();

                return true;

            }else{
                return false;
            }

        }else{

            return false;
            //isset
        }

    }

    public function get_more_election(){


        $this->use->use_model('data_base');

        $this->use->use_lib('table/tpl_students');

        $this->use->use_lib('table/tpl_election');

        $this->use->use_lib('table/tpl_specialty');

        $this->use->use_lib('table/tpl_college');

        $tpl = new tpl_students();

        $tpl_college = new tpl_college();

        $tpl_specialty = new tpl_specialty();

        $tpl_election = new tpl_election();

        $db = new data_base(
            $tpl->table(),
            array(
                $tpl->id(),
                $tpl->last_name(),
                $tpl->first_name(),
                '( select ' . $tpl_college->name() . ' from ' . $tpl_college->table() . ' where ' . $tpl_college->id() . ' = ' . $tpl->table() . '.' . $tpl->id_college() . ' ) ' . $tpl->id_college(),
                '( select ' . $tpl_specialty->name() . ' from ' . $tpl_specialty->table() . ' where ' . $tpl_specialty->id() . ' = ' . $tpl->table() . '.' . $tpl->id_specialty() . ' ) ' . $tpl->id_specialty(),
                '( select COUNT(' . $tpl_election->id() . ') from ' . $tpl_election->table() . ' where ' . $tpl_election->id_elect() . ' = ' . $tpl->table() . '.' . $tpl->id() . ' ) sum',
                $tpl->id_students(),
                $tpl->image(),
            ), array(
            $tpl->elect() => 1,
        ), '', array(
                'sum' => 'DESC'
            )
        );

        return $db->get_where_order();

    }

    public function count_all(){


        $this->use->use_model('data_base');

        $this->use->use_lib('table/tpl_election');

        $tpl = new tpl_election();

        $db = new data_base(
            $tpl->table(),array(
                $tpl->id()
            )
        );

        return count($db->get());
    }


}