<?php

echo $this->element('header');
echo $this->element('sidebar');

?>
<div class="content-wrapper">
    <div class="content">
        <?= $this->Flash->render() ?>
       <div class="container">
           <div class="row justify-content-center">
               <div class="col-md-5 p-5 pt-3">
                   <div class="card card-warning">
                       <div class="card-header" style="position: relative;">
                           <h3 class="card-title">Campaña Activa</h3>
                           <div class="card-tools">
                               <!-- Buttons, labels, and many other things can be placed here! -->
                               <!-- Here is a label for example -->
                           </div>
                           <!-- /.card-tools -->
                       </div>

                       <?php if($estado): ?>
                           <div class="card-body">

                               <div>
                                   <div class="row p-2 bg-white border rounded">
                                       <div class="col-md-3 mt-1">
                                           <?php echo $this->Html->image('campaign.png', ["alt" => 'Image' , "class" => 'img-fluid img-responsive rounded product-image']) ?>

                                       </div>
                                       <div class="col-md-9 mt-1">
                                           <div class="d-flex flex-row">
                                               <div class="mt-1 mb-1 spec-1"><span class="text-bold">Número de Campaña:</span><span class="dot"></span>

                                                   <span>
                                             <?= h($campaign['number']) ?>

                                        <span class="dot"></span></div>

                                           </div>

                                           <div class="mt-1 mb-1 spec-1">
                                               <span class="text-bold">Fecha de Inicio: </span>
                                               <span>
                                       <?= h($campaign->fecha_inicio->format('d-m-Y')) ?>
                                    </span>
                                           </div>

                                           <div class="mt-1 mb-1 spec-1">
                                               <span class="text-bold">Fecha de Finalización: </span>
                                               <span>
                                        <?= h($campaign->fecha_fin->format('d-m-Y')) ?>
                                    </span>
                                           </div>

                                       </div>
                                       <div class="align-items-center align-content-center col-xl-3 col-md-3 col-sm-3 border-left mt-1">

                                       </div>
                                   </div>
                               </div>
                           </div>

                           <div class="card-footer">
                               <?php if($role == 'admin'): ?>
                                   <div class="pull-right">
                                       <?=  $this->Html->link(
                                           '<i class="fas fa-search"></i> Ver',
                                           ['controller' => 'Campaign' ,'action' => 'viewAdmin', $campaign->idcampaign],
                                           ['class' => 'btn btn-warning', 'escape' => false]) ?>
                                   </div>
                                   <div class="pull-right">
                                       <?=  $this->Html->link(
                                           '<i class="fas fa-cog"></i> Configurar',
                                           ['controller' => 'Campaign', 'action' => 'config', $campaign->idcampaign],
                                           ['class' => 'btn btn-danger mr-3', 'escape' => false]) ?>
                                   </div>
                               <?php else:?>

                                   <div class="pull-right">
                                       <?=  $this->Html->link(
                                           '<i class="fas fa-search"></i> Ver',
                                           ['controller' => 'Campaign' ,'action' => 'viewUser', $campaign->idcampaign],
                                           ['class' => 'btn btn-warning', 'escape' => false]) ?>
                                   </div>

                               <?php endif;?>
                           </div>
                       <?php endif;?>
                   </div>

               </div>
           </div>

       </div>
    </div>


</div>
