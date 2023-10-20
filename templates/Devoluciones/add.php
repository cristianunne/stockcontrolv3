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

                            <?= $this->Form->create($devoluciones, ['enctype' => 'multipart/form-data']) ?>
                            <div class="row justify-content-center">
                                <div class="col-md-3 mt-1">
                                    <img src="data:image/png;base64, <?=h($producto_detalles->image)?>" alt="Sin Imagen"
                                         class="img-fluid img-responsive rounded product-image"/>
                                </div>
                                <div class="col-md-12 mt-1">

                                    <div class="mt-1 mb-1 spec-1 text-center"><span class="text-bold">Cantidad de Venta:</span><span class="dot"></span>
                                        <span>
                                             <?= h(!isset($productos_ventas->cantidad) ? 'Sin Datos' : $productos_ventas->cantidad) ?>

                                        <span class="dot"></span></div>
                                </div>
                            </div>
                            <br>

                            <div class="form-group">
                                <?= $this->Form->control('productos_idproductos', ['options' => $producto,
                                    'empty' => '', 'type' => 'select',
                                    'class' => 'form-control', 'placeholder' => '', 'required', 'readonly',
                                    'label' => 'Producto:', 'id' => 'prod_idprod']) ?>
                            </div>

                            <div class="form-group">
                                <?=  $this->Form->label('Cantidad: ') ?>
                                <?= $this->Form->number('cantidad', ['class' => 'form-control', 'placeholder' => 'Cantidad', 'required']) ?>
                            </div>


                            <div class="form-group">
                                <?= $this->Form->control('to_stock', ['options' => [ 0 => 'NO', 1 => 'SI'],
                                    'empty' => '', 'type' => 'select',
                                    'class' => 'form-control', 'placeholder' => '', 'required',
                                    'label' => '¿Desea devolver el Producto al Stock General?:', 'id' => 'prod_idprod']) ?>
                            </div>


                            <div class="form-group" style="margin-top: 40px;">
                                <div class="pull-right">
                                    <?= $this->Form->button("Aceptar", ['class' => 'btn bg-teal', 'escape' => false]) ?>

                                </div>
                                <div class="pull-left">
                                    <?= $this->Html->link("Volver", ['controller' => 'Devoluciones', 'action' => 'viewProducts', $productos_ventas->ventas_idventas], ['class' => 'btn bg-redrose']) ?>
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

