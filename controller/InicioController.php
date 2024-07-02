<?php
class InicioController
{
    private $presenter;
    public function __construct($presenter){
        $this->presenter = $presenter;
    }

    public function home()
    {
        $usuario = $_SESSION['usuario'] ?? null;
        $this->presenter->render("view/homeView.mustache", ['usuario' => $usuario]);
    }

    public function institucion(){
        $usuario = $_SESSION['usuario'] ?? null;
        $this->presenter->render("view/institucionView.mustache", ['usuario' => $usuario]);
    }

}