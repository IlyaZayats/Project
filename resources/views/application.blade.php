<!DOCTYPE html>
<html lang="ru">
<head>
    <title>Личный кабинет | Заявка №{{$id}}</title>
    <link rel="shortcut icon" href="http://194.67.116.171/img/tiunoff.png" type="image/png">
    <meta charset='utf-8'/>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'/>
    <link href="http://194.67.116.171/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="http://194.67.116.171/css/cabinet_loan_officer.css"/>
    <link rel="stylesheet" href="http://194.67.116.171/css/nav-style.css"/>
</head>

<body>
<!-- - - - - - - - - - - - - - - - -  N A V B A R - - - - - - - - - - - - - - - - - -  -  -->
<nav class="navbar navbar-expand-lg" style="background-color: black;"></nav>

<div class="p-3 mb-2 bg-dark">
    <ul class="nav justify-content-end">
        <li class="nav-item col-12 col-md-11">
            <a class="nav-link text-white" href="http://194.67.116.171/">Главная</a>
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

    <div class="col-md-12 mt-4 mb-3 text-center title_lk">
        <h5 style="font-weight: bold"><a class="text-danger" id="dropApplication" href="http://194.67.116.171/drop_application">АКТИВНЫЕ ЗАЯВКИ</a>/ЗАЯВКА №{{$id}}</h5>
    </div>
    <br/>

    <div class="row justify-content-center">
        <div class="col-md-12 mt-5 mb-5 pb-5">
            <div class="lk_buttons">
                <button type="button" class="lk_but p-3" onclick="location.href='http://194.67.116.171/additional_data_check'">
                    ПРОВЕРКА ДАННЫХ, ОБЯЗАТЕЛЬНЫХ ДЛЯ КРЕДИТА
                </button><br>
                <button type="button" class="lk_but p-3" onclick="location.href='http://194.67.116.171/loan_response'">
                    ФОРМИРОВАНИЕ ОТВЕТА ПО КРЕДИТУ
                </button>
                <div class="m-5"></div>
            </div>
        </div>
    </div>
</div>

<!-- - - - - - - - - - - - - - - - -  F  O  O  T  E  R - - - - - - - - - - - - - - - - - -  -  -->
<footer class="bg-dark text-center text-white fixed-bottom">
    <div class="container p-4">
        <!--<section>
          <form action="">
            <div class="row d-flex justify-content-center">
              <div class="col-auto">
                <p class="pt-2">
                  <strong>Подпишитесь на нашу рассылку</strong>
                </p>
              </div>
              <div class="col-md-5 col-12">
                Email input
                  <div class="form-outline form-white mb-4">
                  <input type="email" id="form5Example21" class="form-control" />
                  <label class="form-label" for="form5Example21">Адрес электронной почты</label>
                </div>
              </div>
              <div class="col-auto">
                <button type="submit" class="btn btn-outline-light mb-4">
                  Подписаться
                </button>
              </div>
            </div>
          </form>
        </section>
      -->
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
<script src="http://194.67.116.171/js/loan_officer/cabinet_loan_officer_application.js"></script>
</html>
