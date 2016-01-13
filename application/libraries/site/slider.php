<?php
class slider{

    private $CI;

    private $use;

    public function __construct()
    {
        $this->CI = &get_instance();

        $this->use = new class_loader();
    }


    public function find_slider(){

        $this->use->use_model('data_base');

        $this->use->use_lib('table/tpl_slider');

        $tpl = new tpl_slider();




        $db = new data_base(
            $tpl->table(),
            array(
                $tpl->id(),
                $tpl->text(),
                $tpl->image(),
            ),array(
                $tpl->status()=>1,
            )
        );

        return $db->get_where();
    }

}