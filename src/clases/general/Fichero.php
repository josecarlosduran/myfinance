<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\clases\general;

/**
 * Description of Ficheros
 *
 * @author josec
 */
class Fichero {
	protected $fichero;
	protected $uploadDir;
	
	public function __construct($file) {
		$this->fichero = $file;
		$this->uploadDir ='uploads/';
	}
	
	public function moverDefinitivo($dir='.'){
		$extension = $this->fichero->guessExtension();
		if (!$extension) {
			// extension cannot be guessed
			$extension = 'bin';
		}
		$directorio = $this->getUploadDir().$dir;
		$res = $this->fichero->move($directorio, rand(1, 99999) . '.' . $extension);
		if ($res){
			$ruta = $res->getRealpath();
		}
		else{
			$ruta = null;
		}
		return $ruta;
	}
	
	protected function getUploadRootDir()
    {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        return $this->uploadDir;
    }
	
	

}
