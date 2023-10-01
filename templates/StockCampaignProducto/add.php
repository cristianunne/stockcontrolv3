<?= $this->element('header')?>
<?= $this->element('sidebar')?>
<div class="content-wrapper">
    <div class="content">
        <?= $this->Flash->render() ?>
        <div class="container">
            <div class="card">
                <div class="card-header" style="position: relative;">
                    <h3 class="card-title">Agregar Producto al Stock del Camion</h3>
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

                            <?= $this->Form->create($stock_campaign_prod, ['enctype' => 'multipart/form-data']) ?>

                            <div class="form-group">
                                <?=  $this->Form->label('Stock Camapaña Camion: ', null, ['class' => 'd-none']) ?>
                                <?= $this->Form->number('stock_camion_campaign_idstock_camion_campaign', ['class' => 'form-control d-none', 'readonly',
                                    'placeholder' => '', 'value' => $idstock_camion_campaign]) ?>
                            </div>

                            <div class="form-group">

                                <div class="mt-1 mb-1 spec-1">
                                    <span class="text-bold">Stock General sin Asignaciones: </span>
                                    <span>
                                       <?= h($stock_general) ?>
                                    </span>
                                </div>


                                <div class="mt-1 mb-1 spec-1">
                                    <span class="text-bold">Stock Disponible: </span>
                                    <span>
                                       <?= h($stock_camiones) ?>
                                    </span>
                                </div>

                            </div>
                            <hr>

                            <div class="form-group">
                                <?=  $this->Form->label('Producto: ') ?>

                                <?= $this->Form->control('prod', ['class' => 'form-control', 'placeholder' => 'Producto',
                                    'label' => false, 'readonly',
                                    'value' => $producto]) ?>

                                <?= $this->Form->control('productos_idproductos', ['class' => 'form-control d-none', 'placeholder' => 'Producto',
                                    'label' => false, 'readonly',
                                    'value' => $idproducto]) ?>
                            </div>

                            <div class="form-group">
                                <?=  $this->Form->label('Cantidad: ') ?>
                                <?= $this->Form->number('cantidad', ['class' => 'form-control', 'required',
                                    'oninput' => 'this.value = Math.round(this.value);',
                                    'placeholder' => 'Cantidad']) ?>
                            </div>



                            <div class="form-group" style="margin-top: 40px;">
                                <div class="pull-right">
                                    <?= $this->Form->button("Aceptar", ['class' => 'btn bg-teal', 'escape' => false]) ?>

                                </div>
                                <div class="pull-left">
                                    <?= $this->Html->link("Volver", ['action' => 'addProductoToCamionCampaign', $idstock_camion_campaign, $id_camion, $idcampaign], ['class' => 'btn bg-redrose']) ?>
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
