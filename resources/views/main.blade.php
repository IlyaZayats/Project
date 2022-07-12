<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="http://194.67.116.171/css/bootstrap.css" rel="stylesheet">
    <link rel="shortcut icon" href="http://194.67.116.171/img/tiunoff.png" type="image/png">
    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap">
    <link rel="stylesheet" href="http://194.67.116.171/css/style.css">
    <link rel="stylesheet" href="http://194.67.116.171/css/nav-style.css">
    <link rel="stylesheet" href="http://194.67.116.171/css/calculator.css">
    <link rel="stylesheet" href="http://194.67.116.171/css/accordion.css">
    <link rel="stylesheet" href="http://194.67.116.171/css/photo.css"/>
    <link rel="stylesheet" href="http://194.67.116.171/css/indexNavbar.css"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css">
    <title>Tiunoff Bank</title>
</head>
<div class="modal fade" id="infoModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Заголовок</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Описание.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark btn-main-contact w-100" data-bs-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>
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
                        @csrf
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
                                    <input class="form-check-input" name="credit-card-sum" type="radio" id="flexRadioDefault1" value="50000" checked required>
                                    <label class="form-check-label text-center" for="flexRadioDefault1">
                                        50,000
                                    </label>
                                </div>
                                <div class="form-check calc-types w-100 text-md-center">
                                    <input class="form-check-input" name="credit-card-sum" type="radio" id="flexRadioDefault2" value="100000" required>
                                    <label class="form-check-label text-center" for="flexRadioDefault2">
                                        100,000
                                    </label>
                                </div>
                                <div class="form-check calc-types w-100 text-md-center">
                                    <input class="form-check-input" name="credit-card-sum" type="radio" id="flexRadioDefault3" value="200000" required>
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
                                    <input type="number" name="credit-cash-sum" class="form-control calculator-numeric-fields" id="validation-credit-cash-am"  value="50000" pattern="[0-9]*" required>
                                    <span class="input-group-text">₽</span>
                                    <div class="valid-feedback">

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
                                    <input type="number" name="credit-cash-per" class="form-control calculator-numeric-fields" id="validation-credit-cash-per" value="12" pattern="[0-9]*" required>
                                    <span class="input-group-text">мес.</span>
                                    <div class="valid-feedback">

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
                                           id="validation-credit-dream-am" value="1000000" pattern="[0-9]*" required >
                                    <span class="input-group-text">₽</span>
                                    <div class="valid-feedback">

                                    </div>
                                    <div class="invalid-feedback">
                                        Чел,ты... это поле - непустое числовое...
                                    </div>
                                </div>
                                <label for="credit-dream-range-am" class="form-label"></label>
                                <input type="range" class="form-range calculator-ranges calculator-amount-ranges" id="credit-dream-range-am" min="1000000" max="15000000" step="100000"  value="1000000">
                            </div>
                            <div class="calculator-credit-period calculator-input-group">
                                <label for="validation-credit-dream-per" class="form-label">Желаемый срок кредита</label>
                                <div class="input-group">
                                    <input type="number" name="credit-dream-per" class="form-control calculator-numeric-fields" id="validation-credit-dream-per" pattern="[0-9]*" value="60" required>
                                    <span class="input-group-text">мес.</span>
                                    <div class="valid-feedback">

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
                <form id="loginForm" accept-charset="UTF-8">
                    @csrf
                    <div class="row mb-3">
                        <label for="userLogin" class="col-sm-2 col-form-label">Логин</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control data" id="userLogin" name="@php print $login_field; @endphp">
                            <div class="error-login login"></div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="userPassword" class="col-sm-2 col-form-label">Пароль</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control data" id="userPassword" name="@php print $pass_field; @endphp">
                            <div class="error-login password"></div>
                        </div>
                    </div>
                    <div class ="col-8 mx-auto d-flex justify-content-center align-items-center mb-2 mt-4">
                        <input type="button" class="btn btn-outline-dark btn-main-contact w-100" id="confirmButton" value="Войти">
                        <div class="login-error"></div>
                    </div>
                </form>
            </div>
            <div class="modal-footer d-flex justify-content-center align-items-center">
                <h5><a class="text-center" href="#" onclick="location.href='/registration';">Регистрация</a></h5>
                <!--<button type="button" class="btn btn-warning">Войти</button> -->
            </div>
        </div>
    </div>
