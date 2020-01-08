<?php

namespace Controllers;

class Liga extends Controller
{

    protected $model;
    public function __construct()
    {
        $this->model = new \Models\Liga;
        parent::__construct($this->model);
    }

}
