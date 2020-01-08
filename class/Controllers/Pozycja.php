<?php

namespace Controllers;

class Pozycja extends Controller
{

    protected $model;
    public function __construct()
    {
        $this->model = new \Models\Pozycja;
        parent::__construct($this->model);
    }

}
