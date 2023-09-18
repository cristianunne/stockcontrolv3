
<!-- DataTables -->
<?= $this->Html->css('../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>
<?= $this->Html->css('../plugins/datatables-responsive/css/responsive.bootstrap4.min.css') ?>
<?= $this->Html->css('../plugins/datatables-buttons/css/buttons.bootstrap4.min.css') ?>

<?php

echo $this->element('header');
echo $this->element('sidebar');

?>


<div class="content-wrapper">
    <div class="content">
        <?= $this->Flash->render() ?>
        <div class="container-fluid mt-lg-5">

            <div class="row justify-content-center">
                <div class="col-xl-11 col-lg-11 col-md-11 col-sm-11">
                    <div class="alert bg-text-info" role="alert">
                        <h4 class="alert-heading"><i class="fas fa-store nav-icon"></i> Pedidos compras pendientes</h4>
                        <p>En esta sección puedes visualizar todos los pedidos de compras que te fueron asignados.</p>
                    </div>

                    <div class="card">
                        <div class="card-header" style="position: relative;">
                            <h3 class="card-title">Lista de Productos</h3>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive">
                            <table id="tabladata" class="table table-bordered table-hover dataTable">
                                <thead>
                                <tr>
                                    <th scope="col" class="actions"><?= __('Estado') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('Producto') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('Marca') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('Proveedor') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('Categoria') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('Cantidad ($)') ?></th>
                                    <th scope="col" class="actions"><?= __('Acciones') ?></th>


                                </tr>
                                </thead>
                                <tbody>

                                <?php foreach ($emp_compras as $producto): ?>
                                    <tr>
                                        <?php if(!$producto->status):  ?>
                                            <td class="actions align-middle" style="text-align: center">
                                                  <span class="badge status-canceled font-size-small">
                                                            <?= h('No Enviado') ?>
                                                      </span>
                                            </td>
                                        <?php else: ?>
                                            <td class="actions align-middle" style="text-align: center">
                                                      <span class="badge status-completed font-size-small">
                                                            <?= h('Enviado') ?>
                                                      </span>
                                            </td>
                                        <?php endif;?>

                                        <td class="dt-center align-middle"><?= h($producto->producto->name . ' ' .
                                                $producto->producto->content . '(' . $producto->producto->unidad . ')') ?></td>

                                        <td class="dt-center align-middle"><?= h($producto->producto->marca) ?></td>

                                        <?php if(!empty($producto->producto->proveedore)):  ?>
                                            <td class="dt-center align-middle"><?= h($producto->producto->proveedore->name) ?></td>
                                        <?php else: ?>
                                            <td class="dt-center align-middle text-danger"><?= h('') ?></td>
                                        <?php endif;?>


                                        <td class="dt-center align-middle ">
                                             <span class="center badge" style="<?= h('background-color:'.$producto->producto->category->color) ?> !important">
                                                <?= h($producto->producto->category->name) ?>

                                        </td>

                                        <?php if(!$producto->status):  ?>
                                            <td class="actions align-middle" style="text-align: center">
                                                <?= $this->Form->number('cantidad', ['class' => 'form-control input-emp-compra', 'placeholder' => 'Cantidad',
                                                    'id' => 'cantidad_' . $producto->idempleado_comprastock, 'value' => $producto->cantidad,
                                                    'attr' => $producto->idempleado_comprastock]) ?>
                                            </td>
                                        <?php else: ?>
                                            <td class="actions align-middle" style="text-align: center">
                                                <?= $this->Form->number('cantidad', ['class' => 'form-control input-emp-compra', 'placeholder' => 'Cantidad',
                                                    'id' => 'cantidad_' . $producto->idempleado_comprastock, 'value' => $producto->cantidad, 'attr' => $producto->idempleado_comprastock,
                                                    'readonly']) ?>
                                            </td>
                                        <?php endif;?>






                                        <?php
                                            $caption = "<i class='fas fa-sync'></i>"; //defines the icon
                                            $options = ['escapeTitle' => false,'class' => 'btn btn-warning', 'type' => 'button',
                                                'onclick' => 'uploadProductByEmpleado(this)', 'attr' => $producto->idempleado_comprastock]; //defines the submit button options
                                        ?>

                                          <?php if(!$producto->status):  ?>
                                              <td class="actions align-middle" style="text-align: center">
                                                  <div class="d-flex justify-content-around gap-2">
                                                      <?= $this->Form->button($caption, $options) ?>
                                                  </div>
                                              </td>
                                            <?php else: ?>
                                                <td class="actions align-middle" style="text-align: center">


                                                    <?= $this->Html->link($this->Html->tag('span', '', ['class' => 'fas fa-edit', 'aria-hidden' => 'true']),
                                                        ['controller' => 'EmpleadoComprasstock' ,'action' => 'edit', $producto->idempleado_comprastock, $producto->comprasstock_idcomprasstock],
                                                        ['class' => 'btn bg-lightpurple', 'escape' => false]) ?>
                                                </td>
                                            <?php endif;?>



                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<?= $this->Html->script('../plugins/datatables/jquery.dataTables.min.js') ?>
<?= $this->Html->script('../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') ?>
<?= $this->Html->script('../plugins/datatables-responsive/js/dataTables.responsive.min.js') ?>
<?= $this->Html->script('../plugins/datatables-responsive/js/responsive.bootstrap4.min.js') ?>
<?= $this->Html->script('../plugins/datatables-buttons/js/dataTables.buttons.min.js') ?>
<?= $this->Html->script('../plugins/datatables-buttons/js/buttons.bootstrap4.min.js') ?>
<?= $this->Html->script('../plugins/datatables-buttons/js/buttons.html5.min.js') ?>
<?= $this->Html->script('../plugins/datatables-buttons/js/buttons.print.min.js') ?>
<?= $this->Html->script('../plugins/datatables-buttons/js/buttons.colVis.min.js') ?>
<?= $this->Html->script('shopping_cart.js') ?>

<script>
    $(function () {
        $('#tabladata').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": false,
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
            }
        });
    })
</script>


