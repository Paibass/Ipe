<?php
class NivelController {

    private $presenter;
    public function __construct($presenter){
        $this->presenter = $presenter;
    }

    public function inicial()
    {
        $usuario = $_SESSION['usuario'] ?? null;
        $this->presenter->render("view/inicialView.mustache",['usuario' => $usuario]);
    }

    public function primario()
    {
        $usuario = $_SESSION['usuario'] ?? null;
        $this->presenter->render("view/primarioView.mustache",['usuario' => $usuario]);
    }

    public function secundario()
    {
        $usuario = $_SESSION['usuario'] ?? null;
        $this->presenter->render("view/secundarioView.mustache",['usuario' => $usuario]);
    }

    public function secundarioTecnico()
    {
        $usuario = $_SESSION['usuario'] ?? null;
        $this->presenter->render("view/secundarioTecnicoView.mustache",['usuario' => $usuario]);
    }

    public function secundarioBasico()
    {
        $usuario = $_SESSION['usuario'] ?? null;
        $this->presenter->render("view/secundarioBasicoView.mustache",['usuario' => $usuario]);
    }

    public function terciario()
    {
        $usuario = $_SESSION['usuario'] ?? null;
        $this->presenter->render("view/terciarioView.mustache",['usuario' => $usuario]);
    }

}