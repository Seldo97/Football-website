<?php

namespace Controllers;

class Uzytkownik extends Controller
{

    protected $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = new \Models\Uzytkownik();
    }

    // pokazuje form logowania
    public function zalogujForm()
    {
        $_SERVER['HTTP_REFERER'] = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : null;
        return $this->twig->render(
            'Uzytkownik/logowanie.html.twig',
            [
                'url' => $this->url,
                'prevUrl' => $_SERVER['HTTP_REFERER'],
                'sesja' => $_SESSION
            ]
        );
    }

    // loguje do systemu
	public function login()
    {
        $model = new \Models\Uzytkownik();
		if($_POST['login']  !== null && $_POST['haslo'] !== null)
        {
            //d($_POST['login']);
            //d($_POST['haslo']);
			if( $model->login($_POST['login'], $_POST['haslo']) )
                $this->redirect('');
		}
		$this->redirect('uzytkownik/loginForm');
	}

	// wylogowywuje z systemu
	public function logout()
    {
        $model = new \Models\Uzytkownik();
		$model->logout();
		$this->redirect('');
	}
}
