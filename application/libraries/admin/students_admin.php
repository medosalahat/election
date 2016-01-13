<?php
class students_admin
{

    private $CI;

    private $use;

    public function __construct()
    {
        $this->CI = &get_instance();

        $this->use = new class_loader();
    }

    public function find_all_students(){

        $this->use->use_model('data_base');

        $this->use->use_lib('table/tpl_students');
        $this->use->use_lib('table/tpl_specialty');
        $this->use->use_lib('table/tpl_college');

        $tpl = new tpl_students();

        $tpl_specialty = new tpl_specialty();

        $tpl_college = new tpl_college();

        $db = new data_base(
            $tpl->table(),
            array(
                $tpl->id(),
                '(select '.$tpl_college->name().' from '.$tpl_college->table().' where '.$tpl_college->table().'.'.$tpl_college->id().' = '.$tpl->table().'.'.$tpl->id_college().') '.$tpl->id_college().'_name',
                '(select '.$tpl_specialty->name().' from '.$tpl_specialty->table().' where '.$tpl_specialty->table().'.'.$tpl_specialty->id().' = '.$tpl->table().'.'.$tpl->id_specialty().') '.$tpl->id_specialty().'_name',
                $tpl->id_students(),
                $tpl->id_college(),
                $tpl->id_specialty(),
                $tpl->first_name(),
                $tpl->last_name(),
                $tpl->elect(),
                $tpl->image(),
            )
        );

        echo json_encode($db->get());
    }

    public function remove_students_row(){

        $this->use->use_model('data_base');

        $this->use->use_lib('table/tpl_students');

        $tpl = new tpl_students();

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

    public function add_new_students(){

        $this->use->use_model('data_base');

        $this->use->use_lib('table/tpl_students');

        $tpl = new tpl_students();

        $db = new data_base(
            $tpl->table(),
            array(
                $tpl->id_students()=>$_POST['id_student_n'],
                $tpl->first_name()=>$_POST['first_name_n'],
                $tpl->last_name()=>$_POST['last_name_n'],
                $tpl->id_college()=>$_POST['name_college_n'],
                $tpl->id_specialty()=>$_POST['name_specialty_n'],
                $tpl->password()=>md5($_POST['password_n']),
                $tpl->elect()=>0,
                $tpl->image()=>0,
            )
        );

        echo json_encode(array('valid'=>$db->add(),'massage'=>'<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><h4>Alert!</h4> <strong>Save success </strong></div>'));
    }

    public function update_students(){

        $this->use->use_model('data_base');

        $this->use->use_lib('table/tpl_students');

        $tpl = new tpl_students();

        $data = array(
            $tpl->id_students()=>$_POST['id_student_u'],
            $tpl->first_name()=>$_POST['first_name_u'],
            $tpl->last_name()=>$_POST['last_name_u'],
            $tpl->id_college()=>$_POST['name_college_u'],
        );

        if(!empty($_POST['password_u'])){
            $data[$tpl->password()]=md5($_POST['password_u']);
        }

        if(!empty($_POST['name_specialty_u'])){
            $data[$tpl->id_specialty()]=$_POST['name_specialty_u'];
        }

        $db = new data_base(
            $tpl->table(),$data,array(
                $tpl->id()=>$_POST['id_update']
            )
        );

        echo json_encode(array('valid'=>$db->change(),'massage'=>'<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><h4>Alert!</h4> <strong>Update success </strong></div>'));
    }

    public function update_students_elect(){

        $this->use->use_model('data_base');

        $this->use->use_lib('table/tpl_students');

        $tpl = new tpl_students();

        $db = new data_base(
            $tpl->table(),
            array(
                $tpl->elect()=>$_POST['elect']
            ),array(
                $tpl->id()=>$_POST['id']
            )
        );

        echo json_encode(array('valid'=>$db->change(),'massage'=>'<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><h4>Alert!</h4> <strong>Update success </strong></div>'));
    }

    public function update_image_students(){

        $this->use->use_model('data_base');

        $this->use->use_lib('table/tpl_students');

        $this->use->use_lib('system/image/class_upload_image');

        $tpl = new tpl_students();

        $image = new class_upload_image('image_students_update', 'include/img/student');

        if ($image->get_type() == 'image/png' || $image->get_type() == 'image/jpeg'){
            if ($image->get_error()){
                   $image_path = $image->move_file();
                    if ($image_path == false) {
                        echo json_encode(array('valid' => false));
                    } else {

                        $db = new data_base(
                            $tpl->table(),
                            array(
                                $tpl->image()=>$image_path
                            ),array(
                                $tpl->id()=>$_POST['id_image_update']
                            )
                        );

                        if($db->change()) {

                            echo json_encode(array('valid' => true, 'image' => $image_path));
                        }else{
                            echo json_encode(array('valid' => false));
                        }
                    }
            }else{
                echo json_encode(array('valid' => false));
            }
        }else{
            echo json_encode(array('valid' => false));
        }



    }
}