<?php

class Model{
    protected $dbo;

    public function __construct(){
    	try{
    	    require 'config/config.php';
            $this->host= $host;
            $this->db_password= $db_password;
            $this->db_user= $db_user;
            $this->db_name = $db_name;

    		$this->dbo = new mysqli($this->host, $this->db_user, $this->db_password, $this->db_name);
            if($this->dbo->connect_errno){
    			$msg = "Connection to database was unable. Please try again latter.";
    			throw new exception($msg);
    		}
    	}
    	catch (exception $e){
    	    echo $msg;
    	}
    }

    public function loadModel($name, $path='') {
        $path = $path.$name.'.php';
        $name = $name.'Model';
        require $path;
        $ob = new $name();
        return $ob;
    }

    public function select($from, $select='*', $where=NULL, $order=NULL, $limit=NULL) {
        $query = 'SELECT '.$select.' FROM '.$from;
        if ($where!=NULL)
            $query = $query . ' WHERE '.$where;
        if ($order != NULL)
            $query = $query . ' ORDER BY '.$order;
        if ($limit != NULL)
            $query = $query . ' LIMIT '.$limit;

        $select = $this->dbo->query($query);
        $data = [];
        foreach ($select as $row) {
            $data[] = $row;
        }

        return $data;
    }
}