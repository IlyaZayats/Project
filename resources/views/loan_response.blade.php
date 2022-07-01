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

</head>

<body>

<nav class="navbar navbar-expand-lg" style="background-color: black;"></nav>

<div class="p-3 mb-2 bg-dark">
    <ul class="nav justify-content-end">
        <li class="nav-item col-12 col-md-11">
            <a class="nav-link text-white" href="http://194.67.116.171">Главная</a>
        </li>
        <li class="nav-item col-12 col-md-1">
            <button onclick="location.href='http://194.67.116.171/leave'" class="btn btn-style">Выйти</button>
        </li>
    </ul>
</div>


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


<!-- - - - - - - - - - - - - - - - -  F  O  O  T  E  R - - - - - - - - - - - - - - - - - -  -  -->

<!-- <div class="fixed-bottom"> -->
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
</body>
<script src="http://194.67.116.171/js/jquery_v3.6.0.js"></script>
<script src="http://194.67.116.171/js/bootstrap.js"></script>
<script src="http://194.67.116.171/js/leave.js"></script>
<script src="http://194.67.116.171/js/loan_officer/loan_response.js"></script>

</html>
<!-- </div> -->