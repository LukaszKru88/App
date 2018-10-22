<?php

class Controller{
	
	public function redirect($url){
		header("location: ".$url);
	}

	public function loadView($name, $path = 'view/'){
		$path = $path.$name.'.php';
		$name = $name.'View';
		require $path;
		$ob = new $name();
		return $ob;
	}

	public function loadModel($name, $path='model/') {
        $path = $path.$name.'.php';
        $name = $name.'Model';
        require $path;
        $ob = new $name();
        return $ob;    
    }
}

?>