</div>

<body>
<!--NAVBAR-->
<div class="d-none d-md-flex" style="padding-top: 0.5rem; padding-bottom: 0.5rem; background-color: black;"></div>
<nav class="navbar navbar-expand-xl navbar-dark bg-dark py-0">
    <div class="p-3 mb-2 bg-dark container-fluid">
        <div class="navbar-brand text-light me-0">
            <a class="row text-white col col-lg-5 text-decoration-none" href="http://194.67.116.171">
                <div class="col-3 col-lg-1 pe-lg-5">
                    <img class="karti_tiu bg-white border-white rounded" src="http://194.67.116.171/img/tiunoff_promo.png" alt="promo" height="60" width="60">
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

                <li class="pe-4 nav-item order-1 order-xl-1 mt-2 mt-xl-0">
                    <button onclick="window.location.href = 'http://194.67.116.171';" class="btn btn-dark text-navbar px-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNotifications" aria-controls="offcanvasNotifications" style="vertical-align: baseline;">
                        Главная
                    </button>
                </li>

                <li class="pe-4 nav-item order-2 order-xl-2 mt-2 mt-xl-0">
                    <button onclick="window.location.href = 'http://194.67.116.171/#credits';" class="btn btn-dark text-navbar px-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNotifications" aria-controls="offcanvasNotifications" style="vertical-align: baseline;">
                        Виды кредитов
                    </button>
                </li>

                <li class="pe-4 nav-item order-3 order-xl-3 mt-2 mt-xl-0">
                    <button class="btn btn-dark text-navbar px-0" type="button" data-bs-toggle="modal" data-bs-target="#calculatorModal" aria-controls="offcanvasNotifications" style="vertical-align: baseline;">
                        Рассчитать кредит
                    </button>
                </li>

                <li class="pe-4 nav-item order-4 order-xl-4 mt-2 mt-xl-0">
                    <button onclick="window.location.href = 'http://194.67.116.171/#faq';" class="btn btn-dark text-navbar px-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNotifications" aria-controls="offcanvasNotifications" style="vertical-align: baseline;">
                        FAQ
                    </button>
                </li>

                @if($acc_type !=0)
                    <li class="pe-4 nav-item order-5 order-xl-5 mt-2 mt-xl-0">
                        <button onclick="window.location.href = 'http://194.67.116.171/cabinet';" class="btn btn-dark text-navbar px-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNotifications" aria-controls="offcanvasNotifications" style="vertical-align: baseline;">
                            Личный кабинет
                        </button>
                    </li>
                @endif

            </ul>

            <div style="display: inline-block;" class="mt-2 mt-xl-0">
                @if($acc_type == 0)
                <button class="btn btn-warning btn-login" type="button" data-bs-toggle="modal" data-bs-target="#modal_1">Войти</button>
                @else
                <button class="btn btn-warning btn-style" type="button" onclick="location.href='http://194.67.116.171/leave'">Выйти</button>
                @endif
            </div>

        </div>
    </div>
</nav>
<!--NAVBAR-->

<!--ВЕРХУШКА-->
<div class="verh position-relative overflow-hidden p-3 p-md-5 text-center bg-light">

    <div class="col-md-5 p-lg-5 mx-auto mt-3 text-dark">
        <h1 class="display-4 fw-normal">Мечты сбываются</h1>
        <p class="lead fw-normal">Мы постоянно совершенствуем наши продукты и сервисы, чтобы у вас была свобода выбора и возможность осуществить мечту. Присоединяйтесь к нам и становитесь клиентом банка!</p>
        <a class="btn btn-lg btn-outline-danger btn-main" href="#" @if($acc_type == 0)data-bs-toggle="modal" data-bs-target="#modal_1" @else onclick="location.href='http://194.67.116.171/cabinet';" @endif><b>Присоединиться</b></a>
    </div>

    <div class="cardFon">
        <img src="http://194.67.116.171/img/card-fon1.png" style="position:absolute;bottom:0;right:0" alt="Кредитная карта"></img>
        <img src="http://194.67.116.171/img/card-fon2.png" style="position:absolute;bottom:0;left:0" alt="Кошелёк"></img>
        <!--		<img src="img/card-fon3.png" style="position:absolute;top:10px;left:5px" width="245" height="160" alt="Куча денег"></img>-->
        <!--		<img src="img/card-fon4.png" style="position:absolute;top:20px;right:5px" width="200" height="160" alt="Копилка"></img>-->
    </div>

