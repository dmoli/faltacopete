 <div id="lista-sector">
              <div class="colum"> 
                  <?php if(!isset($_REQUEST['sector'])){//si no llega nada pongo b a santiago?>
                     <a href="/home" class="item-sector"><b>Todo Santiago</b></a>
                  <?php }else{?>                
                     <a href="/home" class="item-sector">Todo Santiago</a>
                  <?php }?>   
                    <?php
                          $boti = new botilleria();
                          $comunas = $boti->verComunas(13);
                          $c = 0;
                          $pasa = 0;
                          if(isset($_REQUEST['sector'])){
                              foreach($comunas as $item){
                                  $c++;
                                  $search = array(' ','ñ','Ñ');
                                  $replace = array('-','n','N');
                                  $nombresin = str_replace($search,$replace, $item['nombre']);
                                  $nombreMostrar = strtolower($item['nombre']);
                                  $nombreMostrar = str_replace('Ñ', 'ñ', $nombreMostrar);
                                  if($_REQUEST['sector'] == $item['codigoInterno']){
                                      $nombreMostrar = '<b>'.$nombreMostrar.'</b>';
                                  }
                                   ?>
                                     <a href="/home/cupones-en=<?= $nombresin?>/<?= $item['codigoInterno']?>" class="item-sector"><?= ucwords($nombreMostrar)?></a>
                                       <?php 
                                              if($c%9 == 0 && $pasa < 5){
                                                  $pasa++;
                                                  echo '</div>';
                                                  echo '<div class="colum">';
                                              }
                                 }
                          }else
                            foreach($comunas as $item){
                                  $c++;
                                  $search = array(' ','ñ','Ñ');
                                  $replace = array('-','n','N');
                                  $nombresin = str_replace($search,$replace, $item['nombre']);
                                  $nombreMostrar = strtolower($item['nombre']);
                                  $nombreMostrar = str_replace('Ñ', 'ñ', $nombreMostrar);
                             ?>
                          <a href="/home/cupones-en=<?= $nombresin?>/<?= $item['codigoInterno']?>" class="item-sector"><?= ucwords($nombreMostrar)?></a>
                            <?php 
                                   if($c%9 == 0 && $pasa < 5){
                                       $pasa++;
                                       echo '</div>';
                                       echo '<div class="colum">';
                                   }
                      }?>
              </div>
       </div>