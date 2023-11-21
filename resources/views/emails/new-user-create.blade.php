<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>email</title>
    <link rel="stylesheet" href="{{asset('assets/bootstrap/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('assets/bootstrap/bootstrap-icons-1.7.2/bootstrap-icons.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/main.css')}}">
</head>

<body>

<div class="holder container col-11 col-sm-10">
    <img class="img-fluid" style="height: 77px;" src="{{asset('assets/images/logo.png')}}" alt="logo">
    <h2 class="mt-3 fw-bolder">Başarılı kayıt</h2>
    <p class="text-muted  fs-5 mt-4">
        Bu bilgilerle siteye kayıt oldunuz.
    </p>
    <div class="my-4 holderBtn">
        <button type="button" class="btn mybtn1">
            <span  id="myInput">Kullanıcı adı : {{$username}}</span>
        </button>
    </div>
    <div class="my-4 holderBtn">
        <button type="button" class="btn mybtn1">
            <span  id="myInput">şifre : {{$password}}</span>
        </button>
    </div>

    <hr>

</div>

</body>

</html>