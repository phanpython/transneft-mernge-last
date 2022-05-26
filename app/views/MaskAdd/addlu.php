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
            <div class="header__icon">
                <a href="permission.html" class="header__link">
                    <span class="icon-user"></span>
                    <span class="header__subtitle">
                        Разрешения
                    </span>
                </a>
            </div>
            <div class="header__icon icon_reg_auth">
                <span class="icon-user"></span>
                <span class="header__subtitle">
                    Войти
                </span>
            </div>
        </div>
    </div>
</header>
			<main class="content-mask">
                <div class="content-mask__body">
					<div class="content-mask__search-box">
						<div class="content-mask__search">
							<form method="post" class="content-search">
								<input type="text" name="search_info" class="input-mask" placeholder="Поиск по названию защиты...">
								<span class="icon-search"></span>
								<input type="submit" hidden name="search__permission" class="permission-search">
							</form>
						</div>
					</div>
					<div class="form-mask">
					{% if protections|length == 0 %}
                    	<div class="table_error_message">{{message}}</div>
                	{% else %}
						<form method="post" class="content-mask__table table-content-mask table-systems">
                            <div class="table-content-mask__rows table-content-mask__row_header">
								<div class="table-content-mask__col table-content-mask__head" name="tu-1">{{title}}</div>
								<input type="text" name="system" value="СОУ" hidden>
							</div>
							<div class="table-content-mask__rows table-content-mask__row_head">
								<div class="table-content-mask__col table-content-mask__head" name="add-system">Выбрать защиту</div>
								<div class="table-content-mask__col table-content-mask__head" name="protection">Защита</div>
								<div class="table-content-mask__col table-content-mask__head" name="entrance">Вход</div>
								<div class="table-content-mask__col table-content-mask__head" name="exit">Выход</div>
								<div class="table-content-mask__col table-content-mask__head entrance-on" name="type_location">Тип объекта</div>
								<div class="table-content-mask__col table-content-mask__head entrance-on" name="location">Объект(задвижка и тп.)</div>
								<div class="table-content-mask__col table-content-mask__head entrance-on" name="vtor">ВТОР</div>
							</div>
							<!---->
							{% set i = 0 %}
							{% for protection in protections %}
							{% set i = i + 1 %}
							<div class="table-content-mask__rows table-row">
								<div class="table-content-mask__col table-col">
									<label class="check-entrance">
										<input type="checkbox" class="check-entrance__input add-system-{{i}}" name="add-system-{{i}}" hidden>
										<span class="check-entrance__span"></span>
									</label>
								</div>
								<div class="table-content-mask__col table-col">
									<input type="text" name="protection_id-{{i}}" value="{{protection.id}}" hidden>
									<input type="text" name="protection-{{i}}" class="table-mask-col__input protection input-row" value="{{protection.protection_name}}" required="required" readonly>
								</div>
								<div class="table-content-mask__col table-col">
									<label class="check-entrance">
										<input type="radio" class="check-entrance__input entrance-{{i}} input-row" name="entrance_exit-{{i}}" value="entrance-{{i}}" hidden>
										<span class="check-entrance__span"></span>
									</label>
								</div>
								<div class="table-content-mask__col table-col">
									<label class="check-entrance">
										<input type="radio" class="check-entrance__input exit-{{i}} input-row" name="entrance_exit-{{i}}" value="exit-{{i}}" hidden>
										<span class="check-entrance__span"></span>
									</label>
								</div>
								<div class="table-content-mask__col table-col entrance-on" >
                                    <input type="text" name="type_location-{{i}}" class="table-col__input type_location input-row" placeholder="Введите тип объект" value="">
                                </div>
								<div class="table-content-mask__col table-col col-first entrance-on" >
									<input type="text" name="location-{{i}}" class="table-col__input location input-row" placeholder="Введите объект" value="" >
								</div>
								<div class="table-content-mask__col table-col entrance-on">
									<label class="check-entrance">
										<input type="checkbox" class="check-entrance__input vtor" name="vtor-{{i}}" hidden>
										<span class="check-entrance__span"></span>
									</label>
								</div>
							</div>
							{% endfor %}
							<!---->
							<div class="permission-addmask__block">
								<input type="submit"  name="add-masks" class="permission-addmask__button input button" value="Добавить защиты в разрешение">
							</div>
						</form>	
					{% endif %}
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
		<script src="/public/js/app.min.js"></script>
	</body>	
</html>