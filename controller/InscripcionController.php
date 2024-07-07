<?php
class InscripcionController{
    private $model;
    private $presenter;

    public function __construct($model, $presenter)
    {
        $this->model = $model;
        $this->presenter = $presenter;
    }

    public function preinscripcion(){
        if(isset($_SESSION['usuario'])){
            $user= $_SESSION['usuario'][0];
            $check = $this->model->existePreinscripcion($user['id_usuario']);
            var_dump($check);
            if(!$check){
                if($user['tipo'] == "1")
                {
                    $this->presenter->render("view/preinscripcionTerciario.mustache", ['user' => $user]);
                }
                else if($user['tipo'] == "2")
                {
                    $this->presenter->render("view/preinscripcion.mustache");
                }
            }
            else{
                $_SESSION['msg'] = "Ya tenes una preinscripcion en curso!";
                $msg = $_SESSION['msg'];
                $this->presenter->render("view/errorView.mustache", ["msg" => $msg]);
            }
        }}
        else{
            header('location: /user/loginView');
        }
    }

    public function tuPerfil()
    {
        if (isset($_SESSION['usuario'])) {
            $user = $_SESSION['usuario'][0];
            $estado = $this->model->verEstado($user['id_usuario']);
            if ($estado == null){
                $estado = 'No hay tramites iniciados';
            }
            $this->presenter->render("view/miPerfilview.mustache", ['user' => $user, 'estado' => $estado]);
        } else {
            header('location: /user/loginView');
        }
    }

    public function procesarPreinscripcion(){
        $rta = $this->model->procesarPreinscripcion();
        if ($rta){
            header('location: /inscripcion/tuPerfil');
        }else{
            header ('location: /inscripcion/preinscripcion');
        }
    }

    public function activarFecha(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['fecha']) && $_POST['fecha'] == '1') {
                $_SESSION['fecha'] = TRUE;
            } else {
                $_SESSION['fecha'] = FALSE;
            }
            header('location: /');
        }
    }
    public function inscripcion(){
        if (isset($_SESSION['usuario'])) {

            $user = $_SESSION['usuario'][0];
            $check = $this->model->existeInscripcion($user['id_usuario']);
            if($check){
                if($user['tipo'] == "1")
                {

                    $this->presenter->render("view/inscripcionTerciario.mustache", ['user' => $user]);
                }
            }else{
                $_SESSION['msg'] = "Ya tenes una inscripcion en curso!";
                $msg = $_SESSION['msg'];
                $this->presenter->render("view/errorView.mustache", ["msg" => $msg]);
            }
        }
        }
    }

    public function procesarInscripcion(){
        $rta = $this->model->procesarInscripcion();
        if ($rta){
            header('location: /inscripcion/tuPerfil');
        }else{
            header ('location: /inscripcion/preinscripcion');
        }
    }

}
