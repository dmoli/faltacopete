<li>Descuento válido sólo mencionando el código del cupón.</li>
<!--<li>Cupón con vigencia de 12 horas para canjearlo una vez generado.</li>-->
<li>Válido sólo para mayores de 18 años de edad, presentando su carnet 
de identidad en el local!</li>
<li>Sujeto a stock diario del local.</li>
<li>Sin límite de cupones por persona!</li>
<?php if($item['forma_pago'] == 1){?>
    <li>Pago sólo en efectivo</li>
<?php }else{?>
    <li>Pagos con Redcompra y efectivo.</li>
    <label class="sprites redcompra"></label>
<?php }?>
 <?php if($item['despacho'] == 0){?>
    <li>Sin despacho a domicilio.</li>
<?php }else{?>
    <li>
        Con despacho a domicilio: <br>
        Áreas: <?= $item['areas']?> <br>
        *Consultar costos adicionales y otras áreas a: <?= $botilleria['telefono1']?>
    </li>
<?php }?>