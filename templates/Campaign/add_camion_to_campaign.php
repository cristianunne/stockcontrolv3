
<?= $this->Html->css('../plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css') ?>
<?= $this->element('header')?>
<?= $this->element('sidebar')?>
<div class="content-wrapper">
    <div class="content">
        <?= $this->Flash->render() ?>
        <div class="container">
            <div class="card">
                <div class="card-header" style="position: relative;">
                    <h3 class="card-title">Crear una nueva Categoria</h3>
                    <div class="card-tools">
                        <!-- Buttons, labels, and many other things can be placed here! -->
                        <!-- Here is a label for example -->

                    </div>
                    <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 card box-simm-shadow" style="margin: 0 auto; padding: 1.25rem">

                            <?= $this->Form->create($stock_camp_cam, ['enctype' => 'multipart/form-data']) ?>

                            <div class="form-group">
                                <?=  $this->Form->label('Campaña N°: ') ?>
                                <?= $this->Form->number('campaign_idcampaign', ['class' => 'form-control', 'value' => $campaign_idcampaign , 'readonly' ,'placeholder' => 'Campaña', 'required']) ?>
                            </div>

                            <div class="form-group">
                                <?= $this->Form->control('camion_idcamion', ['options' => $camiones,
                                    'empty' => '(Elija un Camion)', 'type' => 'select',
                                    'class' => 'form-control', 'placeholder' => '', 'required',
                                    'label' => 'Camion:', 'id' => 'camion_idcamion']) ?>
                            </div>

                            <div class="form-group">
                                <?= $this->Form->control('users_idusers', ['options' => $users,
                                    'empty' => '(Elija un Empleado)', 'type' => 'select',
                                    'class' => 'form-control', 'placeholder' => '', 'required',
                                    'label' => 'Empleado:', 'id' => 'users_idusers']) ?>
                            </div>


                            <div class="form-group" style="margin-top: 40px;">
                                <div class="pull-right">
                                    <?= $this->Form->button("Aceptar", ['class' => 'btn bg-teal', 'escape' => false]) ?>

                                </div>
                                <div class="pull-left">
                                    <?= $this->Html->link("Volver", ['controller' => 'Campaign', 'action' => 'config', $campaign_idcampaign], ['class' => 'btn bg-redrose']) ?>
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


    <?= $this->Html->script('shopping_cart.js') ?>

</div>



