<!-- DataTables -->
<?= $this->Html->css('../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>
<?= $this->Html->css('../plugins/datatables-responsive/css/responsive.bootstrap4.min.css') ?>
<?= $this->Html->css('../plugins/datatables-buttons/css/buttons.bootstrap4.min.css') ?>
<!-- Modal Clientes-->

<div class="modal fade" id="modal_clientes" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl " role="document">
        <div class="modal-content">

            <div class="modal-header bg-gradient-white">
                <i class="fas fa-users nav-icon text-info mr-1"></i>
                <h6 class="modal-title" id="tittle_modal_clientes">Selección de Clientes</h6>
                <button type="button" class="close" style="margin-top:-25px" data-dismiss="modal" aria-label="Close" attr="modal_clientes"
                        onclick="closeModal(this)">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="card-body table-responsive">
                    <table id="tabladata" class="table table-bordered table-hover dataTable">
                        <thead>
                        <tr>
                            <th scope="col"><?= $this->Paginator->sort('Comercio') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('Nombre') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('Apellido') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('Telefono') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('Localidad') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('Direccion') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('Altura') ?></th>
                            <th scope="col" class="actions"><?= __('Acciones') ?></th>

                        </tr>
                        </thead>
                        <tbody>

                        <?php foreach ($clientes as $clie): ?>
                            <tr>
                                <td class="dt-center font-weight-bold"><?= h($clie->shop_name) ?></td>
                                <td class="dt-center"><?= h($clie->nombre) ?></td>
                                <td class="dt-center"><?= h($clie->apellido) ?></td>
                                <td class="dt-center"><?= h($clie->dni) ?></td>
                                <td class="dt-center"><?= h($clie->localidad) ?></td>
                                <td class="dt-center"><?= h($clie->direccion) ?></td>
                                <td class="dt-center"><?= h($clie->altura) ?></td>

                                <td class="actions" style="text-align: center">

                                    <?= $this->Form->button($this->Html->tag('span', '', ['class' => 'fas fa-check', 'aria-hidden' => 'true']),
                                        ['type' => 'button', 'class' => 'btn btn-success', 'escapeTitle' => false,
                                            'id_cliente' => $clie->idclientes,
                                            'comercio' => $clie->shop_name,
                                            'apellido' => $clie->apellido,
                                            'nombre' => $clie->nombre,
                                            'direccion' => $clie->direccion . ' ' . $clie->altura,
                                            'telefono' => $clie->telefono,
                                            'localidad' => $clie->localidad,
                                            'onclick' => 'addClienteToBoxPedido(this)']) ?>


                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
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


