<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
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
    <main class="content">
        <div class="content__body _container">
            <form method="post" action="" id="form-type-work">
                <div class="navigation-chain">
                    <div class="navigation-chain__item"><a href="http://trans/permission">Разрешения / </a></div>
                    <div class="navigation-chain__item"><a href="http://trans/permission/add">Добавление разрешения /</a></div>
                    <div class="navigation-chain__item navigation-chain__item_active">Тип работ</div>
                </div>
                <div class="type-work-title">
                    Нетиповые работы
                </div>
                <div class="permission-add__block">
                    <textarea class="permission-add__textarea textarea" id="untypical_works" name="untypical_works" cols="30" rows="10" placeholder="Введите нетиповые работы...">{{untypical_work}}</textarea>
                </div>
                <div class="type-work-title">
                    Типовые работы
                </div>
                <div class="content__types-work">
                    <div  class="content__typical-work typical-work">
                        {% for typical_work in typical_works %}
                            {% set fl = false %}
                        <div class="typical-work__item">
                            <label for="check_typical_work_{{typical_work.typical_work_id}}" class="typical-work__main">
                                <div class="typical-work__name">
                                    {{typical_work.name}}
                                </div>
                                {% for current_typical_work in current_typical_works %}
                                {% if current_typical_work.typical_work_id == typical_work.typical_work_id %}
                                    {% set fl = true %}
                                    <input id="check_typical_work_{{typical_work.typical_work_id}}" name="check_typical_work_{{typical_work.typical_work_id}}" checked class="typical-work__checkbox" type="checkbox">
                                    </label>
                                    <textarea class="typical-work__textarea textarea" name="typical-work__textarea-{{typical_work.typical_work_id}}" id="">{{current_typical_work.description}}</textarea>
                                {% endif %}
                                {% endfor %}
                                {% if fl == false %}
                                <input id="check_typical_work_{{typical_work.typical_work_id}}" name="check_typical_work_{{typical_work.typical_work_id}}" class="typical-work__checkbox" type="checkbox">
                                </label>
                            <textarea class="typical-work__textarea textarea" name="typical-work__textarea-{{typical_work.typical_work_id}}" id=""></textarea>
                            {% endif %}
                        </div>
                        {% endfor %}
                        <input type="text" hidden class="array_types_works" name="array_types_works" id="">
                    </div>
                </div>
                <div class="type-work-button">
                    <input type="submit" name="update-types-works" class="input button button-send-types-work" value="Сохранить">
                </div>
            </form>
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
<script src="/public/js/type_work.js"></script>
</body>
</html>