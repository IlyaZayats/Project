<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/project_css.css">
    <link rel="stylesheet" href="css/calculator.css">
    <title>Tiunoff Bank</title>
</head>
<!-- Modal -->
<div class="modal fade" id="calculatorModal" tabindex="-1" aria-labelledby="calculatorModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="calculatorModalLabel">Калькулятор кредитов</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body calulator-form-wrapper container-lg">
                <div class="row">
                    <form class="needs-validation col-12 col-lg-8" id="credit-calculation" novalidate>
                        <div class="calculator-type-select col-12 mb-3">
                            <label for="credit-type-selector" class="form-label">
                                Выбор типа услуги:
                            </label>
                            <select class="form-select" id="credit-type-selector" name="credit-type" required>
                                <option selected value="credit-card">Кредитная карта</option>
                                <option selected value="credit-cash">Кредит наличными</option>
                                <option selected value="credit-dream">"На исполнение мечты"</option>
                            </select>
                            <div class="invalid-feedback">
                                Произошла ошибка выбора типа.
                            </div>
                        </div>
                        <div class="calculator-credit-card-block calculator-credit-block caluclator-active col-12">
                            <div>
                                <h5>Кредитная карта на сумму:</h5>
                            </div>
                            <div class="d-flex credit-card-amount flex-column flex-md-row justify-content-md-center align-items-md-center">
                                <div class="form-check calc-types w-100 text-md-center">
                                    <input class="form-check-input" name="credit-card-sum" type="radio" name="flexRadioDefault" id="flexRadioDefault1" value="50000" checked required>
                                    <label class="form-check-label text-center" for="flexRadioDefault1">
                                        50,000
                                    </label>
                                </div>
                                <div class="form-check calc-types w-100 text-md-center">
                                    <input class="form-check-input" name="credit-card-sum" type="radio" name="flexRadioDefault" id="flexRadioDefault2" value="100000" required>
                                    <label class="form-check-label text-center" for="flexRadioDefault2">
                                        100,000
                                    </label>
                                </div>
                                <div class="form-check calc-types w-100 text-md-center">
                                    <input class="form-check-input" name="credit-card-sum" type="radio" name="flexRadioDefault" id="flexRadioDefault1" value="200000" required>
                                    <label class="form-check-label text-center" for="flexRadioDefault3">
                                        200,000
                                    </label>
                                </div>
                                <div class="invalid-feedback">
                                    Произошла ошибка выбора суммы.
                                </div>
                            </div>
                            <div class="mt-5 credit-card-text mb-5">
                                <p> Без процентной ставки на покупки, совершенные за первые 30 дней. С 31-ого дня будет действовать беспроцент на 30 дней </p>
                            </div>
                        </div>
                        <div class="calculator-credit-cash-block calculator-credit-block calculator-inactive col-12 mt-3">
                            <h5>Калькулятор:</h5>
                            <div class="calculator-credit-amount calculator-input-group">
                                <label for="validation-credit-cash-am" class="form-label">Желаемая сумма кредита</label>
                                <div class="input-group">
                                    <input type="number" name="credit-cash-sum" class="form-control calculator-numeric-fields" id="validation-credit-cash-am"  value="50000" required>
                                    <span class="input-group-text">₽</span>
                                    <div class="valid-feedback">
                                        Выбрано четко!
                                    </div>
                                    <div class="invalid-feedback">
                                        Чел,ты... это поле - непустое числовое...
                                    </div>
                                </div>
                                <label for="credit-cash-range-am" class="form-label"></label>
                                <input type="range" class="form-range calculator-ranges calculator-amount-ranges" id="credit-cash-range-am" min="50000" max="999000" step="10000" value="50000">
                            </div>
                            <div class="calculator-credit-period calculator-input-group">
                                <label for="validation-credit-cash-per" class="form-label">Желаемый срок кредита</label>
                                <div class="input-group">
                                    <input type="number" name="credit-cash-per" class="form-control calculator-numeric-fields" id="validation-credit-cash-per" value="12" required>
                                    <span class="input-group-text">мес.</span>
                                    <div class="valid-feedback">
                                        Выбрано четко!
                                    </div>
                                    <div class="invalid-feedback">
                                        Чел,ты... это поле - непустое числовое...
                                    </div>
                                </div>
                                <label for="credit-cash-range-per" class="form-label"></label>
                                <input type="range" class="form-range calculator-ranges calculator-period-ranges" id="credit-cash-range-per" min="12" max="48" step="1" value="12">
                                <div class="col-12 col-sm-6">
                                    <h5> Ежемесячная плата: </h5>
                                    <div class="calculator-monthly-pay input-group">
                                        <input class="calculator-monthly form-control" disabled>
                                        <span class="input-group-text">₽</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="calculator-credit-dream-block calculator-credit-block calculator-inactive col-12 mt-3">
                            <h5>Калькулятор:</h5>
                            <div class="calculator-credit-amount calculator-input-group">
                                <label for="validation-credit-dream-am" class="form-label">Желаемая сумма кредита</label>
                                <div class="input-group">
                                    <input type="number" name="credit-dream-sum" class="form-control calculator-numeric-fields"
                                           id="validation-credit-dream-am" value="1000000" required>
                                    <span class="input-group-text">₽</span>
                                    <div class="valid-feedback">
                                        Выбрано четко!
                                    </div>
                                    <div class="invalid-feedback">
                                        Чел,ты... это поле - непустое числовое...
                                    </div>
                                </div>
                                <label for="credit-dream-range-am" class="form-label"></label>
                                <input type="range" class="form-range calculator-ranges calculator-amount-ranges" id="credit-dream-range-am" min="1000000" max="15000000" step="100000" value="1000000">
                            </div>
                            <div class="calculator-credit-period calculator-input-group">
                                <label for="validation-credit-dream-per" class="form-label">Желаемый срок кредита</label>
                                <div class="input-group">
                                    <input type="number" name="credit-dream-per" class="form-control calculator-numeric-fields" id="validation-credit-dream-per" value="60" required>
                                    <span class="input-group-text">мес.</span>
                                    <div class="valid-feedback">
                                        Выбрано четко!
                                    </div>
                                    <div class="invalid-feedback">
                                        Чел,ты... это поле - непустое числовое...
                                    </div>
                                </div>
                                <label for="credit-dream-range-per" class="form-label"></label>
                                <input type="range" class="form-range calculator-ranges calculator-period-ranges" id="credit-dream-range-per" min="60" max="180" step="1" value="60">
                                <div class="col-12 col-sm-6">
                                    <h5> Ежемесячная плата: </h5>
                                    <div class="calculator-monthly-pay input-group">
                                        <input class="calculator-monthly form-control" disabled>
                                        <span class="input-group-text">₽</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="col-md-4 d-lg-flex justify-content-center align-items-right d-none calculator-bank-img mr-0 pr-0">
                        <div class="container">
                            <div class="row">
                                <img src="img/tiunoff-crop.png" class="d-block mb-2 img-fluid pr-0 mr-0" width="308px" height="270px" alt="bank-logo">
                            </div>
                            <div class="row">
                                <img src="img/card-credit-crop.png" class="d-block mt-2 img-fluid pr-0 mr-0" width="575px" height="414px" alt="bank-card">
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center align-items-center mt-3 mb-4">
                        <button form="credit-calculation" class="btn btn-calculator-send btn-lg" type="submit">Отправить заявку</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal_1" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Вход</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/" class="needs-validation" id="loginForm" novalidate>
                    <div class="row mb-3">
                        <label for="inputLogin" class="col-sm-2 col-form-label">Логин</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputLogin" name="userLogin" minlength="8" maxlength="30" required>
                            <div class="valid-feedback">
                                Выбрано четко!
                            </div>
                            <div class="invalid-feedback">
                                Чел,ты...
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputPass" class="col-sm-2 col-form-label">Пароль</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="inputPass"  name="userPassword" minlength="8" maxlength="80" required>
                            <div class="valid-feedback">
                                Выбрано четко!
                            </div>
                            <div class="invalid-feedback">
                                Чел,ты...
                            </div>
                        </div>
                    </div>
                    <div class ="row d-flex justify-content-center align-items-center mb-4 mt-4">
                        <button form="loginForm" type="submit" class="btn btn-warning" id="loginButton"> Войти </button>
                    </div>
                </form>
            </div>
            <div class="modal-footer d-flex justify-content-center align-items-center">
                <button type="button" class="btn btn-warning" onclick="location.href='./registration.html';" type="button">Регистрация</button>
                <!--<button type="button" class="btn btn-warning">Войти</button> -->
            </div>
        </div>
    </div>
