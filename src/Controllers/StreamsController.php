<?php

namespace DevStream\Controllers;

use DevStream\Auth;
use DevStream\Models\Connection;
use DevStream\Models\Stream;
use DevStream\Models\User;
use Psr\Http\Message\RequestInterface;
use Symfony\Component\Uid\Uuid;

class StreamsController extends Controller
{
    public function index()
    {
        $streams = Stream::all();

        return $this->render('home', compact('streams'));
    }

    public function show(RequestInterface $request, array $args)
    {
        $stream = Stream::find($args['id']);

        $stream->load('user');
        $stream->load('messages.user');

        $user_id = Auth::user()->id;

        return $this->render('stream', compact('stream', 'user_id'));
    }

    public function create()
    {
        return $this->render('streamEditor');
    }

    public function store(RequestInterface $request)
    {
        $user = Auth::user();
        $recordId = Uuid::v4();

        $tmpImage = $_FILES['image']['tmp_name'];
        $name = $_FILES['image']['name'];

        $filename = Uuid::v4() . '-' . $name;

        move_uploaded_file($tmpImage, ROOT_DIR . '/public/uploads/' . $filename);

        $model = new Stream();
        $stream = $model->create([
            'title'=> $_POST['title'],
            'record_id'=> $recordId,
            'user_id' => $user->id,
            'image_filename' => $filename
        ]);

        return $this->redirect("/streams/{$stream->id}/edit");
    }

    public function edit(RequestInterface $request, $args)
    {
        $id = $args['id'];

        $model = new Stream();
        $stream = $model->find($id);

        return $this->render('streamEditor', compact('stream'));
    }

    public function update(RequestInterface $request, $args)
    {
        $id = $args['id'];
        $title = $_POST['title'];

        $stream = (new Stream())->find($id);
        $tmpImage = $_FILES['image']['tmp_name'];

        unlink(ROOT_DIR . '/public/uploads/' . $stream->image_filename);
        move_uploaded_file($tmpImage, ROOT_DIR . '/public/uploads/' . $stream->image_filename);

        $query = Connection::getInstance()->prepare('UPDATE streams SET `title` = ? WHERE id = ?');
        $query->execute([$title,$id]);

        return $this->redirect('back');
    }
}