</div>
<!--ВЕРХУШКА-->


<!-------Иконки------->



<!-------Иконки------->




<section class="credits" id="credits">
    <h2>Виды кредитов</h2>
    <div class="fon">
        <div class="container">
            <div class="row">
                <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
                    <div class="grani-kreditov">
                        <div class="credit-block">
                            <div class="credit-title"><p><b>Кредитная карта</b></p>
                                <img src="http://194.67.116.171/img/card.png" style="width: 40px;"> </div>
                            <ul class="table-list">
                                <li>Бесплатное обслуживание</li>
                                <li>Оформление с 18 лет</li>
                                <li>30 дней без процентов</li>
                                </br>
                            </ul>
                            <div class="button">
                                <a class="btn btn-outline-dark btn-main-contact contact-button" id="contact-button-1" href="#card1">подробнее</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
                    <div class="grani-kreditov">
                        <div class="credit-block">
                            <div class="credit-title"><p><b>Кредит наличными</b></p>
                                <img src="http://194.67.116.171/img/stonks.png" style="width: 40px;"> </div>
                            <ul>
                                <li>Быстрое решение по заявке</li>
                                <li>До 1 млн рублей</li>
                                <li>Сроком до 4-х лет</li>
                                </br>
                            </ul>
                            <div class="button">
                                <a class="btn btn-outline-dark btn-main-contact contact-button" id="contact-button-2" href="#card2">подробнее</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
                    <div class="grani-kreditov">
                        <div class="credit-block">
                            <div class="credit-title"><p><b>На исполнение мечты</b></p>
                                <img src="http://194.67.116.171/img/pig.png" style="width: 40px;"> </div>
                            <ul>
                                <li>Низкая процентная ставка</li>
                                <li>До 15 млн рублей</li>
                                <li>Сроком до 15 лет</li>
                                </br>
                            </ul>
                            <div class="button">
                                <a class="btn btn-outline-dark btn-main-contact contact-button"  id="contact-button-3" href="#card3">подробнее</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!--------Иконки-------->
