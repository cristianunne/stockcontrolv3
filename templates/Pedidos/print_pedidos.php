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
                        <?= $this->Html->link("Volver", ['controller' => 'Pedidos', 'action' => 'index'], ['class' => 'btn bg-redrose']) ?>
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
                                <p class="h3">Lista de Productos</p>
                            </div>

                            <div class="col-4 text-end">
                                <p class="h3">Vendedor</p>
                                <address>
                                    <?= h($empleado_object->firstname . ' ' . $empleado_object->lastname) ?><br>
                                </address>
                            </div>

                        </div>
                        <br>
                        <br>
                        <table class="table table-bordered table-responsive">
                            <thead>
                            <tr>
                                <th class="text-center" style="width: 1%"></th>
                                <th style="width: 20%">Producto</th>

                                <th class="text-center" style="width: 7%">Categoría</th>
                                <!-- nombre de lalocalidad -->

                                <?php foreach ($localidades as $loc): ?>
                                    <th class="text-center" style="width: 5%"><?= h($loc->localidad) ?></th>
                                <?php endforeach; ?>
                                <th class="text-center" style="width: 5%">Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($productos_ped_distinct as $prod_ped_dist): ?>


                            <tr>
                                <td class="dt-center align-left"><?= h( $i) ?></td>
                                <?php foreach ($productos_ped as $prod_ped): ?>

                                    <?php if ($prod_ped->productos_idproductos == $prod_ped_dist->productos_idproductos): ?>
                                        <td class="dt-center align-left"><?= h($prod_ped->prod_pedido->name . ' (' . $prod_ped->prod_pedido->marca . ') -  ' .
                                                $prod_ped->prod_pedido->content . ' (' .  $prod_ped->prod_pedido->unidad . ')') ?></td>

                                        <td class="dt-center align-middle text-center"><?= h($prod_ped->prod_pedido->category->name) ?></td>

                                        <?php break; ?>
                                    <?php endif; ?>
                                <?php endforeach; ?>

                                <?php $total = null; ?>

                                <?php foreach ($localidades as $loc): ?>
                                    <?php $is_in_array = false; ?>

                                    <?php foreach ($productos_sum_loc as $prod_sum): ?>
                                         <?php if ($loc->localidad == $prod_sum['localidad']): ?>
                                            <?php if ($prod_sum['producto_id'] == $prod_ped_dist->productos_idproductos): ?>
                                                <?php $is_in_array = true; ?>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endforeach; ?>

                                    <?php if ($is_in_array): ?>

                                        <?php foreach ($productos_sum_loc as $prod_sum): ?>
                                            <!--Pregunto si el producto esta -->
                                            <?php if ($loc->localidad == $prod_sum['localidad']): ?>

                                                <?php if ($prod_sum['producto_id'] == $prod_ped_dist->productos_idproductos): ?>
                                                    <td class="dt-center align-middle text-center"><?= h($prod_sum['suma']) ?></td>

                                                    <?php $total = $total + $prod_sum['suma']; ?>

                                                <?php endif; ?>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <td class="dt-center align-middle"></td>
                                    <?php endif; ?>
                                <?php endforeach; ?>

                                <td class="dt-center align-middle text-center"><strong><?= h($total) ?></strong></td>
                                <?php $i = $i + 1; ?>
                            </tr>

                            <?php endforeach; ?>






                            </tbody>


                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>