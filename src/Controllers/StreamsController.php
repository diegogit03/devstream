<?php

namespace DevStream\Controllers;

use DevStream\Models\Stream;

class StreamsController extends Controller
{
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

    public function create()
    {
        return $this->view->render('createStream');
    }
}