<section class="site-section border-bottom bg-light" id="services-section">
    <div class="container">
        <div class="row mb-5">
            <div class="col-12 text-center" data-aos="fade">
                <h1 class="section-title my-3"><b>Полезные сервисы на все случаи жизни</b></h1>
            </div>
        </div>
        <div class="row align-items-stretch">
            <div class="col-md-6 col-lg-4 mb-4 mb-lg-4" data-aos="fade-up">
                <div class="unit-4">
                    <div>
                        <img src="http://194.67.116.171/img/001-wallet.svg" alt="Бизнес консультация" class="img-fluid w-25 mb-4">
                    </div>
                    <div>
                        <h2>Бизнес консультация</h2>
                        <p>Получите персональную консультацию ведущих экспертов для развития Вашего бизнеса с Тиунофф банк!</p>
                        <a class="btn btn-outline-danger btn-main w-75" href="#" @if($acc_type == 0)data-bs-toggle="modal" data-bs-target="#modal_1" @else onclick="location.href='http://194.67.116.171/cabinet';" @endif><b>Начать пользоваться</b></a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 mb-4 mb-lg-4" data-aos="fade-up" data-aos-delay="100">
                <div class="unit-4">
                    <div class="unit-4-icon">
                        <img src="http://194.67.116.171/img/006-credit-card.svg" alt="Кредитная карта" class="img-fluid w-25 mb-4">
                    </div>
                    <div>
                        <h2>Кредитная карта</h2>
                        <p>Кредитные карты с кэшбэком и бесплатным обслуживанием от Тиунофф банк. Закажите кредитку с лучшими условиями онлайн!</p>
                        <a class="btn btn-outline-danger btn-main w-75" href="#" @if($acc_type == 0)data-bs-toggle="modal" data-bs-target="#modal_1" @else onclick="location.href='http://194.67.116.171/cabinet';" @endif><b>Взять</b></a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 mb-4 mb-lg-4" data-aos="fade-up" data-aos-delay="200">
                <div class="unit-4">
                    <div class="unit-4-icon">
                        <img src="http://194.67.116.171/img/002-rich.svg" alt="Мониторинг доходов" class="img-fluid w-25 mb-4">
                    </div>
                    <div>
                        <h2>Высокая доходность</h2>
                        <p>Благодаря кредитам нашего банка открывается возможность открытия бизнеса, приносящего огромный доход!</p>
                        <a class="btn btn-outline-danger btn-main w-75" href="#" @if($acc_type == 0)data-bs-toggle="modal" data-bs-target="#modal_1" @else onclick="location.href='http://194.67.116.171/cabinet';" @endif><b>Приступить</b></a>
                    </div>
                </div>
            </div>


            <div class="col-md-6 col-lg-4 mb-4 mb-lg-4" data-aos="fade-up" data-aos-delay="">
                <div class="unit-4">
                    <div class="unit-4-icon">
                        <img src="http://194.67.116.171/img/003-notes.svg" alt="Консультация" class="img-fluid w-25 mb-4">
                    </div>
                    <div>
                        <h2>Поддержка</h2>
                        <p>Наши специалисты быстро и качественно <br/> помогут решить <br/> любые проблемы!</p>
                        <a class="btn btn-outline-danger btn-main w-75" href="#" @if($acc_type == 0)data-bs-toggle="modal" data-bs-target="#modal_1" @else onclick="location.href='http://194.67.116.171/cabinet';" @endif><b>Получить</b></a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 mb-4 mb-lg-4" data-aos="fade-up" data-aos-delay="100">
                <div class="unit-4">
                    <div class="unit-4-icon">
                        <img src="http://194.67.116.171/img/004-cart.svg" alt="Инвестиции" class="img-fluid w-25 mb-4">
                    </div>
                    <div>
                        <h2>Инвестиции</h2>
                        <p>Сохраняй и приумножай вместе с нами. <br/> Наши решения помогут <br/> получать высокий доход!</p>
                        <a class="btn btn-outline-danger btn-main w-75" href="#" @if($acc_type == 0)data-bs-toggle="modal" data-bs-target="#modal_1" @else onclick="location.href='http://194.67.116.171/cabinet';" @endif><b>Оформить</b></a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 mb-4 mb-lg-4" data-aos="fade-up" data-aos-delay="200">
                <div class="unit-4">
                    <div class="unit-4-icon">
                        <img src="http://194.67.116.171/img/005-megaphone.svg" alt="Финансовый менеджмент" class="img-fluid w-25 mb-4">
                    </div>
                    <div>
                        <h2>Уведомления</h2>
                        <p>Благодарю удобному интерфейсу <br/> вы всегда будете <br/> в курсе всех событий!</p>
                        <a class="btn btn-outline-danger btn-main w-75" href="#" @if($acc_type == 0)data-bs-toggle="modal" data-bs-target="#modal_1" @else onclick="location.href='http://194.67.116.171/cabinet';" @endif><b>Ознакомиться</b></a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!--------Иконки-------->


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

