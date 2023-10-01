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

                            <div class="row justify-content-center">
                                <div class="col-md-3 mt-1">
                                    <img src="data:image/png;base64, <?=h($producto['img'])?>" alt="Sin Imagen"
                                         class="img-fluid img-responsive rounded product-image"/>
                                </div>
                                <div class="col-md-12 mt-1">
                                    <p class="text-center text-bold"><?=h($producto['name'])?></p>
                                    <div class="mt-1 mb-1 spec-1 text-center"><span class="text-bold">Stock del Camión:</span><span class="dot"></span>

                                        <span>
                                             <?= h(!isset($stock) ? 'Sin Datos' : $stock) ?>

                                        <span class="dot"></span></div>
                                </div>

                            </div>

                            <br>

                            <?= $this->Form->create($producto_ventas_temp, ['enctype' => 'multipart/form-data']) ?>

                            <div class="form-group">
                                <?=  $this->Form->label('Venta N°: ') ?>
                                <?= $this->Form->number('ventas_idventas_temp', ['class' => 'form-control', 'readonly',
                                    'placeholder' => 'Compra N°', 'value' => $ventas_idventas_temp]) ?>
                            </div>

                            <?= $this->Form->number('productos_idproductos', ['class' => 'form-control d-none', 'readonly',
                                'placeholder' => '', 'value' => $id_producto]) ?>

                            <div class="form-group">
                                <?=  $this->Form->label('Cantidad: ') ?>
                                <?= $this->Form->number('cantidad', ['class' => 'form-control', 'required',
                                    'oninput' => 'this.value = Math.round(this.value);',
                                    'placeholder' => 'Cantidad']) ?>
                            </div>
                            <div class="form-group">
                                <?=  $this->Form->label('Precio: ') ?>
                                <?= $this->Form->number('precio_unidad', ['class' => 'form-control', 'required', 'value' => $precio,
                                    'placeholder' => 'Precio']) ?>
                            </div>
                            <div class="form-group">
                                <?=  $this->Form->label('Descuento: ') ?>
                                <?= $this->Form->number('descuento_unidad', ['class' => 'form-control', 'value' => $descuento,
                                    'placeholder' => 'Descuento']) ?>
                            </div>



                            <div class="form-group" style="margin-top: 40px;">
                                <div class="pull-right">
                                    <?= $this->Form->button("Aceptar", ['class' => 'btn bg-teal', 'escape' => false]) ?>

                                </div>
                                <div class="pull-left">
                                    <?= $this->Html->link("Volver", ['controller' => 'VentasTemp','action' => 'view', $ventas_idventas_temp], ['class' => 'btn bg-redrose']) ?>
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
