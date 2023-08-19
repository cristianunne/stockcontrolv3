
<?= $this->Html->css('login/my-login.css') ?>
<section class="h-100" style="background-color: #F3F6FF; padding-bottom: 100px;
    height: 100vh!important;">
    <div class="container mt-0" style="padding-top: 100px;">
        <?= $this->Flash->render() ?>
        <div class="row justify-content-md-center h-100">
            <div class="card-wrapper wow zoomIn">
                <div class="brand">
                    <img src="../img/user_hombre.png" alt="logo">
                </div>

                <div class="card fat">
                    <div class="card-body">
                        <h4 class="h4">Iniciar Sesión</h4>
                        <?= $this->Form->create(null, ['class' => 'my-login-validation']) ?>
                        <div class="form-group login-form-gruop">
                            <?= $this->Form->text('email', ['class' => 'form-control', 'placeholder' => 'Correo Electrónico', 'required']) ?>

                        </div>

                        <div class="form-group login-form-gruop" >
                            <?= $this->Form->password('password', ['class' => 'form-control',
                                'placeholder' => 'Contraseña', 'required', 'type' => 'password']) ?>
                        </div>

                        <div class="form-group m-0">
                            <?= $this->Form->button('Acceder', ['class' => 'btn btn-large btn-success btn-block']) ?>
                        </div>
                        <?= $this->Form->end() ?>

                        <div class="mt-4 text-center">
                            No tienes una cuenta?
                            <?= $this->Html->link('Crear una',
                                ['controller' => 'Users', 'action' => 'register', '?' =>
                                    ['Accion' => 'Editar Museos', 'Categoria' => 'Museos', 'Tabla_name' => 'Museos']]) ?>
                        </div>
                    </div>

                </div>

                <div class="footer">
                    Copyright &copy; 2023 &mdash; Sistema de Control de Stock
                </div>
            </div>
        </div>
    </div>
</section>
