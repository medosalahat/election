<?php
$use = new class_loader();
$use->use_lib('site/students');
$use->use_lib('site/sessions');
$use->use_lib('table/tpl_students');
$students = new students();
$tpl_students = new tpl_students();
$session = new sessions();
?>

<div class="container w">
    <div class="row centered">
        <br><br>
        <h4>Students</h4>
        <hr>
        <br><br>
        <?php foreach ($students->find_elect() as $row): ?>
            <div class="col-lg-4 form-control-row">
                <img src="<?= site_url($row[$tpl_students->image()]) ?>" class="img-responsive"/>
                <h4><?= $row[$tpl_students->first_name()] . ' ' . $row[$tpl_students->first_name()] ?></h4>

                <p><?= $row[$tpl_students->id_college()] ?>.</p>
                <?PHP if ($session->get_login()) { ?>
                    <button class="btn btn-primary btn-block elect_student"
                            data-id-student="<?= $row[$tpl_students->id()] ?>">Elect
                    </button>
                <?PHP } else { ?>
                    <button class="btn btn-success btn-block first_login"
                            data-id-student="<?= $row[$tpl_students->id()] ?>">Elect (
                        <small>
                            <li class="glyphicon glyphicon-log-in"></li>
                            SingIn
                        </small>
                        )
                    </button>
                <?PHP } ?>
                <span id="elect_<?= $row[$tpl_students->id_students()]?>"></span>
            </div><!-- col-lg-4 -->
        <?PHP endforeach; ?>
    </div>
    <!-- row -->

</div><!-- container -->

<?PHP if ($session->get_login()) { ?>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.elect_student').click(function () {

                var id = $(this).attr('data-id-student');
                $.post('<?=site_url('site/check_elect')?>', {id_ele:id}, function (result) {
                    var data = JSON.parse(result);
                    if (data['valid']) {

                        $('#elect_'+id).html(data['massage']);
                    }
                    else {
                        $('#elect_'+id).html(data['massage']);
                    }
                }).fail(function () {
                    alert('error');
                });
            });
        });
    </script>
<?PHP } else { ?>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.first_login').click(function () {
                //alert($(this).attr('data-id-student'));

                $('#login_modal').modal('show');
            });

            $('#login_student').bootstrapValidator({
                message: 'This value is not valid',
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    number: {
                        validators: {
                            notEmpty: {
                                message: 'The field is required and can\'t be empty'
                            }
                        }
                    }, password: {
                        validators: {
                            notEmpty: {
                                message: 'The field is required and can\'t be empty'
                            }
                        }
                    }
                }
            })
                .on('success.form.bv', function (e) {
                    $('#massage_results').html('');
                    e.preventDefault();
                    var $form = $(e.target);
                    var bv = $form.data('bootstrapValidator');
                    $.post($form.attr('action'), $form.serialize(), function (result) {
                        var data = JSON.parse(result);
                        if (data['valid']) {
                            location.reload();
                        }
                        else {
                            $('#massage').html(data['massage']);
                        }
                    }).fail(function () {
                        alert('error');
                    });
                });

        });
    </script>

    <div class="modal fade" id="login_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" style="width:470px;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Login Now</h4>
                </div>
                <div class="modal-body">
                    <div class="row centered">
                        <div class="col-sm-12 ">
                            <form role="form" action="<?= site_url('site/login_now') ?>" method="post"
                                  id="login_student">
                                <div class="row" style="margin-bottom: 15px;">
                                <div class="form-group">
                                    <div class="col-sm-3">
                                        <label>ID Number</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control" id="number" name="number"/>
                                    </div>
                                </div>
                                </div>
                                <div class="row" style="margin-bottom: 15px;">
                                <div class="form-group">
                                    <div class="col-sm-3">
                                        <label>Password</label>
                                    </div>
                                    <div class="col-sm-9">

                                        <input type="password" class="form-control" id="password" name="password"/>

                                    </div>
                                </div>
                                </div>
                                <div class="row" style="margin-bottom: 15px;">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-success btn-block" name="login_now">
                                            Login now
                                        </button>
                                    </div>
                                </div>
                                </div>

                                <div class="row" style="margin-bottom: 15px;">

                                    <div class="col-sm-12" id="massage">
                                    </div>

                                </div>
                            </form>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
<?PHP } ?>

