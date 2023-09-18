
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
        <div class="container-fluid p-5">
            <div class="card">
                <div class="card-header" style="position: relative;">
                    <h3 class="card-title" style="position: absolute; top: 50%;;">Lista de Proovedores</h3>
                    <div class="card-tools">
                        <!-- Buttons, labels, and many other things can be placed here! -->
                        <!-- Here is a label for example -->
                        <?=  $this->Html->link(
                            '<i class="fas fa-plus "></i> Nuevo',
                            ['controller' => 'Proveedores', 'action' => 'add'], ['class' => 'btn bg-teal', 'escape' => false]) ?>

                    </div>
                    <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive">
                    <table id="tabladata" class="table table-bordered table-hover dataTable">
                        <thead>
                        <tr>
                            <th scope="col"><?= $this->Paginator->sort('ID') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('Nombre') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('CUIT') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('Direccion') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('Provincia') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('Departamento') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('Localidad') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('Telefono') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('Email') ?></th>
                            <th scope="col" class="actions"><?= __('Acciones') ?></th>

                        </tr>
                        </thead>
                        <tbody>

                        <?php foreach ($proveedores as $prov): ?>
                            <tr>
                                <td class="dt-center font-weight-bold align-middle"><?= h($prov->idproveedores) ?></td>
                                <td class="dt-center align-middle"><?= h($prov->name) ?></td>
                                <td class="dt-center align-middle"><?= h($prov->cuit) ?></td>
                                <td class="dt-center align-middle"><?= h($prov->direccion) ?></td>
                                <td class="dt-center align-middle"><?= h($prov->provincia) ?></td>
                                <td class="dt-center align-middle"><?= h($prov->departamento) ?></td>
                                <td class="dt-center align-middle"><?= h($prov->localidad) ?></td>
                                <td class="dt-center align-middle"><?= h($prov->telefono) ?></td>
                                <td class="dt-center align-middle"><?= h($prov->email) ?></td>


                                <td class="actions" style="text-align: center">
                                    <div class="d-flex justify-content-around gap-2">
                                        <?= $this->Html->link($this->Html->tag('span', '', ['class' => 'fas fa-edit', 'aria-hidden' => 'true']),
                                            ['action' => 'edit', $prov->idproveedores], ['class' => 'btn bg-lightpurple', 'escape' => false]) ?>

                                        <?= $this->Form->postLink(__($this->Html->tag('span', '', ['class' => 'fas fa-trash-alt', 'aria-hidden' => 'true'])),
                                            ['action' => 'delete', $prov->idproveedores],
                                            ['confirm' => __('Eliminar {0}?', $prov->name), 'class' => 'btn btn-danger bg-redrose','escape' => false]) ?>
                                    </div>

                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->

            </div>
            <!-- /.card -->
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

