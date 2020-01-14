<?php

namespace Controllers;

class Index extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function home()
    {
        return $this->twig->render( 'index.html.twig', [
                                    'url' => $this->url,
                                    'sesja' => $_SESSION ]);
    }
}
