<?php

namespace App\clases\charts;
/**
 * Clase Abstracta Estructura Chart
 *
 * @author j.duran
 */
class Chart {
    
    protected $type = null;
    protected $data = array();
    protected $options = null;
    protected $title ="";
    protected $titleSize = 16;
    protected $legendPosition = 'bottom'; 
	
   protected $colores = array("primarios" => array("rgb(255, 99, 132)","rgb(54, 162, 235)","rgb(255, 205, 86)","rgb(65, 237, 114)","rgb(241, 158, 60)","rgb(60, 213, 241)","rgb(182, 76, 231)","rgb(255, 50, 50)","rgb(30, 237, 50)","rgb(249, 255, 50)","rgb(30, 0, 255)","rgb(255, 0, 175)")
						      );
	protected $color = array();
    public function __construct($type,$color,$title=""){
        $this->type = $type;
		$this->color =$color;
		$this->options = new \stdClass();
		$this->setTitle($title);
    }
    
	
    public function generate(){
        $structure = new \stdClass();
		$structure->type = $this->type;
		$structure->data = $this->data;
		$structure->options = $this->options;
		
        return $structure;
    }
    
	public function opciones(){
		//Titulo
		$titulo = new \StdClass();
		$titulo->text = $this->title;
		$titulo->fontSize = $this->titleSize; 
		if($this->title!=""){ $titulo->display = true;} else { $titulo->display = false;}
		$this->options->title =  $titulo;
		//Leyenda
		$leyenda = new \stdClass();
		$leyenda->position = $this->legendPosition;
		$this->options->legend = $leyenda;
		
	}
	
    public function getData(){
        return $this->data;
    }
    
    public function setData($data){
        $this->data = $data;
    }
    
    public function getOptions(){
        return $this->options;
    }
    
    public function setOptions($options){
        $this->options = $options;
    }
    
    
    public function setLabel($label){
        $this->data['label']=$label;
    }
	
	public function setTitle ($title){
		$this->title =$title;
	}
    
	public function setTitleSize ($titleSize){
		$this->titleSize =$titleSize;
	}
    
	public function setLegendPosition ($legendPosition){
		$this->legendPosition =$legendPosition;
	}
	
	public function generarColores ($nombre,$numeroDatos){
		$res=array();
		$escala = $this->colores[$nombre]; 
		$numeroColores = count($escala);
		for($i=0;$i<$numeroDatos;$i++){
			$res[] = $escala[($i % $numeroColores)];
		}
		
		return $res;
	}
        
        public function datos($datasets,$labels){
		$datos_dataset = array();
		$res = new \stdClass();
		foreach($datasets as $dataset){
                $data = array();
                $data['label'] = $dataset['label'];
                $data['data']= array();    
                foreach ($dataset['valores'] as $dato){
                        $data['data'][] = $dato;
                    }
                $data['backgroundColor'] = $this->generarColores($this->color[0], count($data['data']));
                array_push($datos_dataset, $data);    
                }
                $res->datasets=$datos_dataset;
		$res->labels=$labels;
		$this->setData($res);
	}

    
}