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
                                <h4 class="alert-heading"><i class="fas fa-info-circle nav-icon"></i> Último Precio de Compra Informado </h4>
                                <p class="text-darkbluestock"><?= h('$ '. $last_price) ?></p>
                            </div>
                            <br>

                            <?= $this->Form->create($precio, ['enctype' => 'multipart/form-data']) ?>

                            <div class="form-group">
                                <?=  $this->Form->label('Precio de Compra ($): ') ?>
                                <?= $this->Form->number('precio_informado', ['class' => 'form-control',
                                    'id' => 'precio_informado',
                                    'placeholder' => 'Precio', 'readonly', 'value' => $last_price]) ?>
                            </div>

                            <div class="form-group">
                                <?=  $this->Form->label('Impuestos (%): ') ?>
                                <?= $this->Form->number('impuestos', ['class' => 'form-control', 'placeholder' => 'Impuestos (%)',
                                    'input' => 'impuestos',
                                    'id' => 'impuestos',
                                    'onchange' => 'calculateUtility(this)']) ?>
                            </div>

                            <div class="form-group">
                                <?=  $this->Form->label('Utilidad (%): ') ?>
                                <?= $this->Form->number('utilidad', ['class' => 'form-control', 'placeholder' => 'Utilidad (%)',
                                    'input' => 'utilidad',
                                    'id' => 'utilidad',
                                    'onchange' => 'calculateUtility(this)']) ?>
                            </div>

                            <br>

                            <div class="form-group">
                                <?=  $this->Form->label('Precio ($): ') ?>
                                <?= $this->Form->number('precio', ['class' => 'form-control', 'placeholder' => 'Precio ($)',
                                    'id' => 'precio',
                                    'required']) ?>
                            </div>

                            <div class="form-group" style="margin-top: 40px;">
                                <div class="pull-right">
                                    <?= $this->Form->button("Aceptar", ['class' => 'btn bg-teal', 'escape' => false]) ?>

                                </div>
                                <div class="pull-left">
                                    <?= $this->Html->link("Volver", ['controller' => 'Productos', 'action' => 'viewConfig',$id_productos], ['class' => 'btn bg-redrose']) ?>
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