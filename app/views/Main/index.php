{% if ajax == true %}
{% else %}
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{meta.title}}</title>
    <link rel="stylesheet" href="/public/css/style.min.css">
</head>
<body>
<div class="wrap">
    <header class="header">
        <div class="header__body _container">
            <img class="header__logo" src="/public/img/logo.png" alt="">
        </div>
    </header>
    <main class="content">
        <div class="content__body _container">
            <div class="content__buttons content__buttons_center">
                <div class="content__form">
                    <input type="submit" class="content__button-checkout content__button-authorization content__button-checkout_active" value="Вход"  name="operative-permissions">
                </div>
                <div class="content__form">
                    <input type="submit" class="content__button-checkout content__button-registration" value="Регистрация" name="archive-permissions">
                </div>
            </div>
        </div>
        {% if regActive == 'true' %}
        <form method="post" class="authorization">
        {% else %}
        <form method="post" class="authorization authorization_active">
        {% endif %}
            <div class="authorization__body">
                <div class="authorization__content">
                    <div class="reg-auth-title">
                        Форма авторизации
                    </div>
                    <div class="input-block">
                        <label for="name">Email</label>
                        <input type="email" value="{{authorization.email}}" name="email" pattern="(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*)@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:(2(5[0-5]|[0-4][0-9])|1[0-9][0-9]|[1-9]?[0-9]))\.){3}(?:(2(5[0-5]|[0-4][0-9])|1[0-9][0-9]|[1-9]?[0-9])|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])" class="input" required placeholder="Введите Ваш email">
                    </div>
                    <div class="input-block">
                        <label for="name">Пароль</label>
                        <div class="authorization__password">
                            <input type="password" value="{{authorization.password}}" name="password" pattern="(?=.*[A-ZА-Я])(?=.*[a-zа-я])(?=.*[0-9])(?=.*[!@#$%^&*])[А-Яа-яa-zA-Z0-9!@#$%^&*]{8,100}"  title="Пароль должен содержать буквы и хотя бы одну цифру,специальный символ и букву в верхнем регистре. Длина ввода от 8 до 100 символов" class="input input-password password" required placeholder="Введите Ваш пароль">
                            <span class="authorization__icon icon-password"></span>
                        </div>
                    </div>
                    <input type="submit" class="input button" name="authorization" value="Войти">
                    <div class="error">{{authorization.error}}</div>
                </div>
            </div>
        </form>
        {% if regActive == 'true' %}
            <form method="post" class="registration registration_active">
        {% else %}
            <form method="post" class="registration">
        {% endif %}
            <div class="registration__body">
                <div class="registration__content">
                    <div class="reg-auth-title">
                        Форма регистрации
                    </div>
                    <div class="registration__subtitle">
                        Введите ФИО:
                    </div>
                    <div class="registration__block">
                        <div class="input-block">
                            <label for="name">Имя*</label>
                            <input type="text" name="name" value="{{registration.name}}" pattern="[А-Яа-я]{2,100}" placeholder="Введите Ваше имя" class="input text-input" id="name" required title="Имя пользователя должно содержать только кириллические символы. Длина ввода от 2 до 100 символов">
                        </div>
                        <div class="input-block">
                            <label for="name">Фамилия*</label>
                            <input type="text" name="lastname" value="{{registration.lastname}}" pattern="[А-Яа-я]{2,100}" placeholder="Введите Вашу фамилию" class="input text-input" required title="Фамилия пользователя должно содержать только кириллические символы. Длина ввода от 2 до 100 символов">
                        </div>
                        <div class="input-block">
                            <label for="name">Отчество*</label>
                            <input type="text" name="patronymic" value="{{registration.patronymic}}" pattern="^[А-Яа-я]{2,100}$" placeholder="Введите Ваше отчество" class="input text-input" required title="Отчество пользователя должно содержать только кириллические символы. Длина ввода от 2 до 100 символов">
                        </div>
                    </div>
                    <div class="registration__subtitle">
                        Введите контактные данные:
                    </div>
                    <div class="registration__block">
                        <div class="input-block">
                            <label for="name">Email*</label>
                            <input type="email" name="email" value="{{registration.email}}" placeholder="Введите Ваш email" pattern="(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*)@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:(2(5[0-5]|[0-4][0-9])|1[0-9][0-9]|[1-9]?[0-9]))\.){3}(?:(2(5[0-5]|[0-4][0-9])|1[0-9][0-9]|[1-9]?[0-9])|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])" class="input" required>
                        </div>
                        <div class="input-block">
                            <label for="name">Мобильный телефон*</label>
                            <input type="text" name="mobile" value="{{registration.mobile}}" pattern="\+7 \(\d{3}\) \d{3}-\d{2}-\d{2}" id="mobile-phone" class="input" required placeholder="Введите Ваш мобильный номер">
                        </div>
                        <div class="input-block">
                            <label for="name">МАТС</label>
                            <input type="text" name="mats" value="{{registration.mats}}" pattern="\(\d{4}\) \d{4}" id="mats" class="input"  placeholder="Введите Ваш МАТС номер">
                        </div>
                    </div>
                    <div class="registration__block">
                        <div class="input-block">
                            <label for="name">ГАТС</label>
                            <input type="text" name="gats" pattern="\d{6}" value="{{registration.gats}}" id="gats" class="input"  placeholder="Введите Ваш ГАТС номер">
                        </div>
                        <div class="input-block">
                            <label for="name">DECT</label>
                            <input type="text" name="dect" value="{{registration.dect}}" pattern="\(\d{4}\) \d{4}" id="dect" class="input"  placeholder="Введите Ваш DECT номер">
                        </div>
                    </div>
                    <div class="registration__subtitle">
                        Выберите должность:
                    </div>
                    <div class="registration__block">
                        <div class="input-block">
                            <label for="name">Должность</label>
                            {% if position > '' %}
                            <input type="text" name="position" value="{{position}}" class="input input-position" hidden>
                            {% else %}
                            <input type="text" name="position" value="{{positions.0.name}}" class="input input-position" hidden>
                            {% endif %}
                            <div class="custom-select">
                                <select class="select-position">
                                    {% if position > '' %}
                                    <option value="0">{{registration.position}}</option>
                                    {% else %}
                                    <option value="{{position.0.id}}">{{positions.0.name}}</option>
                                    {% endif %}
                                    {% for position in positions %}
                                    <option value="{{position.id}}">{{position.name}}</option>
                                    {% endfor %}