<section class="credits_opisanie" style="padding-top:40px; background-color: #212529;" id="credits_opisanie">
    <div class="cr_opis"><h2>Описание кредитов</h2></div>
    <div class="fon_opisanie">
        <div class="container">
            <div class="row">

                <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-3">
                    <div class="product-card" id="card1">
                        <div class="product-thumb">
                            <a href="#"><img src="http://194.67.116.171/img/creditka1.jpg" alt=""></a>
                        </div>
                        <div class="product-details">
                            <h4><a class="text-decoration-none text-center text-dark" href="#">Кредитная карта с целым годом без процентов</a></h4>
                            <p>В любой момент у человека могут возникнуть финансовые проблемы. Если раньше мы занимали деньги у друзей или знакомых, то сейчас
                                все проблемы решает наша кредитная карта!
                                Мы вам предлагаем кредитные карты с лимитом до 50, 100, 200 тысяч рублей! Льготный период 99 дней после покупок!
                                Бесплатное тех. обслуживание! Возрастные ограничения 18-60 лет! Вернём кэшбэк за покупки у партнёров — маркетплейсов, онлайн-кинотеатров и такси.
                                Кэшбэк действует абсолютно для любой суммы — даже если потратили 100 ₽!</p>
                            <div class="product-bottom-details d-flex justify-content-between">
                                <div class="product-url col-12 mx-auto">
                                    <button type="button" class="btn btn-outline-dark btn-calculator-toggle w-100 btn-main" name="btn-credit-card-toggle" data-bs-toggle="modal" data-bs-target="#calculatorModal">Начать пользоваться</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-3">
                    <div class="product-card" id="card2">
                        <div class="product-thumb">
                            <a href="#"><img src="http://194.67.116.171/img/creditka2.jpg" alt=""></a>
                        </div>
                        <div class="product-details">
                            <h4><a class="text-decoration-none text-center text-dark" href="#">Кредит наличными</a></h4>
                            <p>Нужен быстрый займ? Мы Вам поможем! Кредит на сумму до 1 млн. рублей с 11% годовых покроет все Ваши нужды: от покупки новой тойоты до открытия своего стартапа.
                                Оформите кредит без визита в офис, а также без комиссий за выдачу
                                и досрочное погашение.
                                Возрастные ограничения 18-60 лет. Получите решение по заявке за 1 час, с минимальным количеством документов!</p>
                            <div class="product-bottom-details d-flex justify-content-between">
                                <div class="product-url col-12 mx-auto">
                                    <button type="button" class="btn btn-outline-dark btn-calculator-toggle w-100 btn-main" name="btn-credit-cash-toggle" data-bs-toggle="modal" data-bs-target="#calculatorModal">Оформить сейчас</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-3">
                    <div class="product-card"  id="card3">
                        <div class="product-thumb">
                            <a href="#"><img src="http://194.67.116.171/img/creditka3.jpg" alt=""></a>
                        </div>
                        <div class="product-details">
                            <h4><a class="text-decoration-none text-center text-dark" href="#">Кредит "На исполнение мечты"</a></h4>
                            <p>Солидное кредитное предложение для солидных людей!
                                Кредит на сумму до 10 млн. рублей с 9% годовых: только для акул бизнеса.</br>
                                Требования к получению:</br>
                                1.Нужно заполнить все дополнительные данные в личном кабинете</br>
                                2.Возраст 21-50 лет</br>
                                Одобрение в день обращения. Оформите заявку и получите деньги на следующий день, не выходя из дома!
                            </p>
                            <div class="product-bottom-details d-flex justify-content-between">
                                <div class="product-url col-12 mx-auto">
                                    <button type="button" class="btn btn-outline-dark btn-calculator-toggle w-100 btn-main" name="btn-credit-dream-toggle" data-bs-toggle="modal" data-bs-target="#calculatorModal">Получить кредит</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<h1 id="team" class="text-center mt-5 mb-3"> Команда </h1>
