<?php
namespace Controllers;

class Rejestracja extends Controller
{
    protected $model;

    public function __construct()
    {
        parent::__construct();
        //$this->model = new \Models\Rejestracja;
    }

    public function showFormRegister()
    {

        return $this->twig->render(
            'Uzytkownik/rejestracja.html.twig',[
                'url'   => $this->url,
                'sesja' => $_SESSION ]);
    }

    public function registerParticipant()
    {
        try
        {
            if(isset($_POST["login"])
                && isset($_POST["haslo"])
                && isset($_POST["email"])
                && (trim($_POST["login"]!=""))
                && (trim($_POST["haslo"]!=""))
                && (trim($_POST["email"]!=""))
            ){
                $model_Rejestracja = new \Models\Rejestracja();
                if($model_Rejestracja->registerParticipant() == 1){
                \Tools\Messages::setSuccessMsg("Zostałeś zarejestrowany pomyślnie. Teraz możesz zalogować się na swoje konto.");
                $this->redirect('uzytkownik/loginForm');
            }else{
                \Tools\Messages::setFailMsg("Wystąpił problem podczas rejestracji, spróbuj ponownie.");
                $this->redirect('uzytkownik/registerForm');
            }
            }else{
                \Tools\Messages::setFailMsg("Wystąpił problem podczas rejestracji, spróbuj ponownie.");
                $this->redirect('uzytkownik/registerForm');
            }
        }
        catch(\Exception $e)
        {
            echo 'Błąd:' . $e->getMessage();
            d($e);
        }
    }

    public function showRegisterConfirmation()
    {
        return $this->twig->render(
            'Rejestracja/potwierdzenie.html.twig',
            array()
        );
    }
}
