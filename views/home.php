<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://vjs.zencdn.net/7.2.3/video-js.css" rel="stylesheet">
</head>

<body>
    <?php foreach ($streams as $stream) { ?>
        <a href="/streams/<?= $stream->id ?>"><?= $stream->title ?></a>
    <?php } ?>
</body>

</html>