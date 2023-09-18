<?= $this->element('header')?>
<?= $this->element('sidebar')?>
<div class="content-wrapper">
    <div class="content">
        <?= $this->Flash->render() ?>
        <div class="container">
            <div class="card">
                <div class="card-header" style="position: relative;">
                    <h3 class="card-title">Actualización del Producto</h3>
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

                            <?= $this->Form->create($productos_pedidos, ['enctype' => 'multipart/form-data']) ?>

                            <div class="d-flex flex-row">
                                <div class="mt-1 mb-1 spec-1"><span class="text-bold">Producto:</span><span class="dot"></span>
                                    <span><?= h($producto_name) ?></span><span class="dot"></span></div>
                            </div>

                            <hr>
                            <br>
                            <div class="form-group">
                                <?=  $this->Form->label('Cantidad: ') ?>
                                <?= $this->Form->number('cantidad', ['class' => 'form-control', 'placeholder' => 'Cantidad', 'required']) ?>
                            </div>

                            <div class="form-group">
                                <?=  $this->Form->label('Precio ($/u): ') ?>
                                <?= $this->Form->number('precio_unidad', ['class' => 'form-control', 'placeholder' => 'Precio', 'required']) ?>
                            </div>

                            <div class="form-group">
                                <?=  $this->Form->label('Descuento ($/u): ') ?>
                                <?= $this->Form->number('descuento_unidad', ['class' => 'form-control', 'placeholder' => 'Descuento', 'required']) ?>
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