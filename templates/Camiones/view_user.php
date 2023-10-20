<?php

echo $this->element('header');
echo $this->element('sidebar');

?>
<div class="content-wrapper">
    <div class="content">
        <?= $this->Flash->render() ?>
        <div class="container-fluid p-5">

            <div class="row justify-content-center">
                <?php if($camiones != null): ?>
                    <div class="col-md-3">
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center d-flex justify-content-center">
                                    <div class="col-md-3 mt-1 ju">
                                        <?php echo $this->Html->image('camion.png', ["alt" => 'Image' , "class" => 'img-fluid img-responsive rounded product-image']) ?>
                                    </div>

                                </div>
                                <h3 class="profile-username text-center"><?= h($camiones->nombre) ?> </h3>
                                <p class="text-muted text-center"><?= h($camiones->marca) ?></p>
                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b>Matricula: </b> <a class="float-right"><?= h($camiones->matricula) ?></a>
                                    </li>

                                    <div class="center">
                                        <?=  $this->Html->link(
                                            '<i class="fas fa-list"></i> Stock',
                                            ['controller' => 'Campaign', 'action' => 'stockCamionCampaign',
                                                $campaign->stock_camion_campaign[0]->idstock_camion_campaign,
                                                $camiones->idcamiones, $campaign->idcampaign],
                                            ['class' => 'btn btn-block btn-primary', 'escape' => false]) ?>
                                    </div>

                                </ul>
                            </div>

                        </div>

                    </div>
                <?php endif; ?>


            </div>
        </div>


    </div>

