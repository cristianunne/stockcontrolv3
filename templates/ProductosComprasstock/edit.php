<?= $this->element('header')?>
<?= $this->element('sidebar')?>
<div class="content-wrapper">
    <div class="content">
        <?= $this->Flash->render() ?>
        <div class="container">
            <div class="card">
                <div class="card-header" style="position: relative;">
                    <h3 class="card-title">Agregar Producto</h3>
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

                            <?= $this->Form->create($productos_compras, ['enctype' => 'multipart/form-data']) ?>

                            <div class="form-group">
                                <?=  $this->Form->label('Compra N°: ') ?>
                                <?= $this->Form->number('comprasstock_idcomprasstock', ['class' => 'form-control', 'readonly', 'placeholder' => 'Compra N°',
                                    'value' => $id_compras_stock]) ?>
                            </div>

                            <div class="form-group">
                                <?=  $this->Form->label('Producto: ') ?>
                                <?= $this->Form->control('prod', ['class' => 'form-control', 'placeholder' => 'Producto',
                                    'label' => false, 'readonly',
                                    'value' => $producto]) ?>
                            </div>

                            <div class="form-group">
                                <?=  $this->Form->label('Cantidad: ') ?>
                                <?= $this->Form->number('cantidad_pedido', ['class' => 'form-control', 'required',
                                    'oninput' => 'this.value = Math.round(this.value);',
                                    'placeholder' => 'Cantidad']) ?>
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