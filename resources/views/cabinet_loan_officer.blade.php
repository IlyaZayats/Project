
<!DOCTYPE html>
<html lang="ru">

<head>
    <title>Личный кабинет | Просмотр заявок</title>
    <meta charset='utf-8'/>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'/>
    <link href="http://194.67.116.171/css/bootstrap.css" rel="stylesheet">
    <link rel="shortcut icon" href="http://194.67.116.171/img/tiunoff.png" type="image/png">
    <link rel="stylesheet" href="http://194.67.116.171/css/cabinet_loan_officer.css">
    <link rel="stylesheet" href="http://194.67.116.171/css/nav-style.css">
</head>

<body>
<!-- - - - - - - - - - - - - - - - -  N A V B A R - - - - - - - - - - - - - - - - - -  -  -->
<nav class="navbar navbar-expand-lg" style="background-color: black;"></nav>

<div class="p-3 mb-2 bg-dark">
    <ul class="nav justify-content-end">
        <li class="nav-item col-12 col-md-11">
            <a class="nav-link text-white" href="#">Главная</a>
        </li>
        <li class="nav-item col-12 col-md-1">
            <button type="button" class="btn btn-style" onclick="location.href='http://194.67.116.171/leave'">Выйти</button>
        </li>
    </ul>
</div>
<!-- - - - - - - - - - - - - - - - -  N A V B A R - - - - - - - - - - - - - - - - - -  -  -->

<div class="container-fluid">
    <div class="col-md-12 mt-4 mb-5 text-center title_lk">
        <h1 class = "py-3">ЛИЧНЫЙ КАБИНЕТ</h1>
    </div>
    <div class="col-md-12 mt-4 mb-5 text-center">
        <h3 style="font-weight: bold">ЗАЯВКИ НА ПОЛУЧЕНИЕ КРЕДИТА</h3>
    </div>

    <div class="row justify-content-center">
        <div class = "col-md-7 mb-5 pb-5">
            @if(!empty($data))
                <table class="table table-dark table-bordered table-hover mb-5 mt-5 text-center">
                    <thead>
                    <tr>
                        <th class="col">ID ЗАЯВКИ</th>
                        <th class="col">ИНН</th>
                        <th class="col">ДЕЙСТВИЕ ПО ЗАЯВКЕ</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $item)
                        <tr>
                            <th class="col">{{$item->id_app}}</th>
                            <th class="col">{{$item->ITN}}</th>
                            <th class="col">
                                <div>
                                    <a href="http://194.67.116.171/application/{{$item->ITN}}/{{$item->id_app}}" type="button" class="btn btn-info">
                                        РАССМОТРЕТЬ
                                    </a>
                                </div>
                            </th>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <h1 class="text-center">
                    На данный момент нет новых заявок.
                </h1>
            @endif
        </div>
    </div>
</div>

<!-- - - - - - - - - - - - - - - - -  F  O  O  T  E  R - - - - - - - - - - - - - - - - - -  -  -->
<footer class="bg-dark text-center text-white fixed-bottom">
    <div class="container p-4">

        <section>
            <div class="row">
                <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
                    <h5 class="text-uppercase">Контактная информация:</h5>
                    +7-918-931-39-32
                </div>
                <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
                    <h5 class="text-uppercase">Адрес:</h5>
                    г. Краснодар, ул. Красная 32
                </div>
            </div>
        </section>
    </div>

    <div class="text-center p-3" style="background-color: black;">
        © 2022. Tiunoff bank, официальный сайт.
    </div>
</footer>
<!-- - - - - - - - - - - - - - - - -  F  O  O  T  E  R - - - - - - - - - - - - - - - - - -  -  -->

</body>
<script src="http://194.67.116.171/js/jquery_v3.6.0.js"></script>
<script src="http://194.67.116.171/js/bootstrap.js"></script>
<script src="http://194.67.116.171/js/leave.js"></script>
</html>
