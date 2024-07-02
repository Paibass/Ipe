<?php
use helper\Database;
use helper\MustachePresenter;
use helper\Router;

include_once ("controller/SongsController.php");
include_once ("controller/ToursController.php");
include_once ("controller/LaBandaController.php");
include_once ("controller/InicioController.php");
include_once ("controller/UserController.php");
include_once ("controller/NivelController.php");
include_once ("controller/InscripcionController.php");

include_once ("model/SongsModel.php");
include_once ("model/ToursModel.php");
include_once ("model/UserModel.php");
include_once ("model/InscripcionModel.php");

include_once ("helper/Database.php");
include_once ("helper/Router.php");

include_once ("helper/Presenter.php");
include_once ("helper/MustachePresenter.php");

include_once('vendor/mustache/src/Mustache/Autoloader.php');

class Configuration
{

    // CONTROLLERS
    public static function getInscripcionController(){
        return new InscripcionController(self::getInscripcionModel(), self::getPresenter());
    }
    public static function getNivelController(){
        return new NivelController(self::getPresenter());
    }
    public static function getUserController()
    {
        return new UserController(self::getUserModel(), self::getPresenter());
    }
    public static function getLaBandaController()
    {
        return new LaBandaController(self::getPresenter());
    }

    public static function getInicioController()
    {
        return new InicioController(self::getPresenter());
    }

    public static function getToursController()
    {
        return new ToursController(self::getToursModel(), self::getPresenter());
    }

    public static function getSongsController()
    {
        return new SongsController(self::getSongsModel(), self::getPresenter());
    }

    // MODELS
    private static function getInscripcionModel(){
        return new InscripcionModel(self::getDatabase());
    }
    private static function getUserModel(){
        return new UserModel(self::getDatabase());
    }
    private static function getToursModel()
    {
        return new ToursModel(self::getDatabase());
    }

    private static function getSongsModel()
    {
        return new SongsModel(self::getDatabase());
    }


    // HELPERS
    public static function getDatabase()
    {
        $config = self::getConfig();
        return new Database($config["servername"], $config["username"], $config["password"], $config["dbname"]);
    }

    private static function getConfig()
    {
        return parse_ini_file("config/config.ini");
    }


    public static function getRouter()
    {
        return new Router("getInicioController", "home");
    }

    private static function getPresenter()
    {
        return new MustachePresenter("view/template");
    }
}