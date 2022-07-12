<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Личный кабинет | Проверка данных | Заявка №{{$id}}</title>
    <link href="http://194.67.116.171/css/bootstrap.css" rel="stylesheet">
    <link rel="shortcut icon" href="http://194.67.116.171/img/tiunoff.png" type="image/png">
    <link rel="stylesheet" href="http://194.67.116.171/css/additional_data_check.css"/>
    <link rel="stylesheet" href="http://194.67.116.171/css/nav-style.css"/>
    <link rel="stylesheet" href="http://194.67.116.171/css/navbar_cabinet.css"/>
</head>

<body>

<div class="modal fade" id="responseModal" tabindex="-1" aria-labelledby="responseModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title response-title" id="responseModalLabel"></h5>
            </div>
            <div class="modal-body response-body"></div>
            <div class="modal-footer">
                <button type="button" class="btn modal-button w-100">Хорошо</button>
            </div>
        </div>
    </div>
</div>

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

<div class="container-fluid" style="padding-bottom: 200px">
    <div class="col-md-12 mt-4 mb-3 text-center title_lk">
        <h1 class = "py-3">ЛИЧНЫЙ КАБИНЕТ</h1>
    </div>

    <div class="col-md-12 mt-4 mb-3 text-center title_lk">
        <h5 style="font-weight: bold"><a class="text-danger" href="http://194.67.116.171/cabinet">ЗАЯВКА №{{$id}}</a>/ПРОВЕРКА ДАННЫХ</h5>
    </div>
    <br/>

    <section class="credits" id="credits">
        <div class="proverka_dannih">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <table class="table table-bordered border-dark table-hover">
                            <thead>
                            <th scope="col">НАЗВАНИЕ ДОКУМЕНТА</th>
                            <th width="500" scope="col">ССЫЛКА/№</th>
                            </thead>
                            <tbody>
                            <tr>
                                <td>СНИЛС</td>
                                <td>@if(!empty($INIPA)){{$INIPA}}@else - @endif</td>
                            </tr>
                            <tr>
                                <td>СПРАВКА О СУДИМОСТИ</td>
                                <td><a href = "http://194.67.116.171/files/{{$criminal_record}}">Справка о судимости</a></td>
                            </tr>
                            <tr>
                                <td>2-НДФЛ</td>
                                <td><a href = "http://194.67.116.171/files/{{$income_statement}}">2-НДФЛ</a></td>
                            </tr>
                            <tr>
                                <td>ПАСПОРТ</td>
                                <td>@if(!empty($passport_data)){{$passport_data}}@else - @endif</td>
                            </tr>
                            <tr>
                                <td>ИНН</td>
                                <td>@if(!empty($ITN)){{$ITN}} @else - @endif</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-12">
                        <div class="sprava_ot_table_dokum">
                            <form name="form" method="POST" id="insertIntoDB"> <!--onsubmit="return sendform();"-->
                                @csrf
                                <p><label>Количество просроченных платежей: <input type="text" id="userProsr" disabled value="@if(!empty($count)) {{$count}} @else 0 @endif"></label><br/></p>

                                <div class="age-wrapper">
                                    <p><label class="" for="userAge">Возраст клиента: <input class="data" id="userAge" name="userAge"></label><span class="error text-begin age"></span></p>
                                </div>

                                <div class="doki-wrapper">
                                    <p>
                                        <label>Все документы прошли проверку на корректность и подлинность:
                                            <select name="loanOfficerConfirmation" id="userDoc" class="data">
                                                <option name="nol" id="nol" value="-1"></option>
                                                <option name="yes" id="yes" value="1">Да</option>
                                                <option name="no" id="no" value="0">Нет</option>
                                            </select>
                                        </label>
                                        <span class="error text-begin doki"></span>
                                    </p>
                                </div>

                                <div class="d-grid gap-2">
                                    <input class="btn" type="button" id="vnesti_dannie_v_bd" value="Внести результат проверки в базу данных">
                                    @if($guarantor != 80085)
                                    <button class="btn" id="guarantorCheck" type="button" onclick="location.href = 'http://194.67.116.171/additional_data_check_guarantor'"><b>Проверка документов поручителя</b></button>
                                    @endif
                                    <button class="btn" id="proverka_platejesposobnosti" type="button" onclick="location.href = 'http://194.67.116.171/solvency'"><b>Проверка платёжеспособности</b></button>
                                    <button class="btn" id="vnesti_v_chspisok" type="button" onclick="location.href = 'http://194.67.116.171/black_list'"><b>Внести в чёрный список</b></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<br/><br/>

<!-- - - - - - - - - - - - - - - - -  F  O  O  T  E  R - - - - - - - - - - - - - - - - - -  -  -->


<footer class="bg-dark text-center text-white fixed-bottom">
    <div class="container p-4">
        <!--
        <section>
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

<div class="modal fade" id="responseModal" tabindex="-1" aria-labelledby="responseModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title response-title" id="responseModalLabel"></h5>
            </div>
            <div class="modal-body response-body"></div>
            <div class="modal-footer">
                <button type="button" class="btn modal-button w-100"></button>
            </div>
        </div>
    </div>
</div>

</body>
<script src="http://194.67.116.171/js/jquery_v3.6.0.js"></script>
<script src="http://194.67.116.171/js/bootstrap.js"></script>
<script src="http://194.67.116.171/js/loan_officer/additional_data_check.js"></script>
<script src="http://194.67.116.171/js/leave.js"></script>
</html>