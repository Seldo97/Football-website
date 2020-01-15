<?php

namespace Controllers;

class Zawodnik extends Controller
{
    protected $model;
    protected $pozycja;
    protected $druzyna;

    public function __construct()
    {
        parent::__construct();
        $this->model = new \Models\Zawodnik;
        $this->pozycja = new \Models\Pozycja;
        $this->druzyna = new \Models\Druzyna;
        //parent::__construct($this->model, 'Druzyna');
    }

    public function createForm($id){

        $daneZawodnik = $this->model->selectOneById($id);
        $danePozycja = $this->pozycja->showAll();
        $daneDruzyna = $this->druzyna->showAll();

         return $this->twig->render('Zawodnik/formZawodnikUpdate.html.twig', [
                                    'id' => $id,
                                    'zawodnicy' =>$daneZawodnik[0],
                                    'url' => $this->url,
                                    'pozycje' =>  $danePozycja,
                                    'druzyny' => $daneDruzyna,
                                    'prevUrl' => $_SERVER['HTTP_REFERER'],
                                    'sesja' => $_SESSION ] );

    }

    public function createModalForm($id){

        $daneZawodnik = $this->model->selectOneById($id);
        $danePozycja = $this->pozycja->showAll();
        $daneDruzyna = $this->druzyna->showAll();

         return $this->twig->render('Zawodnik/formZawodnikUpdateModal.html.twig', [
                                    'id' => $id,
                                    'zawodnicy' =>$daneZawodnik[0],
                                    'url' => $this->url,
                                    'pozycje' =>  $danePozycja,
                                    'druzyny' => $daneDruzyna,
                                    'prevUrl' => $_SERVER['HTTP_REFERER'],
                                    'sesja' => $_SESSION ] );

    }

    public function insertForm(){
        $danePozycja = $this->pozycja->showAll();
        $daneDruzyna = $this->druzyna->showAll();

         return $this->twig->render('Zawodnik/formZawodnikInsert.html.twig', [
                                    'url' => $this->url,
                                    'pozycje' =>  $danePozycja,
                                    'druzyny' => $daneDruzyna,
                                    'prevUrl' => $_SERVER['HTTP_REFERER'],
                                    'sesja' => $_SESSION ]);

    }

    public function showAll()
    {
        $daneZawodnik = $this->model->showAll();
        //return $this->twig->render('Zawodnik/tabelaZawodnik.html.twig', ['zawodnicy' =>$daneZawodnik, 'url' => $this->url]);
    }

    public function showView()
    {
        $daneZawodnik = $this->model->showView();
        return $this->twig->render('Zawodnik/tabelaZawodnik.html.twig', [
                                                                        'zawodnicy' =>$daneZawodnik,
                                                                        'url' => $this->url,
                                                                        'sesja' => $_SESSION ]);
    }

    public function showSklad($id_druzyna)
    {
        $filtr = "WHERE D.id_druzyna = $id_druzyna";
        $daneZawodnik = $this->model->showView($filtr);
        return $this->twig->render('Zawodnik/tabelaZawodnik.html.twig', [
                                                                        'zawodnicy' =>$daneZawodnik,
                                                                        'url' => $this->url,
                                                                        'filtrowana' => 1,
                                                                        'id_druzyna' => $id_druzyna,
                                                                        'sesja' => $_SESSION ]);
    }

    public function dodajDoSkladu($id_druzyna)
    {
        $danePozycja = $this->pozycja->showAll();
        $daneDruzyna = $this->druzyna->selectOneById($id_druzyna);

         return $this->twig->render('Zawodnik/formZawodnikInsert.html.twig', [
                                    'url' => $this->url,
                                    'pozycje' =>  $danePozycja,
                                    'druzyny' => $daneDruzyna[0],
                                    'id_druzyna' => $id_druzyna,
                                    'prevUrl' => $_SERVER['HTTP_REFERER'],
                                    'sesja' => $_SESSION ]);
    }

