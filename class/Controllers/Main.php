<?php

namespace Controllers;

use PDO;
use Handles\Handle;
use AltoRouter;

final class Main extends Controller
{

    public function __construct(){

        //ustawienie routera (wszytskie adnotacje w klasie Tools/Router)
        $router = \Tools\Router::getRouter();
        //dopasowanie
        $match = $router->match();

        try {
            $controller = isset($match['target']['controller'])  ? $match['target']['controller'] : 'Index';
            $action     = isset($match['target']['action'])      ? $match['target']['action']     : 'home';
            $id         = isset($match['params']['id'])          ? $match['params']['id']         : null;

            // Dodanie do nazwy kontrolera przestrzeni nazw
            $fullController = 'Controllers\\'.$controller;
            // Utworzenie kontrolera (jeśli istnieje)
            if (!class_exists($fullController)) {
                throw new \Exceptions\Application();
            }
            $appController = new $fullController();

            // Sprawdzamy, czy akcja kontrolera istnieje
            if (!method_exists($appController, $action)) {
                throw new \Exceptions\Application();
            }
            // Uruchamiamy akcję kontrolera

            $result = $appController->$action($id);

            //Wyświetlenie strony
            echo $result;



        } catch(\Exceptions\DatabaseConnection $e) {
            d($e);
            //$this->redirect('404.html');
        } catch(\Exceptions\General $e) {
            d($e);
            //$this->redirect('404.html');
        } catch(\Exception $e) {
            $this->redirect('404.html');
        }

    }

}