<!--                                    <option value="1">Начальник</option>-->
<!--                                    <option value="2">Инженер</option>-->
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="registration__subtitle">
                        Выберите подразделение:
                    </div>
                    <div class="registration__subdivision">
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
                        <form action="" method="post" class="tree-send">
                            <input type="text" name="tree" class="tree-send__input" style="display: none">
                        </form>
                        <div class="input-block">
                            <label for="name">Подразделение*</label>
                            <textarea pattern="[А-Яа-я]{2,100}" id="textarea-subdivision" readonly class="input valid" title="Выбранное Вами подразделение отобразиться в данном поле" required placeholder="Выберите подразделение" >{{registration.subdivisionName}}</textarea>
                            <input type="text" readonly hidden value="{{registration.subdivisionId}}" name="subdivision_id" id="subdivision_id">
                        </div>
                    </div>
                    <div class="registration__subtitle">
                        Введите пароли:
                    </div>
                    <div class="registration__block">
                        <div class="input-block">
                            <label for="name">Пароль*</label>
                            <div class="authorization__password">
                                <input type="password" value="{{registration.password}}" pattern="(?=.*[A-ZА-Я])(?=.*[a-zа-я])(?=.*[0-9])(?=.*[!@#$%^&*])[А-Яа-яa-zA-Z0-9!@#$%^&*]{8,100}"  title="Пароль должен содержать буквы и хотя бы одну цифру,специальный символ и букву в верхнем регистре. Длина ввода от 8 до 100 символов" class="input input-password password reg-pass-first" required placeholder="Введите новый пароль">
                                <span class="authorization__icon icon-password"></span>
                            </div>
                        </div>
                        <div class="input-block">
                            <label for="name">Повторный пароль*</label>
                            <div class="authorization__password">
                                <input type="password" value="{{registration.password}}" name="password" pattern="(?=.*[A-ZА-Я])(?=.*[a-zа-я])(?=.*[0-9])(?=.*[!@#$%^&*])[А-Яа-яa-zA-Z0-9!@#$%^&*]{8,100}" title="Пароль должен содержать буквы и хотя бы одну цифру,специальный символ и букву в верхнем регистре. Длина ввода от 8 до 100 символов" class="input input-password reg-pass-second" required placeholder="Подтвердите новый пароль">
                                <span class="authorization__icon icon-password"></span>
                            </div>
                        </div>
                        <div id="password-different"></div>
                    </div>
                    <input type="submit" name="registration" class="input button" value="Регистрация">
                    <div class="error">{{registration.error}}</div>
                </div>
            </div>
        </form>
        <div class="block-margin"></div>
        <input type="text" hidden class="content__ad" value="{{registrationSuccess}}">
        <div class="window window-ad">
            <div class="window__body window__body">
                <div class="window__top">
                    <div class="window__clear window-ad__clear">
                        <span class="icon-clear"></span>
                    </div>
                </div>
                <div class="window__title window-ad__title">
                    Оповещение
                </div>
                <div class="window__text">
                    <div class="window__subtext">Ваша заявка на регистрацию успешно отправлена! </div>
<!--                    <div class="window__subtext"> В случае, если заявка будет одобрена, мы оповестим Вас по указанной Вами почте.</div>-->
                </div>
                <input type="submit" class="input button window-ad__button" value="Ясно">
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
<script src="/public/js/imask.js"></script>
<script src="/public/js/functions.js"></script>
<script src="/public/js/main.js"></script>
</body>
</html>
{% endif %}