    public function delete($id)
    {
        $this->model->deleteOneById($id);
        \Tools\Messages::setSuccessMsg("Pomyślnie usunięto wierz.");
        $this->redirect($_SERVER['HTTP_REFERER']);
    }


    public function update()
    {

        if(isset($_POST["imie"])
            && isset($_POST["nazwisko"])
            && isset($_POST["data_urodzenia"])
            && isset($_POST["wzrost"])
            && isset($_POST["narodowosc"])
            && isset($_POST["do_kiedy_kontrakt"])
            && isset($_POST["id_druzyna"])
            && isset($_POST["id_pozycja"])
            && (trim($_POST["imie"]!=""))
            && (trim($_POST["nazwisko"]!=""))
            && (trim($_POST["data_urodzenia"]!=""))
            && (trim($_POST["wzrost"]!=""))
            && (trim($_POST["narodowosc"]!=""))
            && (trim($_POST["do_kiedy_kontrakt"]!=""))
            && (trim($_POST["id_druzyna"]!=""))
            && (trim($_POST["id_pozycja"]!=""))
        ){


            $id                 = $_POST["id_zawodnik"];
            $imie               = $_POST["imie"];
            $nazwisko           = $_POST["nazwisko"];
            $data_urodzenia     = $_POST["data_urodzenia"];
            $wzrost             = $_POST["wzrost"];
            $narodowosc         = $_POST["narodowosc"];
            $do_kiedy_kontrakt  = $_POST["do_kiedy_kontrakt"];
            $id_druzyna         = $_POST["id_druzyna"];
            $id_pozycja         = $_POST["id_pozycja"];

            $this->model->updateById($id, $imie, $nazwisko, $data_urodzenia, $wzrost, $narodowosc,
                                        $do_kiedy_kontrakt, $id_druzyna, $id_pozycja);

            \Tools\Messages::setSuccessMsg("Pomyślnie zaktualizowano wiersz.");
            $this->redirect($_POST["prevUrl"]);

        }else{
            \Tools\Messages::setFailMsg("Wystąpił problem podczas aktualizacji wiersza.");
            $this->redirect("zawodnik/formularzUpdate/".$_POST["id_zawodnik"]);

        }
    }

    public function insert()
    {
        if(isset($_POST["imie"])
            && isset($_POST["nazwisko"])
            && isset($_POST["data_urodzenia"])
            && isset($_POST["wzrost"])
            && isset($_POST["narodowosc"])
            && isset($_POST["do_kiedy_kontrakt"])
            && isset($_POST["id_druzyna"])
            && isset($_POST["id_pozycja"])
            && (trim($_POST["imie"]!=""))
            && (trim($_POST["nazwisko"]!=""))
            && (trim($_POST["data_urodzenia"]!=""))
            && (trim($_POST["wzrost"]!=""))
            && (trim($_POST["narodowosc"]!=""))
            && (trim($_POST["do_kiedy_kontrakt"]!=""))
            && (trim($_POST["id_druzyna"]!=""))
            && (trim($_POST["id_pozycja"]!=""))
        ){

            $imie               = $_POST["imie"];
            $nazwisko           = $_POST["nazwisko"];
            $data_urodzenia     = $_POST["data_urodzenia"];
            $wzrost             = $_POST["wzrost"];
            $narodowosc         = $_POST["narodowosc"];
            $do_kiedy_kontrakt  = $_POST["do_kiedy_kontrakt"];
            $id_druzyna         = $_POST["id_druzyna"];
            $id_pozycja         = $_POST["id_pozycja"];

            $this->model->insertRow($imie, $nazwisko, $data_urodzenia, $wzrost, $narodowosc,
                                        $do_kiedy_kontrakt, $id_druzyna, $id_pozycja);


            \Tools\Messages::setSuccessMsg("Pomyślnie dodano zawodnika $imie $nazwisko.");
            $this->redirect($_POST["prevUrl"]);

        }else{
            \Tools\Messages::setFailMsg("Wystąpił problem podczas dodawania zawodnika.");
            $this->redirect("zawodnik/formularzDodaj");

        }
    }

}
