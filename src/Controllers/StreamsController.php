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
        $model = new Stream();
        $streams = $model->all();

        return $this->render('home', compact('streams'));
    }

    public function show(RequestInterface $request, array $args)
    {
        $model = new Stream();
        $stream = $model->find($args['id']);

        $userModel = new User();
        $user = $userModel->find($stream->user_id);

        return $this->render('stream', compact('stream', 'user'));
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
        $size = $_FILES['image']['size'];

        $fp = fopen($tmpImage, "rb");
        $image = fread($fp, $size);
        $image = addslashes($image);
        fclose($fp);

        $model = new Stream();
        $stream = $model->create([
            'title'=> $_POST['title'],
            'record_id'=> $recordId,
            'user_id' => $user->id,
            'image' => $image
        ]);

        $stream = $model->findBy('record_id', $recordId);

        return $this->redirect("/streams/{$stream->id}/edit");
    }

    public function edit(RequestInterface $request, $args)
    {
        $id = $args['id'];

        $model = new Stream();
        $stream = $model->find($id);

        $stream->image = base64_encode($stream->image);

        return $this->render('streamEditor', compact('stream'));
    }

    public function update(RequestInterface $request, $args)
    {
        $id = $args['id'];
        $title = $_POST['title'];

        $query = Connection::getInstance()->prepare('UPDATE streams SET `title` = ? WHERE id = ?');
        $query->execute([$title, $id]);

        return $this->redirect('back');
    }
}
