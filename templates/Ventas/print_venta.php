<?php

echo $this->element('header');
echo $this->element('sidebar');

?>

<div class="content-wrapper">
    <div class="content">

        <div class="page-header d-print-none mt-5">
            <div class="container-xl">
                <div class="col-auto ms-auto d-print-none">
                    <div class="pull-left">
                        <?= $this->Html->link("Volver", ['controller' => 'Ventas', 'action' => 'view', $idventa], ['class' => 'btn bg-redrose']) ?>
                    </div>
                </div>
                <div class="row g-2 align-items-center">
                    <!-- Page title actions -->
                    <div class="col-auto ms-auto d-print-none">

                        <button type="button" class="btn btn-primary" onclick="javascript:window.print();">
                            <!-- Download SVG icon from http://tabler-icons.io/i/printer -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2" /><path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4" /><path d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z" /></svg>
                            Imprimir Remito
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page body -->
        <div class="page-body mt-3">
            <div class="container-xl">
                <div class="card card-lg">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <p class="h3">Distribuidora Peón</p>
                                <address>

                                    La Verde, Chaco<br>
                                    Argentina<br>
                                </address>
                            </div>

                            <div class="col-4 text-center">
                                <p class="h3"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-square-letter-x" width="48" height="48" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M3 3m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z"></path>
                                        <path d="M10 8l4 8"></path>
                                        <path d="M10 16l4 -8"></path>
                                    </svg></p>
                                <address>
                                    Documento no válido como factura<br>

                                </address>
                            </div>

                            <div class="col-4 text-end">
                                <p class="h3"><?= h($ventas->cliente->apellido . ' ' . $ventas->cliente->nombre) ?></p>
                                <address>
                                    "<?= h($ventas->cliente->shop_name) ?>"<br>
                                    <?= h($ventas->cliente->direccion) . ', ' . h($ventas->cliente->altura)?><br>
                                    <?= h($ventas->cliente->provincia) ?>, <?= h($ventas->cliente->localidad) ?><br>
                                    <?= h($ventas->cliente->pais) ?><br>
                                </address>
                            </div>
                        </div>
                        <br>
                        <br>
                        <table class="table table-transparent table-responsive">
                            <thead>
                            <tr>
                                <th class="text-center" style="width: 1%"></th>
                                <th>Product</th>
                                <th class="text-center" style="width: 5%">Cantidad</th>
                                <th class="text-end" style="width: 10%">Precio</th>
                                <th class="text-end" style="width: 10%">Descuento</th>
                                <th class="text-end" style="width: 11%">Total</th>
                            </tr>
                            </thead>
                            <?php $i = 1;?>
                            <?php foreach ($ventas->productos as $producto): ?>
                                <tr>
                                    <td class="text-center"><?= h($i) ?></td>
                                    <td>
                                        <p class="strong mb-1"><?= h($producto->name . ' (' . $producto->content . ' ' . $producto->unidad . ')') ?></p>
                                        <div class="text-muted"><?= h($producto->marca) ?></div>
                                    </td>
                                    <td class="text-center">
                                        <?= h($producto->_joinData->cantidad) ?>
                                    </td>

                                    <td class="text-end"> $  <?= h(number_format($producto->_joinData->precio_unidad,2,",",".")) ?></td>
                                    <td class="text-end"> $  <?= h(number_format($producto->_joinData->descuento_unidad,2,",",".")) ?></td>
                                    <td class="text-end"> $  <?= h(number_format($producto->_joinData->cantidad * $producto->_joinData->precio_unidad -
                                            $producto->_joinData->cantidad * $producto->_joinData->descuento_unidad,2,",",".")) ?></td>

                                </tr>

                                <?php $i = $i + 1;?>
                            <?php endforeach; ?>


                            <tr>
                                <td colspan="5" class="strong text-end">Subtotal</td>
                                <td class="text-end"> $  <?= h(number_format($ventas->subtotal,2,",",".")) ?></td>


                            </tr>
                            <tr>
                                <td colspan="5" class="strong text-end">Descuentos</td>
                                <td class="text-end"> $  <?= h(number_format($ventas->descuentos,2,",",".")) ?></td>

                            </tr>
                            <tr>
                                <td colspan="5" class="strong text-end">Descuentos General</td>
                                <td class="text-end"> $  <?= h(number_format($ventas->descuento_general,2,",",".")) ?></td>

                            </tr>
                            <tr>
                                <td colspan="5" class="font-weight-bold text-uppercase text-end">Total</td>
                                <td class="text-end"><strong> $  <?= h(number_format($ventas->total,2,",",".")) ?></strong></td>
                            </tr>

                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

