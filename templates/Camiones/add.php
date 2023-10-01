
<?= $this->Html->css('../plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css') ?>
<?= $this->element('header')?>
<?= $this->element('sidebar')?>
<div class="content-wrapper">
    <div class="content">
        <?= $this->Flash->render() ?>
        <div class="container">
            <div class="card">
                <div class="card-header" style="position: relative;">
                    <h3 class="card-title">Registro de Camiones</h3>
                    <div class="card-tools">
                        <!-- Buttons, labels, and many other things can be placed here! -->
                        <!-- Here is a label for example -->

                    </div>
                    <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body">

                            <?= $this->Form->create($camiones, ['enctype' => 'multipart/form-data']) ?>
                            <div class="row justify-content-center">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?=  $this->Form->label('Nombre: ') ?>
                                        <?= $this->Form->text('nombre', ['class' => 'form-control', 'placeholder' => 'Nombre', 'required']) ?>
                                    </div>

                                    <div class="form-group">
                                        <?=  $this->Form->label('Marca: ') ?>
                                        <?= $this->Form->text('marca', ['class' => 'form-control', 'placeholder' => 'Apellido', 'required']) ?>
                                    </div>

                                    <div class="form-group">
                                        <?=  $this->Form->label('Matricula: ') ?>
                                        <?= $this->Form->text('matricula', ['class' => 'form-control', 'placeholder' => 'Matricula', 'required']) ?>
                                    </div>

                                </div>
                            </div>

                            <div class="form-group" style="margin-top: 40px;">
                                <div class="pull-right">
                                    <?= $this->Form->button("Aceptar", ['class' => 'btn bg-teal', 'escape' => false]) ?>

                                </div>
                                <div class="pull-left">
                                    <?= $this->Html->link("Volver", ['controller' => 'Camiones', 'action' => 'index'], ['class' => 'btn bg-redrose']) ?>
                                </div>

                            </div>

                            <?= $this->Form->end() ?>


                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>

    <?= $this->Html->script('../plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') ?>
    <?= $this->Html->script('shopping_cart.js') ?>
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
