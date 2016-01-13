<?php
class college_admin
{

    private $CI;

    private $use;

    public function __construct()
    {
        $this->CI = &get_instance();

        $this->use = new class_loader();
    }

    public function find_all_college(){

        $this->use->use_model('data_base');

        $this->use->use_lib('table/tpl_college');

        $tpl_college = new tpl_college();

        $db = new data_base(
            $tpl_college->table(),
            array(
                $tpl_college->id(),
                $tpl_college->name(),
            )
        );

        echo json_encode($db->get());
    }


    public function find_all_college_select(){

        $this->use->use_model('data_base');

        $this->use->use_lib('table/tpl_college');

        $tpl_college = new tpl_college();

        $db = new data_base(
            $tpl_college->table(),
            array(
                $tpl_college->id(),
                $tpl_college->name(),
            )
        );

        return $db->get();
    }

    public function remove_college_row(){

        $this->use->use_model('data_base');

        $this->use->use_lib('table/tpl_college');

        $tpl = new tpl_college();

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

    public function add_new_college(){

        $this->use->use_model('data_base');

        $this->use->use_lib('table/tpl_college');

        $tpl = new tpl_college();

        $db = new data_base(
            $tpl->table(),
            array(
                $tpl->name()=>$_POST['name_college']
            )
        );

        echo json_encode(array('valid'=>$db->add(),'massage'=>'<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><h4>Alert!</h4> <strong>Save success </strong></div>'));
    }

    public function update_college(){

        $this->use->use_model('data_base');

        $this->use->use_lib('table/tpl_college');

        $tpl = new tpl_college();

        $db = new data_base(
            $tpl->table(),
            array(
                $tpl->name()=>$_POST['name_update']
            ),array(
                $tpl->id()=>$_POST['id']
            )
        );

        echo json_encode(array('valid'=>$db->change(),'massage'=>'<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><h4>Alert!</h4> <strong>Update success </strong></div>'));
    }
}