<?php

namespace DevStream\Controllers;

use DevStream\Models\Stream;
use League\Plates\Engine;

class StreamsController
{
    protected Engine $view;

    public function __construct()
    {
        $this->view = new Engine(ROOT_DIR . '/views');
    }

    public function index()
    {
        $model = new Stream();
        $streams = $model->all();

        return $this->view->render('home', compact('streams'));
    }

    public function show($id)
    {
        $model = new Stream();
        $stream = $model->find($id);

        return $this->view->render('stream', compact('stream'));
    }
}
