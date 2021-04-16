<?php

class Controller
{
    protected function loadModel($model = '')
    {
        if (file_exists('./app/Models/' . $model . '.php')) {
            include './app/Models/' . $model . '.php';
            
            $nameModel = explode("/", $model);
            $nameModel = end($nameModel);

            return new $nameModel;
        }
    }

    protected function loadView($view = '', $data = [])
    {
        global $env_config;

        if (file_exists('./app/Views/' . $view . '.php')) {
            include './app/Views/' . $view . '.php';
        }

        return null;
    }
}