<div class="container team">
    <div class="row row-cols-2 row-cols-lg-3">
        <div class="col teamImage">
            <div>
                <img src="http://194.67.116.171/img/nikita_t.jpg" width="300" height="300" alt="Sinitza">
                <h3>
                    Никита <br/> Тиунов
                </h3>
                <p>
                    Тимлид
                </p>
            </div>
        </div>
        <div class="col teamImage">
            <div>
                <img src="http://194.67.116.171/img/roman.jpg" width="300" height="300" alt="Sinitza">
                <h3>
                    Роман <br/> Меликов
                </h3>
                <p>
                    Системный архитектор
                </p>
            </div>
        </div>
        <div class="col teamImage">
            <div>
                <img src="http://194.67.116.171/img/nikita_e.jpg" width="300" height="300" alt="Sinitza">
                <h3>
                    Никита <br/> Евко
                </h3>
                <p>
                    Аналитик
                </p>
            </div>
        </div>
        <div class="col teamImage">
            <div>
                <img src="http://194.67.116.171/img/kirill.jpg" width="300" height="300" alt="Sinitza">
                <h3>
                    Кирилл <br/> Рудеев
                </h3>
                <p>
                    Аналитик
                </p>
            </div>
        </div>
        <div class="col teamImage">
            <div>
                <img src="http://194.67.116.171/img/nikita_d.jpg" width="300" height="300" alt="Sinitza">
                <h3>
                    Никита <br/> Демьяненко
                </h3>
                <p>
                    Разработчки СУБД
                </p>
            </div>
        </div>
        <div class="col teamImage">
            <div>
                <img src="http://194.67.116.171/img/ilya.jpg" width="300" height="300" alt="Sinitza">
                <h3>
                    Илья <br/> Заяц
                </h3>
                <p>
                    Ответственный за GIT, back-end разработчик
                </p>
            </div>
        </div>
        <div class="col teamImage">
            <div>
                <img src="http://194.67.116.171/img/vlad.jpg" width="300" height="300" alt="Sinitza">
                <h3>
                    Влад <br/> Геворгян
                </h3>
                <p>
                    Back-end разработчик
                </p>
            </div>
        </div>
        <div class="col teamImage">
            <div>
                <img src="http://194.67.116.171/img/alexey.jpg" width="300" height="300" alt="Sinitza">
                <h3>
                    Алексей <br/> Анастасиади
                </h3>
                <p>
                    Front-end разработчик
                </p>
            </div>
        </div>
        <div class="col teamImage">
            <div>
                <img src="http://194.67.116.171/img/ekaterina.jpg" width="300" height="300" alt="Sinitza">
                <h3>
                    Екатерина <br/> Веприкова
                </h3>
                <p>
                    Front-end разработчик
                </p>
            </div>
        </div>
        <div class="col teamImage">
            <div>
                <img src="http://194.67.116.171/img/anastasiya.jpg" width="300" height="300" alt="Sinitza">
                <h3>
                    Анастасия <br/> Слесаренко
                </h3>
                <p>
                    Front-end разработчик
                </p>
            </div>
        </div>
        <div class="col teamImage">
            <div>
                <img src="http://194.67.116.171/img/rostislav.jpg" width="300" height="300" alt="Sinitza">
                <h3>
                    Ростислав <br/> Орлов
                </h3>
                <p>
                    Front-end разработчик
                </p>
            </div>
        </div>
        <div class="col teamImage">
            <div>
                <img src="http://194.67.116.171/img/alexander.jpg" width="300" height="300" alt="Sinitza">
                <h3>
                    Александр <br/> Фещенко
                </h3>
                <p>
                    Тестировщик
                </p>
            </div>
        </div>
        <div class="col teamImage">
            <div>
                <img src="http://194.67.116.171/img/daniil.jpg" width="300" height="300" alt="Sinitza">
                <h3>
                    Даниил <br/> Науменко
                </h3>
                <p>
                    Тестировщик
                </p>
            </div>
        </div>
    </div>
</div>

