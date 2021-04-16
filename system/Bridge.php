<?php session_start(); ob_start();

try {
    #Load thư viện Mail
    include 'Lib/PHPMailer/PhpMail.php';

    #Load Config
    include './app/Config/config.php';
    include './app/Config/database.php';
    include './app/Config/routes.php';

    include 'Core/DB.php';

    include 'Core/Helper.php';

    include 'Core/Controller.php';


    #Load helper
    if (count($env_config['autoload_helper']) > 0) {
        foreach ($env_config['autoload_helper'] as $env_config_helper) {
            include './app/Helpers/' . $env_config_helper . '.php';
        }
    }


    #Load Core
    if (count($env_config['autoload_core']) > 0) {
        foreach ($env_config['autoload_core'] as $env_config_core) {
            include './app/Core/' . $env_config_core . '.php';
        }
    }

    #AutoLoad
    if (count($env_config['autoload']) > 0) {
        foreach ($env_config['autoload'] as $env_config_core) {
            include './app/Autoload/' . $env_config_core . '.php';
        }
    }



    #Load APP
    include 'Core/App.php';
    $APP = new App();

} catch (Exception $e) {
    echo $e->getMessage();
}