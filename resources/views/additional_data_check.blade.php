<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Личный кабинет | Проверка данных | Заявка №{{$id}}</title>
    <link href="http://194.67.116.171/css/bootstrap.css" rel="stylesheet">
    <link rel="shortcut icon" href="http://194.67.116.171/img/tiunoff.png" type="image/png">
    <link rel="stylesheet" href="http://194.67.116.171/css/additional_data_check.css"/>
    <link rel="stylesheet" href="http://194.67.116.171/css/nav-style.css"/>
</head>

<body>

<nav class="navbar navbar-expand-lg" style="background-color: black;"></nav>

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
                                <td>{{$INIPA}}</td>
                            </tr>
                            <tr>
                                <td>СПРАВКА О СУДИМОСТИ</td>
                                <td><a href = "{{$criminal_record}}">Справка о судимости</a></td>
                            </tr>
                            <tr>
                                <td>2-НДФЛ</td>
                                <td><a href = "{{$income_statement}}">2-НДФЛ</a></td>
                            </tr>
                            <tr>
                                <td>ПАСПОРТ</td>
                                <td>{{$passport_data}}</td>
                            </tr>
                            <tr>
                                <td>ИНН</td>
                                <td>{{$ITN}}</td>
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