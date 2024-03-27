<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel 10 Custom Login and Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container">
        <a class="navbar-brand" href="#">VK Market</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                </li>
            </ul>
            @if(isset($_COOKIE['user']))
            <form action="{{ route('create') }}" method="GET" class="d-flex" role="search" style="margin-right: 15px;">
                @csrf
                @method('GET')
                <button class="btn btn-primary" type="submit">Добавить объявление</button>
            </form>
            <form action="{{ route('logout') }}" method="POST" class="d-flex" role="search">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger" type="submit">Выйти</button>
            </form>
                @endif
        </div>
    </div>
</nav>

<div class="container">
    <h1> Welcome</h1>
</div>
<div>
    @foreach($users as $post)
        <div class="card mx-auto mt-3" style="width: 25rem;" >
            <img src={{$post->imageUrl}} class="card-img-top" style="max-height:400px;">
            <div class="card-body">
                <h5 class="card-title">{{$post->title}}</h5>
                <p class="card-text">{{$post->description}}</p>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">ID объявления: {{$post->id}}</li>
                <li class="list-group-item">Цена: {{$post->price}}</li>
            </ul>
            @if($post->isSelf == true)
            <div class="card-body bg-info text-dark">
                <li class="list-group-item">Это ваше объявление</li>
            </div>
            @else
                <div class="card-body">
                    <li class="list-group-item">От: {{$post->author}}</li>
                </div>
            @endif
        </div>
    @endforeach

    <div class="mt-3">
        {{$users->links()}}
    </div>
</div>
</body>
</html>