</div>
<body>
<nav class="navbar navbar-expand-lg" style="background-color: black;"></nav>

<div class="p-3 mb-2 bg-dark">
    <ul class="nav justify-content-end">
        <li class="nav-item col-md-auto">
            <a class="nav-link text-white" aria-current="page" href="#">Главная</a>
        </li>
        <li class="nav-item col-md-auto">
            <a class="nav-link text-white" href="#credits">Виды кредитов</a>
        </li>
        <li class="nav-item col-md-auto">
            <a class="nav-link text-white" href="#" data-bs-toggle="modal" data-bs-target="#calculatorModal">Рассчитать кредит</a>
        </li>
        <li class="nav-item col-12 col-md-1">
            <a class="nav-link text-white" href="#faq">FAQ</a>
        </li>
        <li class="nav-item col-12 col-md-1">
            <button type="button" class="btn btn-style btn-warning" data-bs-toggle="modal" data-bs-target="#modal_1">Войти</button>
        </li>
    </ul>
</div>
<div class="l1">
    <div class="logo1"><img src="img/image-3.png" alt="Tiunoff bank" class="left" /></div>
    <div class="left">
        <h1>Лучшие кредитные предложения в Краснодаре!<h1>
                <a href="#credits" class="button">Ознакомиться</a>
    </div>
    <div><img src="img/image1.jpg" class="img-fluid" /></div>
