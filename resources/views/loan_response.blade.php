<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Личный кабинет | Формирование ответа | Заявка №{{$id}}</title>
    <link rel="shortcut icon" href="http://194.67.116.171/img/tiunoff.png" type="image/png">
    <link href="http://194.67.116.171/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="http://194.67.116.171/css/lk_main.css"/>
    <link rel="stylesheet" href="http://194.67.116.171/css/nav-style.css"/>
    <link rel="stylesheet" href="http://194.67.116.171/css/loan_response.css">
    <link rel="stylesheet" href="http://194.67.116.171/css/navbar_cabinet.css"/>

</head>

<body>

<nav class="navbar navbar-expand-xl navbar-dark bg-dark pt-0">
    <div class="p-3 bg-dark container-fluid">
        <div class="col-3 col-md-4 navbar-brand text-light me-0">
            <a class="row text-white col col-lg-5 text-decoration-none" href="http://194.67.116.171">
                <div class="col-3 col-lg-1 pe-3 pe-lg-5">
                    <img class="bg-white border-white rounded" src="http://194.67.116.171/img/tiunoff_promo.png" alt="promo" height="60" width="60">
                </div>
                <div class="col-4 col-lg-4 ps-2 ps-md-3 ps-lg-4 my-auto text-brand">
                    TIUNOFF BANK
                </div>
            </a>
        </div>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarToggler">
            <ul class="navbar-nav mr-auto mb-2 mb-lg-0">
                <li class="dropdown px-0 px-xl-4 nav-item order-3 order-lx-2 mt-2 mt-xl-0" style="display: inline-block;">
                    <button class="btn btn-dark dropdown-toggle text-navbar ps-0 ps-xl-auto" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="vertical-align: baseline;">
                        Ссылки
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="http://194.67.116.171">Главная</a>
                        <a class="dropdown-item" href="http://194.67.116.171/#credits">Виды кредитов</a>
                        <a class="dropdown-item" href="http://194.67.116.171/#faq">FAQ</a>
                        <hr class="dropdown-divider">
                        <a class="dropdown-item" href="http://194.67.116.171/cabinet">Личный кабинет</a>
                    </div>
                </li>
            </ul>
            <div style="display: inline-block;" class="mt-2 mt-xl-0">
                <button class="btn btn-warning btn-exit" type="button" onclick="location.href='http://194.67.116.171/leave'">Выйти</button>
            </div>
        </div>
    </div>
</nav>


<div class="container-fluid">
    <div class="col-md-12 mt-4 mb-3 text-center title_lk">
        <h1 class = "py-3">ЛИЧНЫЙ КАБИНЕТ</h1>
    </div>

    <div class="col-md-12 mt-4 mb-3 text-center title_lk">
        <h5 style="font-weight: bold"><a class="text-danger" href="http://194.67.116.171/cabinet">ЗАЯВКА №{{$id}}</a>/ФОРМИРОВАНИЕ ОТВЕТА ПО КРЕДИТУ</h5>
    </div>
    <br/>

    <section class="credits" id="credits">
        <div>
            <div class="container">
                <div class="row justify-content-center text-center">

                    <div class="col-12">
                        <table class="table table-bordered border-dark table-hover">
                            <thead>
                            <tr>
                                <th class="col">УСЛОВИЯ КРЕДИТОВАНИЯ</th>
                                <th class="col">ЗНАЧЕНИЯ</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>СУММА КРЕДИТА</td>
                                <td>{{$sum}} руб.</td>
                            </tr>
                            <tr>
                                <td>СРОК</td>
                                <td>{{$term}} мес.</td>
                            </tr>
                            <tr>
                                <td>ЕЖЕМЕСЯЧНЫЙ ПЛАТЁЖ</td>
                                <td>{{$fee}} руб. в мес.</td>
                            </tr>
                            <tr>
                                <td>ВСЕ ДОКУМЕНТЫ ПРОШЛИ ПРОВЕРКУ</td>
                                <td>@if($flag==1) Да @else Нет @endif</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-8 mx-auto">
                        <form id="getRatingForm" method="POST">
                            @csrf
                           <!-- <h5 class="text-center"><label>Сумма кредита: <input type="text" name="sum" class="data" value="" disabled> рублей</label><br/></h5>
                            <h5 class="text-center"><label>Срок: <input type="text" name="term" class="data" value="" disabled> месяца(ев)</label><br/></h5>
                            <h5 class="text-center"><label>Ежемесячный платёж:  <input type="text" name="fee" class="data" value="" disabled> руб/месяц</label><br/></h5>
                            <h5 class="text-center"><label>Все документы прошли проверку: <input type="text" class="data" name="flag" value="" disabled></label><br/></h5> -->
                            <div class="col-12 mx-auto mb-2">
                                <button class="btn w-100" id="calculate"><b>Расчитать рейтинг</b></button><br/>
                            </div>
                        </form>
                    </div>

                    <div class="col-12 text-center d-none mb-2" id="ratingWrapper">
                        <div class="col-12 col-lg-6 mx-auto">
                            <label for="rating">Рейтинг клиента: </label>
                            <input type="text" class="text-center" id="rating" value="" disabled>
                        </div>
                    </div>

                    <div class="col-12 mx-auto d-none" id="newLoans">
                        <h2 class="text-center font-weight-bold">
                            Рекомендованные кредитные предложения:
                        </h2>
                        <table class="table table-bordered border-dark table-hover mt-3 text-center">
                            <thead>
                            <tr>
                                <th class="col">СУММА(руб)</th>
                                <th class="col">СРОК(мес)</th>
                                <th class="col">ЕЖЕМЕСЯЧНЫЙ ПЛАТЁЖ(руб/мес)</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th class="col sum-table"></th>
                                <th class="col term-new-table"></th>
                                <th class="col fee-max-table"></th>
                            </tr>
                            <tr>
                                <th class="col sum-new-table"></th>
                                <th class="col term-table"></th>
                                <th class="col fee-max-table"></th>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-12 mt-2 mt-4">
                        <div class="col-12 col-lg-6 mx-auto">
                            <button class="btn d-none w-100" id="buttonContract" onclick="location.href='http://194.67.116.171/loan_response_contract'"><b>Заключить договор</b></button>
                        </div>
                    </div>

                    <div class="col-12 mt-2">
                        <div class="col-12 col-lg-6 mx-auto">
                            <button class="btn d-none w-100" id="buttonMessage" onclick="location.href='http://194.67.116.171/loan_response_message'"><b>Отправить ответ</b></button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
</div>

<div class="modal fade" id="responseModal" tabindex="-1" aria-labelledby="responseModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title response-title" id="responseModalLabel"></h5>
            </div>
            <div class="modal-body response-body"></div>
            <div class="modal-footer">
                <button type="button" class="btn modal-button w-100">Понятно</button>
            </div>
        </div>
    </div>
</div>

<div style="padding-bottom: 300px"></div>
<!-- - - - - - - - - - - - - - - - -  F  O  O  T  E  R - - - - - - - - - - - - - - - - - -  -  -->

<!-- <div class="fixed-bottom"> -->
<footer class="bg-dark text-center text-white sticky-bottom">
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
</body>
<script src="http://194.67.116.171/js/jquery_v3.6.0.js"></script>
<script src="http://194.67.116.171/js/bootstrap.js"></script>
<script src="http://194.67.116.171/js/leave.js"></script>
<script src="http://194.67.116.171/js/loan_officer/loan_response.js"></script>

</html>
<!-- </div> -->