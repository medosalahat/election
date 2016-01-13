<?php
class users_admin
{

    private $CI;

    private $use;

    public function __construct()
    {
        $this->CI = &get_instance();

        $this->use = new class_loader();
    }

    public function find_all_users(){

        $this->use->use_model('data_base');

        $this->use->use_lib('table/tpl_users');

        $tpl = new tpl_users();

        $db = new data_base(
            $tpl->table(),
            array(
                $tpl->id(),
                $tpl->username(),
            )
        );

        echo json_encode($db->get());
    }

    public function remove_user_row(){

        $this->use->use_model('data_base');

        $this->use->use_lib('table/tpl_users');

        $tpl = new tpl_users();

        $db = new data_base(
            $tpl->table(),
            array(
                $tpl->id()
            ),array(
                $tpl->id()=>$_POST['id']
            )
        );

        echo  json_encode(array('valid'=>$db->delete()));

    }

    public function add_new_user(){

        $this->use->use_model('data_base');

        $this->use->use_lib('table/tpl_users');

        $tpl = new tpl_users();

        $db = new data_base(
            $tpl->table(),
            array(
                $tpl->username()=>$_POST['username_new'],
                $tpl->password()=>md5($_POST['password_new'])
            )
        );

        echo json_encode(array('valid'=>$db->add(),'massage'=>'<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><h4>Alert!</h4> <strong>Save success </strong></div>'));
    }

    public function update_user(){

        $this->use->use_model('data_base');

        $this->use->use_lib('table/tpl_users');

        $tpl = new tpl_users();

        $data= array(
            $tpl->username()=>$_POST['username_update']
        );
        if(!empty($_POST['password_update'])){
            $data[$tpl->password()]=md5($_POST['password_update']);
        }
        $db = new data_base(
            $tpl->table(),$data,array(
                $tpl->id()=>$_POST['id']
            )
        );

        echo json_encode(array('valid'=>$db->change(),'massage'=>'<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><h4>Alert!</h4> <strong>Update success </strong></div>'));
    }
}