</div>
<div class="l2">
    <div class="logo2">
        <!--<img src="img/blackBank.png" /> -->
        <p>Мобильного приложения нет, а иконка есть</p>
    </div>
    <div>
        <li>Рекомендовано 1 преподавателем</li>
        <li>Ваще крутая вещь</li>
        <li>Гарантированная выдача микрозаймов</li>
    </div>
</div>
<!--
<div class="modal fade" id="modal_2" tabindex="-1" aria-labelledby="calculatorModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="calculatorModalLabel">Регистрация</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="">
          <div class="row mb-3">
            <label for="inputFamilia" class="col-sm-2 col-form-label">Фамилия</label>
            <div class="col-sm-10">
              <input type="email" class="form-control" id="inputFamilia">
            </div>
          </div>
          <div class="row mb-3">
            <label for="inputName" class="col-sm-2 col-form-label">Имя</label>
            <div class="col-sm-10">
              <input type="email" class="form-control" id="inputName">
            </div>
          </div>
          <div class="row mb-3">
            <label for="inputOtchestvo" class="col-sm-2 col-form-label">Отчество</label>
            <div class="col-sm-10">
              <input type="email" class="form-control" id="inputOtchestvo">
            </div>
          </div>
          <div class="row mb-3">
            <label for="inputPasport" class="col-sm-2 col-form-label">Паспорт (серия, номер)</label>
            <div class="col-sm-10">
              <input type="email" class="form-control" id="inputPasport">
            </div>
          </div>
          <div class="row mb-3">
            <label for="inputINN" class="col-sm-2 col-form-label">ИНН</label>
            <div class="col-sm-10">
              <input type="email" class="form-control" id="inputINN">
            </div>
          </div>
          <div class="row mb-3">
            <label for="inputEmail" class="col-sm-2 col-form-label">email</label>
            <div class="col-sm-10">
              <input type="email" class="form-control" id="inputEmail">
            </div>
          </div>
          <div class="row mb-3">
            <label for="inputLogin" class="col-sm-2 col-form-label">Логин</label>
            <div class="col-sm-10">
              <input type="email" class="form-control" id="inputLogin">
            </div>
          </div>
          <div class="row mb-3">
            <label for="inputPass" class="col-sm-2 col-form-label">Пароль</label>
            <div class="col-sm-10">
              <input type="password" class="form-control" id="inputPass">
            </div>
          </div>
          <div class="row mb-3">
            <label for="inputPass" class="col-sm-2 col-form-label">Подтвердите пароль</label>
            <div class="col-sm-10">
              <input type="password" class="form-control" id="inputPass2">
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-sm-10">
              <div class="form-check">
                <input type="checkbox" id="gridCheck" class="form-check-input">
                <label for="gridCheck" class="form-check-label">Даю согласие на обработку персональных данных</label>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning">Зарегистрироваться</button>
      </div>
    </div>
  </div>
</div>
-->
<!-- <div class="l3">
    <h2>Tiunoff - надежный и выгодный банк</h2>
    <div class="fon"><img src="fon.jpg" /></div>
    <div class="nout"><img src="nout.jpg" /></div>
  </div> -->

