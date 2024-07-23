<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>login</title>
    <link rel="website icon" type="png" href="{{ asset('images/perfume.png') }}" >
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <style>
        body {
          overflow: hidden;
          background: #232525 no-repeat center center fixed;
          background-size: cover;
          position: fixed;
          padding: 0px;
          margin: 0px;
          width: 100%;
          height: 100%;
          font: normal 14px/1.618em "Roboto", sans-serif;
          -webkit-font-smoothing: antialiased;
        }
    </style>
</head>
<body>
       <div class='container'>
    <div class="card position-absolute top-50 start-50 translate-middle">
        <div class="card-header text-danger text-center">
            @if ($errors->any())
            @foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach
            @endif
            @if($isTruePass==false)
                كلمة السر غير موجودة
            @endif
            {{-- @session('error')
                {{ session('error') }}
            @endsession --}}
        </div>
        <div class="card-body">
          <form  class="info" action="{{ route('empProfile') }}" method="post">
            @csrf
            <h5 class="card-title">password</h5>
            <input type="password" name="password" required autofocus />
            <input class="mt-2" type="submit" value="login" />
        </form> 
        </div>
      </div>
    </div>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
  </body>
</html>