
<?= $this->Html->css('../plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css') ?>
<?= $this->element('header')?>
<?= $this->element('sidebar')?>
<div class="content-wrapper">
    <div class="content">
        <?= $this->Flash->render() ?>
        <div class="container">
            <div class="card">
                <div class="card-header" style="position: relative;">
                    <h3 class="card-title">Seleccione el empleado y las fechas de los pedidos</h3>
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

                            <?= $this->Form->create(null, ['enctype' => 'multipart/form-data']) ?>

                            <div class="form-group">
                                <?= $this->Form->control('users_idusers', ['options' => $empleados,
                                    'empty' => '(Elija un Empleado)', 'type' => 'select',
                                    'class' => 'form-control', 'placeholder' => '', 'required',
                                    'label' => 'Empleado:', 'id' => 'users_idusers']) ?>
                            </div>


                            <div class="form-group" style="margin-top: 40px;">
                                <div class="pull-right">
                                    <?= $this->Form->button("Aceptar", ['class' => 'btn bg-teal', 'escape' => false]) ?>

                                </div>
                                <div class="pull-left">
                                    <?= $this->Html->link("Volver", ['controller' => 'Campaign', 'action' => 'config'], ['class' => 'btn bg-redrose']) ?>
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