<section class="credits mb-4" id="credits">
    <h2>Виды кредитов</h2>
    <div class="fon">
        <div class="container">
            <div class="row">
                <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
                    <div class="grani-kreditov">
                        <div class="credit-block">
                            <div class="credit-title"><p><b>Кредитная карта</b></p>
                                <img src="img/card.png" style="width: 40px;"> </div>
                            <ul class="table-list">
                                <li>Бесплатное обслуживание</li>
                                <li>Оформление с 18 лет</li>
                                <li>30 дней без процентов</li>
                                </br>
                            </ul>
                            <div class="button">
                                <a class="btn contact-button" id="contact-button-1" href="#card1">подробнее</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
                    <div class="grani-kreditov">
                        <div class="credit-block">
                            <div class="credit-title"><p><b>Кредит наличными</b></p>
                                <img src="img/stonks.png" style="width: 40px;"> </div>
                            <ul>
                                <li>Быстрое решение по заявке</li>
                                <li>До 1 млн рублей</li>
                                <li>Сроком до 4-х лет</li>
                                </br>
                            </ul>
                            <div class="button">
                                <a class="btn contact-button" id="contact-button-2" href="#card2">подробнее</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
                    <div class="grani-kreditov">
                        <div class="credit-block">
                            <div class="credit-title"><p><b>На исполнение мечты</b></p>
                                <img src="img/pig.png" style="width: 40px;"> </div>
                            <ul>
                                <li>Низкая процентная ставка</li>
                                <li>До 15 млн рублей</li>
                                <li>Сроком до 15 лет</li>
                                </br>
                            </ul>
                            <div class="button">
                                <a class="btn contact-button"  id="contact-button-3" href="#card3">подробнее</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<div id="id02" class="modal">
    <form class="modal-content animate" action="">
        <h1>Подбор кредита</h1>
        <div class="container">
            <label for="credit"><b>Вид кредита:</b></label>
            <div class="custom-select">
                <select>
                    <option value="0">Кредитная карта</option>
                    <option value="1">Кредит наличными</option>
                    <option value="2">"На исполнение мечты"</option>
                </select>
            </div>
            <label><b>Калькулятор:</b></label>
            <p>Желаемая сумма кредита</p>
            <div class="slidecontainer">
                <input type="range" min="1" max="100" value="10" class="slider">
            </div>


            <button type="submit">Отправить заявку</button>
        </div>
        <div class="container">
            <p>Необходимо <a href="">войти в систему</a> для оформления.</p>
        </div>
    </form>
</div>

