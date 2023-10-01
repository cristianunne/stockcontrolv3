<?php

echo $this->element('header');
echo $this->element('sidebar');

?>
<div class="content-wrapper">
    <div class="content">
        <?= $this->Flash->render() ?>
        <div class="container-fluid p-5">

            <div class="row justify-content-center">
                <?php foreach ($camiones as $camion): ?>
                <div class="col-md-3">
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center d-flex justify-content-center">
                                <div class="col-md-3 mt-1 ju">
                                    <?php echo $this->Html->image('camion.png', ["alt" => 'Image' , "class" => 'img-fluid img-responsive rounded product-image']) ?>
                                </div>

                            </div>
                            <h3 class="profile-username text-center"><?= h($camion->nombre) ?> </h3>
                            <p class="text-muted text-center"><?= h($camion->marca) ?></p>
                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Matricula: </b> <a class="float-right"><?= h($camion->matricula) ?></a>
                                </li>

                            </ul>
                            <a href="#" class="btn btn-primary btn-block"><b>Campañas</b></a>
                        </div>

                    </div>

                </div>
                <?php endforeach; ?>


        </div>
    </div>


</div>
