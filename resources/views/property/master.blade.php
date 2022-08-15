<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laradev: CRUD imobiliaria</title>

    <link rel="stylesheet" href="<?= asset('css/app.css'); ?>">
</head>
<body>

<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="container">
        <a href="#" class="navbar-brand">Lara<strong>Dev</strong></a>
        <ul class="navbar-nav ml-auto">
            <li><a href="<?= url('/imoveis'); ?>" class="nav-link">Listar todos os Imoveis</a></li>
            <li><a href="<?= url('/imoveis/novo'); ?>" class="nav-link">Cadastro novo Imóvel</a></li>
        </ul>
    </div>
</nav>

@yield('content')

<script src="<?= asset('js/app.js'); ?>"></script>
    
</body>
</html>