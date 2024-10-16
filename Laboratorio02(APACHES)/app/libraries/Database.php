<?php
class Database {
    private $host = db_Servidor;
    private $name = db_Basedato;
    private $user = db_Usuario;
    private $pass = db_Contra;
    private $coman;
    private $conex;
    private $error;
    public function __construct() {
        $auxConex = 'mysql:host=' . $this->host . ';dbname=' . $this->name;

        $opciones = array(PDO::ATTR_PERSISTENT => true,
                          PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
        try {
            $this->conex = new PDO($auxConex, $this->user, $this->pass, $opciones);
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }

    public function query($auxSql) {
        $this->coman = $this->conex->prepare($auxSql);
    }

    
    public function bind($parameter, $value, $type = null) {
        if (is_null($type)) {
            if (is_int($value)) {
                $type = PDO::PARAM_INT;
            } elseif (is_bool($value)) {
                $type = PDO::PARAM_BOOL;
            } elseif (is_null($value)) {
                $type = PDO::PARAM_NULL;
            } else {
                $type = PDO::PARAM_STR;
            }
        }

        $this->coman->bindValue($parameter, $value, $type);
    }

    public function execute() {
        try {
            return $this->coman->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }


    public function resultSet() {
        $this->execute();
        return $this->coman->fetchAll(PDO::FETCH_OBJ);
    }

  
    public function singleRow() {
        $this->execute();
        return $this->coman->fetch(PDO::FETCH_OBJ);
    }


    public function rowCount() {
        $this->execute();
        return $this->coman->rowCount();
    }
    

    public function getComentariosPorPublicacion($publicacion_id) {
        $this->query("SELECT * FROM comentarios WHERE publicacion_id = :publicacion_id");
        $this->bind(':publicacion_id', $publicacion_id);
        return $this->resultSet();
    }
}
?>
