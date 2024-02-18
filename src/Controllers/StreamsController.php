<?php

namespace DevStream\Controllers;

use DevStream\Auth;
use DevStream\Models\Stream;
use Psr\Http\Message\RequestInterface;
use Symfony\Component\Uid\Uuid;

class StreamsController extends Controller
{
    public function index()
    {
        $model = new Stream();
        $streams = $model->all();

        return $this->render('home', compact('streams'));
    }

    public function show(RequestInterface $request, array $args)
    {
        $model = new Stream();
        $stream = $model->find($args['id']);

        return $this->render('stream', compact('stream'));
    }

    public function create()
    {
        return $this->render('createStream');
    }

    public function store()
    {
        $user = Auth::user();
        $record_id = Uuid::v4();

        $model = new Stream();
        $stream = $model->create([
            'title'=> $_POST['title'],
            'record_id'=> $record_id,
            'user_id' => $user->id,
        ]);

        $stream = $model->findBy('record_id', $record_id);

        return $this->redirect("/streams/{$stream->id}/edit");
    }
}
