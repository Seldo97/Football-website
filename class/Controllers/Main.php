<?php

namespace Controllers;

use PDO;
use Handles\Handle;
use AltoRouter;

final class Main extends Controller
{

    public function __construct(){

        // Inicjalizacja sesji anonimowej
        \Tools\Session::initialize();
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

            if (\Tools\Access::islogin() !== true)
            {   // Logowanie do systemu lub rejestracja
                if ($this->isAccessible($controller,$action))
                {
                    $result = $appController->$action($id);
                }
                else
                {
                    \Tools\Messages::setInfoMsg("Musisz być zalogowany, aby zobaczyć zawartość tej strony.");
                    $this->redirect('uzytkownik/loginForm');
                    //$showPage = $appController->$action($id);
                }
            }
            else
            {   // Sprawdzamy, czy akcja kontrolera istnieje
                if (!\method_exists($appController, $action))
                    throw new \Exceptions\Application();
                // Uruchamiamy akcję kontrolera
                if ($_SESSION['id_uprawnienia'] != 1){
                    if ($this->isAuthorised($controller,$action)){
                        $result = $appController->$action($id);
                    }
                    else{
                        \Tools\Messages::setInfoMsg("Nie posiadasz odpowiednich uprawnień.");
                        $this->redirect($_SERVER['HTTP_REFERER']);
                        //$showPage = $appController->$action($id);
                    }
                }else{
                    $result = $appController->$action($id);
                }

            }

            //Wyświetlenie strony
            echo $result;

            //Czyszczenie komunikatów
            \Tools\Messages::clearMessages();


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

    private function isAccessible($controller, $action, $uprawnienia = null)
    {
        $allowed_controllers = array(
            'Index', 'Druzyna', 'Uzytkownik', 'Rejestracja'
        );

        $allowed_actions = array(
            //strona glowna(Index)
            'home',
            //Druzyna
            'showView',
            //Logowanie
            'zalogujForm', 'login',
            //Rejestracja
            'showFormRegister', 'registerParticipant'

        );

        return in_array($controller, $allowed_controllers) && in_array($action, $allowed_actions);
    }

    private function isAuthorised($controller, $action)
    {
        $allowed_controllers = array(
            'Index', 'Druzyna', 'Uzytkownik', 'Rejestracja', 'Mecz', 'Zawodnik'
        );

        $allowed_actions = array(
            //strona glowna(Index)
            'home',
            //Druzyna
            'showView',
            //Logowanie
            'zalogujForm', 'login', 'logout',
            //Rejestracja
            'showFormRegister', 'registerParticipant',
            //Mecz
            'showNadchodzace', 'showRozegrane',
            //Zawodnik
            'showSklad'
        );

        return in_array($controller, $allowed_controllers) && in_array($action, $allowed_actions);
    }

}
