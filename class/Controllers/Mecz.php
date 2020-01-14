<?php

namespace Controllers;

class Mecz extends Controller
{

    protected $model;
    protected $druzyna;

    public function __construct()
    {
        parent::__construct();
        $this->model = new \Models\Mecz;
        $this->druzyna = new \Models\Druzyna;
    }

    //do UPDATE //
     public function createForm($id){
         $daneMecz = $this->model->selectOneById($id);
         $daneDruzyna = $this->druzyna->showAll();

          return $this->twig->render( 'Mecz/formMeczUpdate.html.twig', [
                                    'id' => $id,'mecze' =>$daneMecz[0],
                                    'druzyny' => $daneDruzyna,
                                    'url' => $this->url,
                                    'prevUrl' => $_SERVER['HTTP_REFERER'],
                                    'sesja' => $_SESSION]);

    }

    public function createModalForm($id){
        $daneMecz = $this->model->selectOneById($id);
        $daneDruzyna = $this->druzyna->showAll();

         return $this->twig->render( 'Mecz/formMeczUpdateModal.html.twig', [
                                   'id' => $id,'mecze' =>$daneMecz[0],
                                   'druzyny' => $daneDruzyna,
                                   'url' => $this->url,
                                   'prevUrl' => $_SERVER['HTTP_REFERER'],
                                   'sesja' => $_SESSION]);

   }

    // do INSERTA //
    public function insertForm(){
        $daneDruzyna = $this->druzyna->showAll();

         return $this->twig->render( 'Mecz/formMeczInsert.html.twig', [
                                    'druzyny' => $daneDruzyna,
                                    'url' => $this->url,
                                    'prevUrl' => $_SERVER['HTTP_REFERER'],
                                    'sesja' => $_SESSION ]) ;

    }

    public function showView()
    {

        $daneMecz = $this->model->showView();
        return $this->twig->render( 'Mecz/tabelaMecz.html.twig', [
                                    'mecze' => $daneMecz,
                                    'url' => $this->url,
                                    'sesja' => $_SESSION ] );

    }

    public function showNadchodzace()
    {
        $filtr = "WHERE rozegrany IS NULL OR rozegrany = 0";
        $daneMecz = $this->model->showView($filtr);
        return $this->twig->render( 'Mecz/tabelaMecz.html.twig', [
                                    'mecze' => $daneMecz,
                                    'url' => $this->url,
                                    'sesja' => $_SESSION ] );
    }

    public function showRozegrane()
    {
        $filtr = "WHERE rozegrany IS NOT NULL OR rozegrany != 0";
        $daneMecz = $this->model->showView($filtr);
        return $this->twig->render( 'Mecz/tabelaMecz.html.twig', [
                                    'mecze' => $daneMecz,
                                    'url' => $this->url,
                                    'sesja' => $_SESSION ] );
    }

    public function delete($id)
    {
        $this->model->deleteOneById($id);

        $this->redirect($_SERVER['HTTP_REFERER']);

    }

    public function update()
    {

        if(isset($_POST["druzyna_gospodarz"])
            && isset($_POST["druzyna_gosc"])
            && isset($_POST["data"])
            && isset($_POST["godzina"])
            && (trim($_POST["druzyna_gospodarz"]!=""))
            && (trim($_POST["druzyna_gosc"]!=""))
            && (trim($_POST["data"]!=""))
            && (trim($_POST["godzina"]!=""))
        ){

            $id_mecz           = $_POST["id_mecz"];
            $druzyna_gospodarz = $_POST["druzyna_gospodarz"];
            $druzyna_gosc      = $_POST["druzyna_gosc"];
            if($_POST["rozegrany"] == 1){
                $wynik_gospodarz   = isset(($_POST["wynik_gospodarz"])) ? $_POST["wynik_gospodarz"] : "NULL";
                $wynik_gosc        = isset(($_POST["wynik_gosc"])) ? $_POST["wynik_gosc"] : "NULL";
            }else {
                $wynik_gospodarz   = "NULL";
                $wynik_gosc        = "NULL";
            }
            $data              = $_POST["data"];
            $godzina           = $_POST["godzina"];
            $rozegrany         = $_POST["rozegrany"];

            $this->model->updateById($id_mecz, $druzyna_gospodarz, $druzyna_gosc, $wynik_gospodarz, $wynik_gosc, $data, $godzina, $rozegrany);

            $this->redirect($_POST["prevUrl"]);

        }else{

            $this->redirect("mecz/formularzUpdate/".$_POST["id_mecz"]);

            }
    }

    public function insert()
    {
        if(isset($_POST["druzyna_gospodarz"])
            && isset($_POST["druzyna_gosc"])
            && isset($_POST["data"])
            && isset($_POST["godzina"])
            && (trim($_POST["druzyna_gospodarz"]!=""))
            && (trim($_POST["druzyna_gosc"]!=""))
            && (trim($_POST["data"]!=""))
            && (trim($_POST["godzina"]!=""))
        ){

            $druzyna_gospodarz = $_POST["druzyna_gospodarz"];
            $druzyna_gosc      = $_POST["druzyna_gosc"];
            if($_POST["rozegrany"] == 1){
                $wynik_gospodarz   = isset(($_POST["wynik_gospodarz"])) ? $_POST["wynik_gospodarz"] : "NULL";
                $wynik_gosc        = isset(($_POST["wynik_gosc"])) ? $_POST["wynik_gosc"] : "NULL";
            }else {
                $wynik_gospodarz   = "NULL";
                $wynik_gosc        = "NULL";
            }
            $data              = $_POST["data"];
            $godzina           = $_POST["godzina"];
            $rozegrany         = $_POST["rozegrany"];

            $this->model->insertRow($druzyna_gospodarz, $druzyna_gosc, $wynik_gospodarz,
                                    $wynik_gosc, $data, $godzina, $rozegrany);

            $this->redirect($_POST["prevUrl"]);

        }else{

            $this->redirect("mecz/formularzDodaj");

        }
    }




}
