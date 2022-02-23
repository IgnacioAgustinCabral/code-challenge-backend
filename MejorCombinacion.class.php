<?php
class MejorCombinacion{

    private $presupuesto;
    private $mouses = [];
    private $teclados = [];
    private $listado = [];

    public function __construct($presupuesto){
        $this->presupuesto = $presupuesto;
    }

    //Creo una lista con las posibles combinaciones
    private function createPricesList(){
        $jsonMouse = json_decode(file_get_contents('data/json/Mouses.json'), true);
        $jsonTeclado = json_decode(file_get_contents('data/json/Teclados.json'), true);
        
        //Filtrado de precios y ordenamiento de mayor a menor
        foreach($jsonMouse as $mouse){
            if($mouse['precio'] < $this->presupuesto){
                array_push($this->mouses,$mouse['precio']);
            }
        }
        
        foreach($jsonTeclado as $teclado){
            if($teclado['precio'] < $this->presupuesto){
                array_push($this->teclados,$teclado['precio']);
            }
        }

        foreach ($this->mouses as $mouse) {
            foreach ($this->teclados as $teclado) {
                if ($mouse + $teclado <= $this->presupuesto) {
                    array_push($this->listado,['precio_mouse' => $mouse,'precio_teclado' => $teclado]);
                }
            }
        }
    }

    private function sortPricesList(){
        $this->createPricesList();
        $precio_mouse = array_column($this->listado,'precio_mouse');
        $precio_teclado = array_column($this->listado,'precio_teclado');
        array_multisort($precio_mouse, SORT_DESC , $precio_teclado , SORT_DESC , $this->listado);
    }

    public function getMostExpensiveCombo(){
        $this->sortPricesList();
        $mostExpensive = $this->listado[0];
        return $mostExpensive;
    }
    }
