<?php
class InscripcionModel{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function procesarPreinscripcion()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = $_POST["id"];
            $sql = "INSERT INTO Inscripciones (estado) values ('Iniciado')";
            $this->database->execute($sql);
            $sql = "SELECT id_inscripcion FROM Inscripciones ORDER BY id_inscripcion DESC LIMIT 1";
            $idIns =  $this->database->query($sql);
            $idIns = $idIns[0];
            $idIns = $idIns['id_inscripcion'];
            $sql = "INSERT INTO InscripcionesUsuarios (id_inscripcion, id_usuario) values ('$idIns', '$id')";
            $this->database->execute($sql);
            return true;
        }

    }

    public function existePreinscripcion($id){
        $sql = "SELECT id_inscripcion FROM InscripcionesUsuarios WHERE id_usuario = '$id'";
        $idIns =  $this->database->query($sql);
        if($idIns == null){
            return false;
        }else{
            $idIns = $idIns[0];
            $idIns = $idIns['id_inscripcion'];
            $sql = "SELECT estado FROM Inscripciones WHERE id_inscripcion = '$idIns' and estado = 'Iniciado'";
            var_dump($sql);
            if($this->database->query($sql) == null){
                return false;
            }else{
                return true;
            }
        }

    }

    public function verEstado($id){
        $sql = "SELECT id_inscripcion FROM InscripcionesUsuarios WHERE id_usuario = '$id'";
        $idIns =  $this->database->query($sql);
        if($idIns == null){
            return null;
        }else{
            $idIns = $idIns[0];
            $idIns = $idIns['id_inscripcion'];
            $sql = "SELECT estado FROM Inscripciones WHERE id_inscripcion = '$idIns'";
            $resul =  $this->database->query($sql);
            $resul = $resul[0];
            return $resul;
        }

    }

    public function existeInscripcion($id){
        $sql = "SELECT id_inscripcion FROM InscripcionesUsuarios WHERE id_usuario = '$id'";
        $idIns =  $this->database->query($sql);
        if($idIns == null){
            return false;
        }else{
            $idIns = $idIns[0];
            $idIns = $idIns['id_inscripcion'];
            $sql = "SELECT estado FROM Inscripciones WHERE id_inscripcion = '$idIns' and estado = 'En Curso'";
            if($this->database->query($sql) == null){
                return true;
            }else{
                return false;
            }
        }

    }

    public function procesarInscripcion(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = $_POST["id"];
            $sql = "SELECT id_inscripcion FROM InscripcionesUsuarios WHERE id_usuario = '$id'";
            $idIns =  $this->database->query($sql);

            $idIns = $idIns[0];
            $idIns = $idIns['id_inscripcion'];
            $sql = "UPDATE ipe.Inscripciones set estado = 'En Curso' WHERE id_inscripcion = '$idIns'";
            return $this->database->execute($sql);
        }
    }
}