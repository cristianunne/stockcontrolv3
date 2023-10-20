
<?= $this->Html->css('../plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css') ?>
<?= $this->element('header')?>
<?= $this->element('sidebar')?>
<div class="content-wrapper">
    <div class="content">
        <?= $this->Flash->render() ?>
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-xl-11 col-lg-9 col-md-9 col-sm-9">
                    <div class="card">
                        <div class="card-header" style="position: relative;">
                            <h3 class="card-title">Nueva Campaña</h3>
                            <div class="card-tools">
                                <!-- Buttons, labels, and many other things can be placed here! -->
                                <!-- Here is a label for example -->

                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-10 card box-simm-shadow" style="margin: 0 auto; padding: 1.25rem">
                                    <?= $this->Form->create($campaign, ['enctype' => 'multipart/form-data']) ?>

                                    <div class="col-md-10">

                                        <div class="form-group" id="sandbox-container">
                                            <?=  $this->Form->label('fecha', 'Fecha de Inicio: ') ?>
                                            <div class="input-append date">
                                                <input id="fecha_inicio" name="fecha_inicio" type="date" class="span2" required>
                                            </div>
                                        </div>


                                        <div class="form-group" id="sandbox-container">
                                            <?=  $this->Form->label('fecha', 'Fecha de Fin: ') ?>
                                            <div class="input-append date">
                                                <input id="fecha_fin" name="fecha_fin" type="date" class="span2" required>
                                            </div>
                                        </div>


                                    </div>


                                    <div class="form-group" style="margin-top: 40px;">
                                        <div class="pull-right">
                                            <?= $this->Form->button("Aceptar", ['class' => 'btn bg-teal', 'escape' => false]) ?>

                                        </div>
                                        <div class="pull-left">
                                            <?= $this->Html->link("Volver", ['action' => 'index'], ['class' => 'btn bg-redrose']) ?>
                                        </div>

                                    </div>

                                    <?= $this->Form->end() ?>
                                </div>

                            </div>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>


            </div>

        </div>
    </div>

    <?= $this->Html->script('shopping_cart.js') ?>

</div>
<?php
