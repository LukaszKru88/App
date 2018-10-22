<?php

class View{
 
    public function loadModel($name, $path='model/') {
        $path = $path.$name.'.php';
        $name = $name.'Model';
        require $path;
        $ob = new $name();
        return $ob;
    }

    public function render($name, $path='templates/') {
        $path=$path.$name.'.html.php';
        require $path;
    }

    public function set($name, $value) {
        $this->$name = $value;
    }

    public function get($name) {
        return $this->$name;
    }
}