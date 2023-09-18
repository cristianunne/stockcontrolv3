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

                            <?= $this->Form->create($prod_ped, ['enctype' => 'multipart/form-data']) ?>

                            <div class="form-group">
                                <?=  $this->Form->label('Pedido N°: ') ?>
                                <?= $this->Form->number('pedidos_idpedidos', ['class' => 'form-control', 'readonly', 'placeholder' => 'Pedido N°', 'value' => $id_pedido]) ?>
                            </div>

                            <div class="form-group">
                                <?=  $this->Form->label('Producto: ') ?>
                                <?= $this->Form->control('prod', ['class' => 'form-control', 'placeholder' => 'Producto',
                                    'label' => false, 'readonly',
                                    'value' => $producto]) ?>
                            </div>

                            <div class="form-group">
                                <?=  $this->Form->label('Cantidad: ') ?>
                                <?= $this->Form->number('cantidad', ['class' => 'form-control', 'required',
                                    'oninput' => 'this.value = Math.round(this.value);',
                                    'placeholder' => 'Cantidad']) ?>
                            </div>

                            <div class="form-group">
                                <?=  $this->Form->label('Precio ($/U): ') ?>
                                <?= $this->Form->number('precio_unidad', ['class' => 'form-control', 'required',
                                    'value' => $precio,
                                    'placeholder' => 'Precio ($/U)']) ?>
                            </div>

                            <div class="form-group">
                                <?=  $this->Form->label('Descuento ($/U): ') ?>
                                <?= $this->Form->number('descuento_unidad', ['class' => 'form-control',
                                'value' => $descuento,
                                    'placeholder' => 'Descuento ($/U)']) ?>
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