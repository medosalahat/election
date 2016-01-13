<link href="<?= site_url('include/css/signin.css') ?>" rel="stylesheet">
<div class="container">
    <div class="col-sm-offset-3 col-sm-5">
        <form role="form" action="<?= site_url('admin/login_now') ?>" method="post" id="login_admin">
            <div class="row" style="margin-bottom: 15px;">
                <div class="form-group">
                    <div class="col-sm-3">
                        <label>Username</label>
                    </div>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="username" name="username"/>
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
</div> <!-- /container -->


<script type="text/javascript">
    $(document).ready(function () {

        $('#login_admin').bootstrapValidator({
            message: 'This value is not valid',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                username: {
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
<style>
    .glyphicon-ok {
        position: absolute;
        right: 25px;
        top: 8px;
        color: green;
    }

    .glyphicon-remove{
        position: absolute;
        right: 25px;
        top: 8px;
        color: #B94A48;
    }
</style>
