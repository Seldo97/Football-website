<?php

namespace Controllers;
//use \Models\Druzyna as dr;

class Druzyna extends Controller
{

    protected $model;
    protected $liga;
    protected $zawodnik;

    public function __construct()
    {
        parent::__construct();
        $this->model = new \Models\Druzyna;
        $this->liga = new \Models\Liga;
        $this->zawodnik = new \Models\Zawodnik;
        $this->pozycja = new \Models\Pozycja;
        //parent::__construct($this->model, 'Druzyna');
    }

    // do UPDATE //
    public function createForm($id){
        $daneDruzyna = $this->model->selectOneById($id);
        $daneLiga = $this->liga->showAll();

         return $this->twig->render( 'Druzyna/formDruzynaUpdate.html.twig', [
                                    'id' => $id,
                                    'druzyny' =>$daneDruzyna[0],
                                    'ligi' => $daneLiga,
                                    'url' => $this->url,
                                    'sesja' => $_SESSION]);
    }

    public function createModalForm($id){
        $daneDruzyna = $this->model->selectOneById($id);
        $daneLiga = $this->liga->showAll();

         return $this->twig->render( 'Druzyna/formDruzynaUpdateModal.html.twig', [
                                    'id' => $id,
                                    'druzyny' =>$daneDruzyna[0],
                                    'ligi' => $daneLiga,
                                    'url' => $this->url,
                                    'sesja' => $_SESSION ]);
    }

    // do INSERTA //
    public function insertForm(){
        $daneLiga = $this->liga->showAll();

         return $this->twig->render( 'Druzyna/formDruzynaInsert.html.twig', [
                                    'ligi' => $daneLiga,
                                    'url' => $this->url,
                                    'sesja' => $_SESSION ]) ;
    }

    public function showAll()
    {
        $daneDruzyna = $this->model->showAll();
        //return $this->twig->render( 'Druzyna/tabelaDruzyna.html.twig', [
        //                            'name' => "Druzyna",'druzyny' =>$daneDruzyna, 'url' => $this->url] );
    }

    public function showView()
    {
        //d($_SESSION);
        //\Tools\Messages::clearMessages();
        $daneDruzyna = $this->model->showView();
        return $this->twig->render( 'Druzyna/tabelaDruzyna.html.twig', [
                                    'name' => "Druzyna",
                                    'druzyny' =>$daneDruzyna,
                                    'url' => $this->url,
                                    'sesja' => $_SESSION ]);
    }

    // public function selectOneById($id)
    // {
    //     $result['data'] = $this->model->selectOneById($id);
    //     return $result;
    // }
    //
    // public function selectOneByName($column, $value)
    // {
    //     $result['data'] = $this->model->selectOneByName($column, $value);
    //     return $result;
    // }

    public function delete($id)
    {
        $this->model->deleteOneById($id);
        \Tools\Messages::setSuccessMsg("Wiersz o id $id został usunięty pomyślnie.");
        $this->redirect("druzynaTabela");
    }

    public function update()
    {

        if(isset($_POST["nazwa"])
            && isset($_POST["id_liga"])
            && (trim($_POST["nazwa"]!=""))
            && (trim($_POST["id_liga"]!=""))
        ){

            $id = $_POST["id_druzyna"];
            $nazwa = $_POST["nazwa"];
            $id_liga = $_POST["id_liga"];

            if($_FILES["logo"]["name"] == "")
                $logo = $_POST["logoBezZmian"];
            else
                $logo = "images/".$_FILES["logo"]["name"];

            $this->model->updateById($id, $logo,$nazwa,$id_liga);

            \Tools\Messages::setSuccessMsg("Wiersz o id $id został zaktualizowany pomyślnie.");
            $this->redirect("druzynaTabela");

        }else{
            \Tools\Messages::setFailMsg("Wystąpił problem podczas aktualizacji wiersza.");
            $this->redirect("druzyna/formularzUpdate/".$_POST["id_druzyna"]);

            }
    }

    public function insert()
    {
        if(isset($_POST["nazwa"])
            && isset($_POST["id_liga"])
            && (trim($_POST["nazwa"]!=""))
            && (trim($_POST["id_liga"]!=""))
        ){

            $nazwa = $_POST["nazwa"];
            if($_FILES["logo"]["name"] != "")
                $logo = "images/".$_FILES["logo"]["name"];
            else
                $logo = "images/braklogo.png";
            $id_liga = $_POST["id_liga"];
            $this->model->insertRow($nazwa, $logo, $id_liga);

            move_uploaded_file($_FILES["logo"]["tmp_name"], $logo);

            \Tools\Messages::setSuccessMsg("Drużyna '$nazwa' została dodana pomyślnie.");
            $this->redirect("druzynaTabela");

        }else{
            \Tools\Messages::setFailMsg("Wystąpił problem podczas dodawania drużyny.");
            $this->redirect("druzyna/formularzDodaj");
        }
    }

}
