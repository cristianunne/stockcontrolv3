
<?= $this->element('header')?>
<?= $this->element('sidebar')?>
<div class="content-wrapper">
    <div class="content">
        <?= $this->Flash->render() ?>
        <div class="container">
            <div class="card">
                <div class="card-header" style="position: relative;">
                    <h3 class="card-title">Crear una nueva Subcategoria</h3>
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

                            <?= $this->Form->create($sub_categories, ['enctype' => 'multipart/form-data']) ?>

                            <div class="form-group">
                                <?= $this->Form->control('categories_idcategories', ['options' => $categories,
                                    'empty' => '(Elija una Categoria)', 'type' => 'select',
                                    'class' => 'form-control', 'placeholder' => '', 'required',
                                    'label' => 'Categoria:', 'id' => 'categories_idcategories']) ?>
                            </div>

                            <div class="form-group">
                                <?=  $this->Form->label('Nombre: ') ?>
                                <?= $this->Form->text('name', ['class' => 'form-control', 'placeholder' => 'Nombre', 'required']) ?>
                            </div>

                            <div class="form-group">
                                <?=  $this->Form->label('Descripcion: ') ?>
                                <?= $this->Form->textarea('description', ['class' => 'form-control', 'placeholder' => 'Descripcion', 'required']) ?>
                            </div>


                            <div class="form-group" style="margin-top: 40px;">
                                <div class="pull-right">
                                    <?= $this->Form->button("Aceptar", ['class' => 'btn bg-teal', 'escape' => false]) ?>

                                </div>
                                <div class="pull-left">
                                    <?= $this->Html->link("Volver", ['controller' => 'Categories', 'action' => 'index'], ['class' => 'btn bg-redrose']) ?>
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