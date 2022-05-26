{% if ajax == true %}
{% else %}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="cache-control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="pragma" content="no-cache" />
    <meta http-equiv="expires" content="0" />
    <link rel="stylesheet" href="/public/css/style.min.css">
    <title>Главная</title>
</head>
<body>
<div class="wrap">
    <header class="header">
        <div class="header__body _container">
            <img class="header__logo" src="/public/img/logo.png" alt="">
            <div class="header__icons">
                <form method="post" class="header__icon header__profile icon_reg_auth">
                    <span class="icon-user"></span>
                    <span class="header__subtitle">
                    {{user_fio}}
                </span>
                    <input type="text" readonly value="Выйти" hidden name="exit">
                </form>
                <form method="post" class="header__icon header__exit icon_reg_auth">
                    <span class="icon-exit"></span>
                    <span class="header__subtitle">
                    Выйти
                </span>
                    <input type="text" readonly value="Выйти" hidden name="exit">
                </form>
            </div>
        </div>
    </header>
    <main class="content responsible">
        <div class="content__body _container-main">
            <div class="navigation-chain _container">
                <div class="navigation-chain__item"><a href="http://trans/permission">Разрешения / </a></div>
                <div class="navigation-chain__item"><a href="http://trans/permission/add">Добавление разрешения /</a></div>
                <div class="navigation-chain__item navigation-chain__item_active">{{type_person.name}}</div>
            </div>
            <div class="responsible__main _container">
                <div class="responsible__sidebar">
                    <div class="tree responsible__tree">
                        <div class="tree__content">
                            <div class="tree__list">
                                {% for subdivision in subdivisions %}
                                <div class="tree__item tree__item_top">
                                    <input type="text" hidden value="{{subdivision.id}}" class="tree__input">
                                    <div class="tree__item-block">
                                        <span class="icon-square-plus-solid tree__plus tree__plus_active"></span>
                                        <div class="tree__text">
                                            {{subdivision.name}}
                                        </div>
                                    </div>
                                </div>
                                {% endfor %}
                            </div>
                        </div>
                    </div>
                </div>
                <form action="" method="post" class="tree-send">
                    <input type="text" name="tree" class="tree-send__input">
                </form>
                <div class="responsible__content">
                    <div class="responsible__top">
                        <div class="content-search responsible__search">
                            <input type="text" class="input" placeholder="Поиск ответственного по ФИО...">
                            <span class="icon-search"></span>
                        </div>
                    </div>
                    <div class="content__table table-content responsible__table">
                        <div class="table-content__row table-content__row_head responsible-table-head">
                            <div class="table-content__col table-content__head"></div>
                            <div class="table-content__col table-content__head">ФИО</div>
                            <div class="table-content__col table-content__head">Должность</div>
                            <div class="table-content__col table-content__head">Номер телефона</div>
                            <div class="table-content__col table-content__head">Почта</div>
                        </div>
                    </div>
                    <div class="message message__responsible"></div>
                    <div class="responsible__choice">
                        <input type="text" readonly value="{{current_responsibles.0.type_person_id}}" id="type_person_id" hidden>
                        <div class="content__table table-content responsible__table responsible__table_active responsible__table_choice">
                            <div class="table-content__row table-content__row_head responsible-table-head">
                                <div class="table-content__col table-content__head"></div>
                                <div class="table-content__col table-content__head">ФИО</div>
                                <div class="table-content__col table-content__head">Должность</div>
                                <div class="table-content__col table-content__head">Номер телефона</div>
                                <div class="table-content__col table-content__head">Почта</div>
                            </div>
                            {% for current_responsible in current_responsibles %}
                            <div class="table-content__row table-row responsible__row">
                                <div class="table-content__col table-col">
                                    <input type="checkbox" readonly value="{{current_responsible.user_id}}" checked class="input-choice responsible-preparation__checkbox">
                                </div>
                                <div class="table-content__col table-col responsible__fio">
                                    <input type="text" value="{{current_responsible.lastname}} {{current_responsible.name}} {{current_responsible.patronymic}}" name="date-1" readonly class="table-col__input">
                                </div>
                                <div class="table-content__col table-col responsible__email">
                                    <input type="text" value="{{current_responsible.user_position}}" name="time-from-1" readonly class="table-col__input">
                                </div>
                                <div class="table-content__col table-col responsible__position">
                                    <input type="text" value="89241423423" name="time-1" readonly class="table-col__input">
                                </div>
                                <div class="table-content__col table-col responsible__email">
                                    <input type="text" value="{{current_responsible.email}}" name="time-from-1" readonly class="table-col__input">
                                </div>
                                <input type="text" hidden readonly value="{{current_responsible.user_id}}" class="input">
                            </div>
                            {% endfor %}
                        </div>
                        <form action="" method="post">
                            <input type="text" readonly hidden id="keys-responsibles" name="keys-responsibles">
                            <input type="submit" class="input button button-content" id="save-responsibles" value="Сохранить">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer class="footer">
        <div class="footer__body _container">
            <address class="footer__mail">admin@gmail.com</address>
            <div class="footer__copy">&copy; ПАО "Транснефть" 2022</div>
            <div class="footer__links">
                <a href="https://vk.com/transneftofficial" target="_blank" class="icon-vk footer__link"></a>
                <a href="https://www.facebook.com/TRANSNEFT" target="_blank" class="icon-facebook footer__link"></a>
                <a href="https://twitter.com/transneftRu" target="_blank" class="icon-twitter footer__link"></a>
                <a href="https://www.instagram.com/transneftru/" target="_blank" class="icon-instagram-second footer__link"></a>
                <a href="https://t.me/transneftofficial" target="_blank" class="icon-telegram footer__link"></a>
                <a href="https://invite.viber.com/?g2=AQAJmjbSlaVw3kiGiek7m4%2BbhLm0X01ggdP5DAoiuQUSUvejqFEpi8Rp5Wy6uqI7&lang=ru" target="_blank" class="icon-viber footer__link"></a>
                <a href="https://www.youtube.com/user/transneftru" target="_blank" class="icon-youtube footer__link"></a>
            </div>
        </div>
    </footer>
</div>
<script src="/public/js/functions.js"></script>
<script src="/public/js/responsible.js"></script>
</body>
</html>
{% endif %}