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
            $model_Rejestracja = new \Models\Rejestracja();
            $model_Rejestracja->registerParticipant();
            $this->redirect('');
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
