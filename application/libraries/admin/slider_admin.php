<?php

class slider_admin
{

    private $CI;

    private $use;

    public function __construct()
    {
        $this->CI = &get_instance();

        $this->use = new class_loader();
    }

    public function find_all_slider()
    {

        $this->use->use_model('data_base');

        $this->use->use_lib('table/tpl_slider');

        $tpl_college = new tpl_slider();

        $db = new data_base(
            $tpl_college->table(),
            array(
                $tpl_college->id(),
                $tpl_college->image(),
                $tpl_college->text(),
                $tpl_college->status(),
            )
        );

        echo json_encode($db->get());
    }


    public function find_all_college_select()
    {

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

    public function remove_slider_row()
    {

        $this->use->use_model('data_base');

        $this->use->use_lib('table/tpl_slider');

        $tpl = new tpl_slider();

        $db = new data_base(
            $tpl->table(),
            array(
                $tpl->id()
            ), array(
                $tpl->id() => $_POST['id']
            )
        );

        echo json_encode(array('valid' => $db->delete()));

    }

    public function add_new_slider()
    {

        $this->use->use_model('data_base');

        $this->use->use_lib('table/tpl_slider');

        $tpl = new tpl_slider();

        $db = new data_base(
            $tpl->table(),
            array(
                $tpl->text() => $_POST['text_n'],
                $tpl->status() =>0,
                $tpl->image() =>0
            )
        );

        echo json_encode(array('valid' => $db->add(), 'massage' => '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><h4>Alert!</h4> <strong>Save success </strong></div>'));
    }

    public function update_slider()
    {

        $this->use->use_model('data_base');

        $this->use->use_lib('table/tpl_slider');

        $tpl = new tpl_slider();

        $db = new data_base(
            $tpl->table(),
            array(
                $tpl->text() => $_POST['text_update']
            ), array(
                $tpl->id() => $_POST['id_update']
            )
        );

        echo json_encode(array('valid' => $db->change(), 'massage' => '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><h4>Alert!</h4> <strong>Update success </strong></div>'));
    }

    public function update_status_slider()
    {

        $this->use->use_model('data_base');

        $this->use->use_lib('table/tpl_slider');

        $tpl = new tpl_slider();

        $db = new data_base(
            $tpl->table(),
            array(
                $tpl->status() => $_POST['status']
            ), array(
                $tpl->id() => $_POST['id']
            )
        );

        echo json_encode(array('valid' => $db->change(), 'massage' => '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><h4>Alert!</h4> <strong>Update success </strong></div>'));
    }

    public function update_image_students()
    {

        $this->use->use_model('data_base');

        $this->use->use_lib('table/tpl_slider');

        $this->use->use_lib('system/image/class_upload_image');

        $tpl = new tpl_slider();

        $image = new class_upload_image('image_update', 'include/img/slider');

        if ($image->get_type() == 'image/png' || $image->get_type() == 'image/jpeg') {
            if ($image->get_error()) {
                $image_path = $image->move_file();
                if ($image_path == false) {
                    echo json_encode(array('valid' => false));
                } else {

                    $db = new data_base(
                        $tpl->table(),
                        array(
                            $tpl->image() => $image_path
                        ), array(
                            $tpl->id() => $_POST['id_image_update']
                        )
                    );

                    if ($db->change()) {

                        echo json_encode(array('valid' => true, 'image' => $image_path));
                    } else {
                        echo json_encode(array('valid' => false));
                    }
                }
            } else {
                echo json_encode(array('valid' => false));
            }
        } else {
            echo json_encode(array('valid' => false));
        }


    }
}