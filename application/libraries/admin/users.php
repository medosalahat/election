<?php

class users
{

    private $CI;

    private $use;

    public function __construct()
    {
        $this->CI = &get_instance();

        $this->use = new class_loader();
    }


    public function find_users_login()
    {

        if (isset($_POST['username']) && isset($_POST['password'])) {

            if (!empty($_POST['username']) && !empty($_POST['password'])) {

                $this->use->use_model('data_base');

                $this->use->use_lib('table/tpl_users');

                $tpl = new tpl_users();

                $db = new data_base(
                    $tpl->table(),
                    array(
                        $tpl->id()
                    ), array(
                        $tpl->username() => $_POST['username'],
                        $tpl->password() => md5($_POST['password'])
                    )
                );

                $data = $db->get_where();


                if (!empty($data)) {

                    $this->use->use_lib('site/sessions');

                    $session = new sessions();

                    if($session->new_login_admin()){

                        $session->info_user($data);

                        return json_encode(array('valid' => true, 'massage' => '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><h4>Alert!</h4> <strong>welcome Back </strong></div>'));

                    }else{

                        return json_encode(array('valid' => false, 'massage' => '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><h4>Alert!</h4> <strong>Error login</strong></div>'));
                    }



                } else {

                    return json_encode(array('valid' => false, 'massage' => '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><h4>Alert!</h4> <strong>Incorrect password or username </strong></div>'));

                }

            } else {

                return json_encode(array('valid' => false, 'massage' => '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><h4>Alert!</h4> <strong>The field is required and can\'t be empty</strong></div>'));
            }

        } else {

            return json_encode(array('valid' => false, 'massage' => '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><h4>Alert!</h4> <strong>The field is required and can\'t be empty</strong></div>'));
        }

    }

}