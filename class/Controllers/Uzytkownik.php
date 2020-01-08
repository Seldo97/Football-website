<?php

namespace Controllers;

class Uzytkownik extends Controller
{

    protected $model;
    public function __construct()
    {
        $this->model = new \Models\Uzytkownik;
        parent::__construct($this->model);
    }

}
