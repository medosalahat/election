<?php

//election_admin
class election_admin
{

    private $CI;

    private $use;

    public function __construct()
    {
        $this->CI = &get_instance();

        $this->use = new class_loader();
    }

    public function find_more_election()
    {

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

    public function count_election(){

        $this->use->use_model('data_base');

        $this->use->use_lib('table/tpl_election');

        $tpl_election = new tpl_election();

        $db = new data_base($tpl_election->table(),array($tpl_election->id()));

        return count($db->get());

    }


    public function find_all_election()
    {

        $this->use->use_model('data_base');

        $this->use->use_lib('table/tpl_students');

        $this->use->use_lib('table/tpl_election');

        $tpl = new tpl_students();

        $tpl_election = new tpl_election();

        $db = new data_base(
            $tpl_election->table(),
            array(
                $tpl_election->id(),
                '(select ' . $tpl->first_name() . ' from ' . $tpl->table() . ' where ' . $tpl->table() . '.' . $tpl->id() . ' = ' . $tpl_election->table() . '.' . $tpl_election->id_elect() . ') ' . $tpl->first_name() . '_' . $tpl->elect(),
                '(select ' . $tpl->last_name() . ' from ' . $tpl->table() . ' where ' . $tpl->table() . '.' . $tpl->id() . ' = ' . $tpl_election->table() . '.' . $tpl_election->id_elect() . ') ' . $tpl->last_name() . '_' . $tpl->elect(),
                '(select ' . $tpl->first_name() . ' from ' . $tpl->table() . ' where ' . $tpl->table() . '.' . $tpl->id() . ' = ' . $tpl_election->table() . '.' . $tpl_election->id_students() . ') ' . $tpl->first_name(),
                '(select ' . $tpl->last_name() . ' from ' . $tpl->table() . ' where ' . $tpl->table() . '.' . $tpl->id() . ' = ' . $tpl_election->table() . '.' . $tpl_election->id_students() . ') ' . $tpl->last_name(),
                $tpl_election->id_students()
            ), '', '', array(
                $tpl_election->date() => 'DESC'
            )
        );

        echo json_encode($db->get());
    }

    public function remove_election_row(){

        $this->use->use_model('data_base');

        $this->use->use_lib('table/tpl_election');

        $tpl = new tpl_election();

        $db = new data_base(
            $tpl->table(),
            array(
                $tpl->id()
            ),array(
                $tpl->id()=>$_POST['id']
            )
        );

        return json_encode(array('valid'=>$db->delete()));
    }
}