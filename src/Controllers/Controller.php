<?php

namespace DevStream\Controllers;

use League\Plates\Engine;

class Controller
{
    protected Engine $view;

    public function __construct()
    {
        $this->view = new Engine(ROOT_DIR . '/views');
    }
}
