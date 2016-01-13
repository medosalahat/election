<?php
$use = new class_loader();
$use->use_lib('site/students');
$use->use_lib('site/sessions');
$use->use_lib('table/tpl_students');
$students = new students();
$tpl_students = new tpl_students();
$session = new sessions();
$data = $students->get_more_election();
$total = $students->count_all();
?>
<script src="<?=site_url('include/js/Chart.js')?>"></script>
<!-- PORTFOLIO SECTION -->
<div id="dg">
    <div class="container">
        <div class="row centered">
            <h4>Elect</h4>
            <br>

            <?PHP foreach($data as $rows){ if($rows['sum'] > 0 ){ ?>

                <div class="col-lg-3">

                    <canvas id="canvas" height="130" width="130"></canvas>
                    <br>
                    <script>
                        var doughnutData = [
                            {
                                value: <?=$total?>,
                                color:"#3498db"
                            },
                            {
                                value : <?=$rows['sum']?>,
                                color : "#ecf0f1"
                            }
                        ];
                        var myDoughnut = new Chart(document.getElementById("canvas").getContext("2d")).Doughnut(doughnutData);
                    </script>
                    <p><b><?=$rows[$tpl_students->first_name()] . ' ' . $rows[$tpl_students->first_name()]?></b></p>

                </div>
            <?PHP }} ?>

            <!-- First Chart -->

        </div><!-- row -->
    </div><!-- container -->
</div><!-- DG -->


