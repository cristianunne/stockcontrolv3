<?= $this->element('header')?>
<?= $this->element('sidebar')?>
    <div class="content-wrapper">
        <div class="content">
            <?= $this->Flash->render() ?>
            <div class="container">
                <div class="card">
                    <div class="card-header" style="position: relative;">
                        <h3 class="card-title">Actualización del Precio</h3>
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
                                <div class="alert bg-text-info" role="alert">
                                    <h4 class="alert-heading"><i class="fas fa-info-circle nav-icon"></i> Se actualizará el Precio de todos los Productos</h4>
                                </div>
                                <br>

                                <?= $this->Form->create(null, ['enctype' => 'multipart/form-data']) ?>


                                <div class="form-group">
                                    <?=  $this->Form->label('Procentaje (%): ') ?>
                                    <?= $this->Form->number('precio', ['class' => 'form-control', 'placeholder' => 'Procentaje (%)',
                                        'id' => 'precio',
                                        'required']) ?>
                                </div>

                                <div class="form-group" style="margin-top: 40px;">
                                    <div class="pull-right">
                                        <?= $this->Form->button("Aceptar", ['class' => 'btn bg-teal', 'escape' => false]) ?>

                                    </div>
                                    <div class="pull-left">
                                        <?= $this->Html->link("Volver", ['controller' => 'Categories', 'action' => 'index'], ['class' => 'btn bg-redrose']) ?>
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
<?= $this->Html->script('shopping_cart.js') ?>