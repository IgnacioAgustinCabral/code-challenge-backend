<?php
require_once "MejorCombinacion.class.php";


$presupuesto = new MejorCombinacion(31570);


echo '<pre>';
print_r($presupuesto->getMostExpensiveCombo());
echo '</pre>';

