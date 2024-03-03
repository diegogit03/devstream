<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DevStream</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <?=$this->section('assets')?>
</head>
<body class="bg-secondary">
    <nav class="navbar navbar-expand-lg navbar-light bg-white p-3">
        <div class="container-fluid justify-between">
            <a class="navbar-brand" href="/">Dev<span class="text-primary">Stream</span></a>
            <?php if (DevStream\Auth::user()) { ?>
                <div class="dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                        <?= DevStream\Auth::user()->name ?>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-lg-end" aria-labelledby="dropdownMenuLink">
                        <li><a class="dropdown-item" href="/streams/create"><i class="bi bi-cast"></i> Iniciar stream</a></li>
                        <li><a class="dropdown-item" href="/logout"><i class="bi bi-box-arrow-left"></i> Sair</a></li>
                    </ul>
                </div>
            <?php } else { ?>
                <a class="btn btn-primary btn-lg" href="/login">Entrar</a>
            <?php } ?>
        </div>
    </nav>
    <div class="container">
        <?=$this->section('main')?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <?=$this->section('scripts')?>
</body>
</html>