<section class="credits_opisanie" id="credits_opisanie">
    <div class="cr_opis"><h2>Описание кредитов</h2></div>
    <div class="fon_opisanie">
        <div class="container">
            <div class="row">

                <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-3">
                    <div class="product-card" id="card1">
                        <div class="product-thumb">
                            <a href="#"><img src="img/creditka.png" alt=""></a>
                        </div>
                        <div class="product-details">
                            <h4><a href="#">Кредитная карта с целым годом без процентов</a></h4>
                            <p>В любой момент у человека могут возникнуть финансовые проблемы. Если раньше мы занимали деньги у друзей или знакомых, то сейчас
                                все проблемы решает наша кредитная карта!
                                Мы вам предлагаем кредитные карты с лимитом до 50, 100, 200 тысяч рублей! Льготный период 99 дней после покупок!
                                Бесплатное тех. обслуживание! Возрастные ограничения 18-60 лет! Вернём кэшбэк за покупки у партнёров — маркетплейсов, онлайн-кинотеатров и такси.
                                Кэшбэк действует абсолютно для любой суммы — даже если потратили 100 ₽!</p>
                            <div class="product-bottom-details d-flex justify-content-between">
                                <div class="product-url">
                                    <button type="button" class="btn btn-outline-danger btn-calculator-toggle" name="btn-credit-card-toggle" data-bs-toggle="modal" data-bs-target="#calculatorModal">Начать пользоваться</button>
                                </div>
                                <div class="product-links">
                                    <a href="#"><i class="fas fa-shopping-cart"></i></a>
                                    <a href="#"><i class="far fa-heart"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-3">
                    <div class="product-card" id="card2">
                        <div class="product-thumb">
                            <a href="#"><img src="img/creditka2.png" alt=""></a>
                        </div>
                        <div class="product-details">
                            <h4><a href="#">Кредит наличными</a></h4>
                            <p>Нужен быстрый займ? Мы Вам поможем! Кредит на сумму до 1 млн. рублей с 11% годовых покроет все Ваши нужды: от покупки новой тойоты до открытия своего стартапа.
                                Оформите кредит без визита в офис, а также без комиссий за выдачу
                                и досрочное погашение.
                                Возрастные ограничения 18-60 лет. Получите решение по заявке за 1 час, с минимальным количеством документов!</p>
                            <div class="product-bottom-details d-flex justify-content-between">
                                <div class="product-url">
                                    <button type="button" class="btn btn-outline-danger btn-calculator-toggle" name="btn-credit-cash-toggle" data-bs-toggle="modal" data-bs-target="#calculatorModal">Оформить сейчас</button>
                                </div>
                                <div class="product-links">
                                    <a href="#"><i class="fas fa-shopping-cart"></i></a>
                                    <a href="#"><i class="far fa-heart"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-3">
                    <div class="product-card"  id="card3">
                        <div class="product-thumb">
                            <a href="#"><img src="img/creditka3.png" alt=""></a>
                        </div>
                        <div class="product-details">
                            <h4><a href="#">Кредит "На исполнение мечты"</a></h4>
                            <p>Солидное кредитное предложение для солидных людей!
                                Кредит на сумму до 10 млн. рублей с 9% годовых: только для акул бизнеса.</br>
                                Требования к получению:</br>
                                1.Нужно заполнить все дополнительные данные в личном кабинете</br>
                                2.Возраст 21-50 лет</br>
                                Одобрение в день обращения. Оформите заявку и получите деньги на следующий день, не выходя из дома!
                            </p>
                            <div class="product-bottom-details d-flex justify-content-between">
                                <div class="product-url">
                                    <button type="button" class="btn btn-outline-danger btn-calculator-toggle" name="btn-credit-dream-toggle" data-bs-toggle="modal" data-bs-target="#calculatorModal">Получить кредит</button>
                                </div>
                                <div class="product-links">
                                    <a href="#"><i class="fas fa-shopping-cart"></i></a>
                                    <a href="#"><i class="far fa-heart"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="faq-section container mb-4" id="faq">
    <div class="FAQ">
        <h2>FAQ</h2>
    </div>
    <div style = "background: #8D73DB; border-radius: 15px;">
        <div class="accordion">
            <h3>
                1. В каком возрасте можно взять кредит?
            </h3>
            <div class="our_text">
                <p>Для получения <b>кредитной карты</b> или взятия <b>кредита наличными</b> Ваш возраст должен составлять от 18 до 60 лет,
                    для получения <b>кредита "Мечта"</b> - от 21 до 50 лет.</p>

            </div>
        </div>
        <div class="accordion">
            <h3>
                2. Какие документы мне потребуются для подачи заявки на кредит?
            </h3>
            <div class="our_text">
                <p>Для подачи заявки на кредит Вам понадобится заполнить данные, находящиеся в Вашем личном кабинете в разделе
                    "заполнение дополнительных данных".</p>
            </div>
        </div>
        <div class="accordion">
            <h3>
                3. Как я могу подать заявку на кредит?
            </h3>
            <div class="our_text">
                <p>Чтобы подать заявку на кредит, Вам необходимо перейти на главную страницу банка, нажать на кнопку <b>"Рассчитать кредит"</b>,
                    выбрать желаемый вид кредита и подобрать желаемые условия.</p>
            </div>
        </div>
        <div class="accordion">
            <h3>
                4. Где я могу ознакомиться с видами кредита?
            </h3>
            <div class="our_text">
                <p>Чтобы ознакомиться с видами кредита, Вам необходимо перейти на главную страницу банка и нажать на кнопку <b>"Виды кредитов"</b>.</p>
            </div>
        </div>
        <div class="accordion">
            <h3>
                5. Сколько времени уйдёт на рассмотрение моей заявки на кредит?
            </h3>
            <div class="our_text">
                <p>Сроки рассмотрения заявок на кредит зависят от вида кредита и времени подачи заявки. В среднем, Вы сможете
                    получить результат по Вашей заявке в течение нескольких рабочих дней.</p>
            </div>
        </div>
        <div class="accordion">
            <h3>
                6. Как я смогу узнать одобрили ли мне кредит?
            </h3>
            <div class="our_text">
                <p>Ответ по вашей заявке Вы сможете найти в личном кабинете в разделе <b>"Просмотр уведомлений"</b>.</p>
            </div>
        </div>
        <div class="accordion">
            <h3>
                7. Почему я не могу отправить заявку на кредит, которую сформулировал(а) в разделе "Рассчитать кредит" ?
            </h3>
            <div class="our_text">
                <p>Возможно Вы не авторизованы в системе. Если Вы еще не зарегистрировались, то для того, чтобы оставить
                    заявку на кредит, Вам необходимо сделать это. Перейдите на главную страницу банка, нажмите кнопку <b>"Войти"</b>
                    и создайте личный кабинет.</p>
            </div>
        </div>
    </div>
</div>
<footer class="bg-dark text-center text-white">
    <div class="container p-4">
        <!-- <section>
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



<script src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script src="js/script.js"></script>
<!--<script src="js/java.js"></script> -->
<script src="js/calculator-form.js"></script>
<script src="js/login.js"></script>
</body>
</html>