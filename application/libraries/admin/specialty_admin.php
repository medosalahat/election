<?php
class specialty_admin
{

    private $CI;

    private $use;

    public function __construct()
    {
        $this->CI = &get_instance();

        $this->use = new class_loader();
    }

    public function find_all_specialty(){

        $this->use->use_model('data_base');

        $this->use->use_lib('table/tpl_specialty');
        $this->use->use_lib('table/tpl_college');

        $tpl_specialty = new tpl_specialty();

        $tpl_college = new tpl_college();

        $db = new data_base(
            $tpl_specialty->table(),
            array(
                $tpl_specialty->id(),
                '(select '.$tpl_college->name().' from '.$tpl_college->table().' where '.$tpl_college->table().'.'.$tpl_college->id().' = '.$tpl_specialty->table().'.'.$tpl_specialty->id_college().') '.$tpl_specialty->id_college().'_name',
                $tpl_specialty->id_college(),
                $tpl_specialty->name(),
            )
        );

        echo json_encode($db->get());
    }


    public function find_all_specialty_select(){

        $this->use->use_model('data_base');

        $this->use->use_lib('table/tpl_specialty');

        $tpl_specialty = new tpl_specialty();

        $db = new data_base(
            $tpl_specialty->table(),
            array(
                $tpl_specialty->id(),
                $tpl_specialty->name(),
            ),array(
                $tpl_specialty->id_college()=>$_POST['id_college']
            )
        );

        $data = $db->get_where();

        $w = '<option value="">Select Specialty</option>';

        foreach($data as $row){

            $w=$w.'<option value="'.$row[$tpl_specialty->id()].'">'.$row[$tpl_specialty->name()].'</option>';

        }

        return $w;
    }

    public function remove_specialty_row(){

        $this->use->use_model('data_base');

        $this->use->use_lib('table/tpl_specialty');

        $tpl = new tpl_specialty();

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

    public function add_new_specialty(){

        $this->use->use_model('data_base');

        $this->use->use_lib('table/tpl_specialty');

        $tpl = new tpl_specialty();

        $db = new data_base(
            $tpl->table(),
            array(
                $tpl->id_college()=>$_POST['name_college'],
                $tpl->name()=>$_POST['name_Specialty']
            )
        );

        echo json_encode(array('valid'=>$db->add(),'massage'=>'<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><h4>Alert!</h4> <strong>Save success </strong></div>'));
    }

    public function update_specialty(){

        $this->use->use_model('data_base');

        $this->use->use_lib('table/tpl_specialty');

        $tpl = new tpl_specialty();

        $db = new data_base(
            $tpl->table(),
            array(
                $tpl->id_college()=>$_POST['name_college_update'],
                $tpl->name()=>$_POST['name_update']
            ),array(
                $tpl->id()=>$_POST['id']
            )
        );

        echo json_encode(array('valid'=>$db->change(),'massage'=>'<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><h4>Alert!</h4> <strong>Update success </strong></div>'));
    }
}