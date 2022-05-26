<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="stylesheet" href="/public/css/style.min.css">
    <title>{{meta.title}}</title>
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
    <main class="content">
        <div class="content__body _container">
            <div class="navigation-chain">
                <div class="navigation-chain__item"><a href="http://trans/permission">Разрешения / </a></div>
                <div class="navigation-chain__item"><a href="http://trans/permission/add">Добавление разрешения /</a></div>
                <div class="navigation-chain__item navigation-chain__item_active">Даты работ</div>
            </div>
            <div class="content__table">
                <form method="post" class="content__table table-content table-dates">
                    <div class="table-content__row table-content__row_head">
                        <div class="table-content__col table-content__head"></div>
                        <div class="table-content__col table-content__head">Дата</div>
                        <div class="table-content__col table-content__head">Время начала</div>
                        <div class="table-content__col table-content__head">Время окончания</div>
                    </div>
                        {% if dates|length > 0 %}
                            {% for date in dates %}
                            <div class="table-content__row table-row">
                                <div class="table-content__col table-col table-permission__col">
                                    <input type="checkbox" class="input-choice">
                                </div>
                                <div class="table-content__col table-col">
                                    <input type="text" value="{{date.date}}" name="date-{{loop.index}}" required="required" class="table-col__input date-mask date" pattern="^(?:(?:31(\.)(?:0?[13578]|1[02]))\1|(?:(?:29|30)(\.)(?:0?[1,3-9]|1[0-2])\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})$|^(?:29(\.)0?2\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00))))$|^(?:0?[1-9]|1\d|2[0-8])(\.)(?:(?:0?[1-9])|(?:1[0-2]))\4(?:(?:1[6-9]|[2-9]\d)?\d{2})$">
                                </div>
                                <div class="table-content__col table-col">
                                    <input type="text" value="{{date.from_time}}" name="from-time-{{loop.index}}" title="Должность" required="required" class="table-col__input time-mask time-from" pattern="^([0-1][0-9]|2[0-4]):[0-5][0-9]$">
                                </div>
                                <div class="table-content__col table-col">
                                    <input type="text" value="{{date.to_time}}" name="to-time-{{loop.index}}" required="required" class="table-col__input time-mask time-to" pattern="^([0-1][0-9]|2[0-4]):[0-5][0-9]$">
                                </div>
                            </div>
                            {% endfor %}
                        {% else %}
                            <div class="table-content__row table-row">
                                <div class="table-content__col table-col table-permission__col">
                                    <input type="checkbox" class="input-choice">
                                </div>
                                <div class="table-content__col table-col">
                                    <input type="text" name="date-1" required="required" class="table-col__input date-mask date" pattern="^(?:(?:31(\.)(?:0?[13578]|1[02]))\1|(?:(?:29|30)(\.)(?:0?[1,3-9]|1[0-2])\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})$|^(?:29(\.)0?2\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00))))$|^(?:0?[1-9]|1\d|2[0-8])(\.)(?:(?:0?[1-9])|(?:1[0-2]))\4(?:(?:1[6-9]|[2-9]\d)?\d{2})$">
                                </div>
                                <div class="table-content__col table-col">
                                    <input type="text" name="from-time-1" title="Должность" required="required" class="table-col__input time-mask time-from" pattern="^([0-1][0-9]|2[0-4]):[0-5][0-9]$">
                                </div>
                                <div class="table-content__col table-col">
                                    <input type="text" name="to-time-1" required="required" class="table-col__input time-mask time-to" pattern="^([0-1][0-9]|2[0-4]):[0-5][0-9]$">
                                </div>
                            </div>
                        {% endif %}
                    <input type="submit" class="submit-save-dates" hidden>
                </form>
                <div class="content__func func-content sticky">
                    <div class="input button button-content button-add-row">
                        Добавить
                    </div>
                    <div class="input button button-content button-del-row">
                        Удалить
                    </div>
                    <div class="input button button-content save-dates">Сохранить</div>
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
<script src="/public/js/imask.js"></script>
<script src="/public/js/date.js"></script>
</body>
</html>
