<?php

echo $this->element('header');
echo $this->element('sidebar');

?>

<div class="content-wrapper">
    <div class="content">
        <?= $this->Flash->render() ?>
        <div class="container">
            <?= $this->Form->create(null, ['enctype' => 'multipart/form-data']) ?>

            <div class="contentbar">
                <!-- Start row -->
                <div class="row">
                    <!-- Start col -->
                    <div class="col-md-12 col-lg-12 col-xl-12">
                        <div class="card m-b-30">

                            <div class="card-header">
                                <i class="fas fa-shopping-cart float-left text-info" style="margin-right: 3px;"></i>
                                <h5 class="card-title">Resumen del Carrito de Compras</h5>
                            </div>
                            <div class="card-body">
                                <div class="row justify-content-center">

                                    <div class="col-lg-11 col-md-11 col-sm-11">
                                        <div class="cart-container mb-3">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <h5 class="card-title" style="float: unset;">Seleccione un Cliente:</h5>
                                                                <br>
                                                                <div class="form-group mb-0">

                                                                    <?php
                                                                    $caption = '<i class="fas fa-search"></i>'; //defines the icon
                                                                    $options = ['type' => 'button', 'class' => 'btn btn-success', 'escapeTitle' => false,
                                                                        'onclick' => 'showModalClientes()',
                                                                        'style'=> 'margin-left: 10px;']; //defines the submit button options
                                                                    ?>

                                                                    <?= $this->Form->button($caption, $options) ?>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="col-lg-8 col-md-8 col-sm-8">
                                                        <div class="card">
                                                            <div class="card-body" >
                                                                <h5 class="card-title">Información del Cliente:</h5>

                                                                <?= $this->Form->number('id_cliente', ['class' => 'd-none', 'placeholder' => '',
                                                                    '', 'value' => null,
                                                                    'id' => 'id_cliente',
                                                                ]) ?>


                                                                <table class="table mt-5 table-borderless">
                                                                    <tbody>
                                                                    <tr>
                                                                        <th scope="row" class="w-25">Comercio:</th>
                                                                        <td id="td_comercio"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th scope="row" class="w-25">Apellido</th>
                                                                        <td id="td_apellido"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th scope="row" class="w-25">Nombre:</th>
                                                                        <td id="td_nombre"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th scope="row" class="w-25">Dirección:</th>
                                                                        <td id="td_direccion"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th scope="row" class="w-25">Teléfono/Celular:</th>
                                                                        <td id="td_telefono"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th scope="row" class="w-25">Localidad:</th>
                                                                        <td id="td_localidad"></td>
                                                                    </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>



                                        </div>

                                    </div>
                                        <hr class="border border-2 opacity-50">
                                    <div class="col-md-11 col-sm-11">
                                        <div class="cart-container">
                                            <div class="cart-head">

                                                <div class="card-head-heiht">
                                                    <div class="table-responsive" id="tabla-responsive-total" attr_cantidad="<?= h(count($productos_cart)) ?>">
                                                        <table class="table table-borderless" >
                                                            <thead>
                                                            <tr>
                                                                <th scope="col">#</th>
                                                                <th scope="col">Acciones</th>
                                                                <th scope="col">Imagen</th>
                                                                <th scope="col">Producto</th>
                                                                <th scope="col">Cantidad</th>
                                                                <th scope="col">Precio ($/unidad)</th>
                                                                <th scope="col">Descuento ($/unidad)</th>
                                                                <th scope="col" class="text-right">Total</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody id="tbody-cart-review">
                                                            <?php $i = 1; $total_precio = 0; $total_descuentos = 0;?>
                                                            <?php foreach ($productos_cart as $producto): ?>

                                                                <?= $this->Form->number($i.'.productos_idproductos', ['class' => 'form-control', 'placeholder' => '',
                                                                    'required', 'min' => 1,
                                                                    'value' => $producto->producto->idproductos,
                                                                    'step' => 1,
                                                                    'style' => 'display: none;',
                                                                    'attr' => $producto->producto->idproductos,
                                                                    'id' => ('producto_' . $producto->producto->idproductos),
                                                                    'oninput' => 'this.value = Math.round(this.value);',
                                                                    'onchange' => 'setPriceTotalResumeCart(this)'
                                                                ]) ?>

                                                                <tr style="border-bottom: 1px solid #dedede">
                                                                    <th scope="row" class="align-middle"><?= h($i) ?></th>
                                                                    <td class="align-middle">

                                                                        <a href="#" class="text-danger" attr="<?= h($producto->idcart_session) ?>"
                                                                           onclick="removeItemFromCartTable(this)">
                                                                            <i class="fas fa-trash-alt"></i></a>
                                                                    </td>
                                                                    <td class="align-middle">
                                                                        <img src="data:image/png;base64, <?=h($producto->producto->image)?>" alt="Sin Imagen"
                                                                             class="img-fluid img-circle" style="width: 50px;"/>

                                                                    </td>
                                                                    <td class="align-middle"><strong><?= h($producto->producto->marca) ?>:</strong> <?= h($producto->producto->name) ?></td>
                                                                    <td class="align-middle">
                                                                        <div class="form-group mb-0">


                                                                            <?= $this->Form->number($i.'.cantidad', ['class' => 'form-control', 'placeholder' => '',
                                                                                'required', 'min' => 1,
                                                                                'value' => 1,
                                                                                'step' => 1,
                                                                                'style' => 'width: 100px;',
                                                                                'attr' => $producto->producto->idproductos,
                                                                                'id' => ('cant_' . $producto->producto->idproductos),
                                                                                'oninput' => 'this.value = Math.round(this.value);',
                                                                                'onchange' => 'setSubtotal(this)'
                                                                            ]) ?>


                                                                        </div>
                                                                    </td>
                                                                    <td class="align-middle">
                                                                        <div class="form-group align-middle d-inline">
                                                                            <?php if(!empty($producto->producto->precios)):  ?>

                                                                                <?= $this->Form->number($i.'.precio_unidad', ['class' => 'form-control', 'placeholder' => '',
                                                                                    'required', 'value' => $producto->producto->precios[0]->precio,
                                                                                    'attr' => $producto->producto->idproductos,
                                                                                    'id' => ('precio_' . $producto->producto->idproductos),
                                                                                    'onchange' => 'setSubtotal(this)'
                                                                                ]) ?>

                                                                            <?php else:?>

                                                                                <?= $this->Form->number($i.'.precio_unidad', ['class' => 'form-control', 'placeholder' => '',
                                                                                    'required', 'id' => ('precio_' . $producto->producto->idproductos),
                                                                                    'attr' => $producto->producto->idproductos,
                                                                                    'value' => 0,
                                                                                    'onchange' => 'setSubtotal(this)']) ?>
                                                                            <?php endif;?>
                                                                        </div>
                                                                    </td>

                                                                    <td class="align-middle">
                                                                        <div class="form-group align-middle d-inline">
                                                                            <?php if(!empty($producto->producto->descuentos)):  ?>

                                                                                <?= $this->Form->number($i.'.descuento_unidad', ['class' => 'form-control', 'placeholder' => '',
                                                                                    'required', 'value' => $producto->producto->descuentos[0]->precio,
                                                                                    'id' => ('descuento_' . $producto->producto->idproductos),
                                                                                    'attr' => $producto->producto->idproductos,
                                                                                    'attr2' => 'descuento',
                                                                                    'onchange' => 'setSubtotal(this)']) ?>

                                                                            <?php else:?>

                                                                                <?= $this->Form->number($i.'.descuento_unidad', ['class' => 'form-control', 'placeholder' => '',
                                                                                    'required', 'attr' => $producto->producto->idproductos,
                                                                                    'id' => ('descuento_' . $producto->producto->idproductos),
                                                                                    'value' => 0,
                                                                                    'attr2' => 'descuento',
                                                                                    'onchange' => 'setSubtotal(this)']) ?>
                                                                            <?php endif;?>
                                                                        </div>
                                                                    </td>
                                                                    <td class="align-middle">
                                                                        <?php

                                                                        $total = 0;
                                                                        $precio = 0;
                                                                        $descuento = 0;
                                                                        if (isset($producto->producto->precios[0]->precio))
                                                                        {
                                                                            $precio = $producto->producto->precios[0]->precio;
                                                                            $total_precio = $total_precio + $precio;
                                                                        }

                                                                        if (isset($producto->producto->descuentos[0]->precio))
                                                                        {
                                                                            $descuento = $producto->producto->descuentos[0]->precio;
                                                                            $total_descuentos = $total_descuentos + $descuento;
                                                                        }

                                                                        if ($precio > 0)
                                                                        {
                                                                            $total = $precio - $descuento;
                                                                        }

                                                                        ?>


                                                                        <?= $this->Form->number($i.'.total', ['class' => ['form-control',

                                                                            $total < 0 ? 'is-invalid' : '']
                                                                            , 'placeholder' => '',
                                                                            'required', 'id' => ('total_producto_' . $producto->producto->idproductos),
                                                                            'attr' => $producto->producto->idproductos,
                                                                            'value' => $total]) ?>
                                                                    </td>
                                                                </tr>
                                                                <?php $i = $i + 1; ?>
                                                            <?php endforeach; ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="cart-body">
                                                <div class="row">
                                                    <div class="col-md-12 order-2 order-lg-1 col-lg-5 col-xl-6">
                                                        <div class="order-note">
                                                            <form>
                                                                <div class="form-group">
                                                                    <div class="input-group">
                                                                        <input type="number" class="form-control" placeholder="Descuento" id="descuento_general_input" name="descuento_general"
                                                                               aria-label="number" aria-describedby="button-addonTags">
                                                                        <div class="input-group-append">
                                                                            <button class="input-group-text" type="button" id="button-addonTags"
                                                                                    onclick="setDescuentoGeneral()">Aplicar</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="specialNotes">Observaciones:</label>
                                                                    <textarea class="form-control" name="observaciones" id="observaciones" rows="3" placeholder="Observaciones"></textarea>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 order-1 order-lg-2 col-lg-7 col-xl-6">
                                                        <div class="order-total table-responsive ">
                                                            <table class="table table-borderless text-right">
                                                                <tbody>
                                                                <tr>
                                                                    <td class="align-middle">Subtotal ($):</td>
                                                                    <td>
                                                                        <?= $this->Form->number('subtotal', ['class' => ['form-control text-end'],
                                                                            'placeholder' => '',
                                                                            'readonly',
                                                                            'id' => 'subtotal',
                                                                            'value' => $total_precio]) ?>


                                                                </tr>
                                                                <tr>
                                                                    <td class="align-middle">Total Descuentos ($):</td>
                                                                    <td>
                                                                        <?= $this->Form->number('total_descuentos', ['class' => ['form-control text-end'],
                                                                            'placeholder' => '',
                                                                            'readonly',
                                                                            'id' => 'total_descuentos',
                                                                            'value' => $total_descuentos]) ?>

                                                                </tr>

                                                                <tr>
                                                                    <td class="align-middle">Descuento General ($):</td>
                                                                    <td>
                                                                        <?= $this->Form->number('descuento_general', ['class' => ['form-control text-end'],
                                                                            'placeholder' => '',
                                                                            'readonly',
                                                                            'id' => 'descuento_general',
                                                                                'value' => 0]) ?>

                                                                </tr>

                                                                <tr>
                                                                    <td class="f-w-7 font-18"><h4>Total :</h4></td>


                                                                    <td class="f-w-7 font-18">
                                                                        <h4>
                                                                            <?= $this->Form->number('total_general', ['class' => ['form-control text-end'],
                                                                                'placeholder' => '',
                                                                                'readonly',
                                                                                'id' => 'total_general',
                                                                                'value' => $total_precio - $total_descuentos]) ?>
                                                                           </h4></td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="cart-footer text-right">

                                                <?= $this->Form->button("Ordenar", ['class' => 'btn btn-success', 'escape' => false]) ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End col -->
                </div>
                <!-- End row -->
            </div>



            <?= $this->Form->end() ?>
            <!-- /.card -->
        </div>
            <?= $this->element('clientes/modal_clientes') ?>

    </div>

    <?= $this->Html->script('../plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') ?>
    <?= $this->Html->script('shopping_cart') ?>
        <?= $this->Html->script('modals') ?>
    <script>
        $(function () {
            // Basic instantiation:
            $('#color').colorpicker();

            // Example using an event, to change the color of the #demo div background:
            $('#color').on('colorpickerChange', function(event) {
                $('#color').css('background-color', event.color.toHexString());
            });
        });
    </script>
</div>
