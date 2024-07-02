<?php
class UserController
{

    private $model;
    private $presenter;

    public function __construct($model, $presenter)
    {
        $this->model = $model;
        $this->presenter = $presenter;
    }
    public function loginView()
    {
        $msg = isset($_SESSION['msg']) ? $_SESSION['msg'] : null;

        $this->presenter->render("view/loginView.mustache", ["msg" => $msg]);

        unset($_SESSION['msg']);
    }
    public function loginUsuario()
    {
        $usuario = $this->model->loginUsuario();

        if ($usuario != "Error Credenciales No validas") {
            $_SESSION['usuario'] = $usuario;
            header("Location: /");
            exit();
        } else {
            $_SESSION['msg'] = $usuario;
            header("Location: /user/loginView");
            exit();
        }
    }
    public function registerView()
    {
        $this->presenter->render("view/registerView.mustache");
    }

    public function registerAdultoView()
    {
        $this->presenter->render("view/registerAdultoView.mustache");
    }
    public function registerAlumnoView()
    {
        $this->presenter->render("view/registerAlumnoView.mustache");
    }

    public function registroUsuario()
    {
        $usuario = $this->model->registroUsuario();
        header("Location: /user/loginView");
        exit();
    }

}