<div class="accordion-wrapper" id="faq">
    <div id="faqRegion">
        <p class="text-center">
            FAQ
        </p>
    </div>
    <div class="accordion">
        <div class="accordion-group">
            <div class="accordion-header">
                <h5>
                    1. В каком возрасте можно взять кредит?
                </h5>
            </div>
            <div class="accordion-content">
                <p>Для получения <b>кредитной карты</b> или взятия <b>кредита наличными</b> Ваш возраст должен составлять от 18 до 60 лет,
                    для получения <b>кредита "Мечта"</b> - от 21 до 50 лет.</p>
            </div>
        </div>
        <div class="accordion-group">
            <div class="accordion-header">
                <h5>
                    2. Какие документы мне потребуются для подачи заявки на кредит?
                </h5>
            </div>
            <div class="accordion-content">
                <p>Для подачи заявки на кредит Вам понадобится заполнить данные, находящиеся в Вашем личном кабинете в разделе
                    "заполнение дополнительных данных".</p>
            </div>
        </div>
        <div class="accordion-group">
            <div class="accordion-header">
                <h5>
                    3. Как я могу подать заявку на кредит?
                </h5>
            </div>
            <div class="accordion-content">
                <p>Чтобы подать заявку на кредит, Вам необходимо перейти на главную страницу банка, нажать на кнопку <b>"Рассчитать кредит"</b>,
                    выбрать желаемый вид кредита и подобрать желаемые условия.</p>
            </div>
        </div>
        <div class="accordion-group">
            <div class="accordion-header">
                <h5>
                    4. Где я могу ознакомиться с видами кредита?
                </h5>
            </div>
            <div class="accordion-content">
                <p>Чтобы ознакомиться с видами кредита, Вам необходимо перейти на главную страницу банка и нажать на кнопку <b>"Виды кредитов"</b>.</p>
            </div>
        </div>
        <div class="accordion-group">
            <div class="accordion-header"><h5>5. Сколько времени уйдёт на рассмотрение моей заявки на кредит?</h5></div>
            <div class="accordion-content">
                <p>Сроки рассмотрения заявок на кредит зависят от вида кредита и времени подачи заявки. В среднем, Вы сможете
                    получить результат по Вашей заявке в течение нескольких рабочих дней.</p>
            </div>
        </div>
        <div class="accordion-group">
            <div class="accordion-header"><h5>6. Как я смогу узнать одобрили ли мне кредит?</h5></div>
            <div class="accordion-content">
                <p>Ответ по вашей заявке Вы сможете найти в личном кабинете в разделе <b>"Просмотр уведомлений"</b>.</p>
            </div>
        </div>
        <div class="accordion-group">
            <div class="accordion-header"><h5>7. Почему я не могу отправить заявку на кредит, которую сформулировал(а) в разделе "Рассчитать кредит" ?</h5></div>
            <div class="accordion-content">
                <p>Возможно Вы не авторизованы в системе. Если Вы еще не зарегистрировались, то для того, чтобы оставить
                    заявку на кредит, Вам необходимо сделать это. Перейдите на главную страницу банка, нажмите кнопку <b>"Войти"</b>
                    и создайте личный кабинет.</p>
            </div>
        </div>
    </div>
</div>

<div class="koguvcavis-varazdel">
    <div class="sestim-donials">
        <h2>Отзывы</h2>
        <div class="sagestim-lonials">
            <div class="vemotau-vokusipol">
                <div class="testimonial">
                    <img src="http://194.67.116.171/img/oleg-tink-round.png" alt="">
                    <div class="gecedanam">Олег Тиньков</div>
                    <div class="apogered-gselected">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>

                    <p>Выражаю огромную благодарность за качественное и быстрое обслуживание. Оформил кредитную карту и теперь смогу реализовать свои планы и задумки в бизнесе.</p>
                </div>
            </div>

            <div class="vemotau-vokusipol">
                <div class="testimonial">
                    <img src="http://194.67.116.171/img/grigoriy-leps-round.png" alt="">
                    <div class="gecedanam">Григорий Лепс</div>
                    <div class="apogered-gselected">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>

                    <p>Выражаю огромную благодарность Tiunoff Bank. Пожалуй, это лучший банк, которым я когда-либо пользовался. Всем рекомендую брать кредит именно здесь!</p>
                </div>
            </div>

            <div class="vemotau-vokusipol">
                <div class="testimonial">
                    <img src="http://194.67.116.171/img/pavel-durov-round.png" alt="">
                    <div class="gecedanam">Павел Дуров</div>
                    <div class="apogered-gselected">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>

                    <p>Хочу отметить устойчивое повышенное качество сервиса. Все операции производятся онлайн, очень быстро и просто, взять кредит можно день в день прямо из онлайн-банка.</p>
                </div>
            </div>

        </div>
    </div>
</div>

<footer class="bg-dark text-center text-white">
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



<script src="http://194.67.116.171/js/jquery_v3.6.0.js"></script>
<script src="http://194.67.116.171/js/bootstrap.bundle.js"></script>
<script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<!--    <script src="js/script.js"></script>-->
<!--<script src="js/java.js"></script> -->
<script src="http://194.67.116.171/js/calculator-form.js"></script>
<script src="http://194.67.116.171/js/accordion.js"></script>
<script src="http://194.67.116.171/js/new_login.js"></script>
</body>
</html>