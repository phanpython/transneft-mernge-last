<!DOCTYPE html>
<html lang="en">
	 <head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<link rel="stylesheet" href="/public/css/style.css">
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
			<div class="content__body _container-main">
                <div class="permission__top">
                    <div class="permission__top-block">
                        <div class="navigation-chain">
                            <div class="navigation-chain__item navigation-chain__item_active">
                                {% if is_archive %}
                                Архив разрешений
                                {% else %}
                                Разрешения
                                {% endif %}
                            </div>
                        </div>
                        <div class="content__buttons" style="padding: 0">
                            {% if is_archive %}
                            <form action="" method="post" class="content__form">
                                <input type="submit" class="content__button-checkout" value="Оперативные"  name="operative-permissions">
                            </form>
                            <form action="" method="post" class="content__form">
                                <input type="submit" class="content__button-checkout content__button-checkout_active" value="Архив" name="archive-permissions">
                            </form>
                            {% else %}
                            <form action="" method="post" class="content__form">
                                <input type="submit" class="content__button-checkout content__button-checkout_active" value="Оперативные"  name="operative-permissions">
                            </form>
                            <form action="" method="post" class="content__form">
                                <input type="submit" class="content__button-checkout" value="Архив" name="archive-permissions">
                            </form>
                            {% endif %}
                        </div>
                    </div>
                    <div class="permission__pallete pallete">
                        <div class="pallete__body">
                            <div class="pellete__block">
                                <div class="pallete__title">
                                    Статусы разрешений
                                </div>
                                <div class="pallete__list">
                                    <div class="pallete__item">
                                        <div class="pallete__color pallete__color_violet">

                                        </div>
                                        <div class="pallete__subtitle">
                                            - Создание
                                        </div>
                                    </div>
                                    <div class="pallete__item">
                                        <div class="pallete__color pallete__color_beige">

                                        </div>
                                        <div class="pallete__subtitle">
                                            - Согласование
                                        </div>
                                    </div>
                                    <div class="pallete__item">
                                        <div class="pallete__color pallete__color_blue">

                                        </div>
                                        <div class="pallete__subtitle">
                                            - Утверждено
                                        </div>
                                    </div>
                                    <div class="pallete__item">
                                        <div class="pallete__color pallete__color_green">

                                        </div>
                                        <div class="pallete__subtitle">
                                            - Открыто
                                        </div>
                                    </div>
                                    <div class="pallete__item">
                                        <div class="pallete__color pallete__color_yellow">

                                        </div>
                                        <div class="pallete__subtitle">
                                            - Приостановлено
                                        </div>
                                    </div>
                                    <div class="pallete__item">
                                        <div class="pallete__color pallete__color_gray">

                                        </div>
                                        <div class="pallete__subtitle">
                                            - Закрыто
                                        </div>
                                    </div>
                                    <div class="pallete__item">
                                        <div class="pallete__color pallete__color_pastel">

                                        </div>
                                        <div class="pallete__subtitle">
                                            - Завершено
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="pellete__block">
                                <div class="pallete__title">
                                    Статусы масок
                                </div>
                                <div class="pallete__list">
                                    <div class="pallete__item">
                                        <div class="pallete__color pallete__color_darkviolet">

                                        </div>
                                        <div class="pallete__subtitle">
                                            <span>- Требуется</span><span class="pallete__subtitle_pad">маскирование</span>
                                        </div>
                                    </div>
                                    <div class="pallete__item">
                                        <div class="pallete__color pallete__color_orange">

                                        </div>
                                        <div class="pallete__subtitle">
                                            - Замаскировано
                                        </div>
                                    </div>
                                    <div class="pallete__item">
                                        <div class="pallete__color pallete__color_darkgreen">

                                        </div>
                                        <div class="pallete__subtitle">
                                            <span>- Маскирование</span><span class="pallete__subtitle_pad">проверено</span>
                                        </div>
                                    </div>
                                    <div class="pallete__item">
                                        <div class="pallete__color pallete__color_darkyellow">

                                        </div>
                                        <div class="pallete__subtitle">
                                            <span>- Требуется</span><span class="pallete__subtitle_pad">демаскирование</span>
                                        </div>
                                    </div>
                                    <div class="pallete__item">
                                        <div class="pallete__color pallete__color_brown">

                                        </div>
                                        <div class="pallete__subtitle">
                                            - Задемаскировано
                                        </div>
                                    </div>
                                    <div class="pallete__item">
                                        <div class="pallete__color pallete__color_darkblue">

                                        </div>
                                        <div class="pallete__subtitle">
                                            <span>- Демаскирование</span><span class="pallete__subtitle_pad">проверено</span>
                                        </div>
                                    </div>
                                    <div class="pallete__item">
                                        <div class="pallete__color pallete__color_red">

                                        </div>
                                        <div class="pallete__subtitle">
                                            <span>- Маскирование</span><span class="pallete__subtitle_pad">не требуется</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="pellete__block">
                                <div class="pallete__title">
                                    Статусы работ
                                </div>
                                <div class="pallete__list pallete__list_work">
                                    <div class="pallete__item">
                                        <div class="pallete__color pallete__color_violet">

                                        </div>
                                        <div class="pallete__subtitle">
                                            - Работы начаты
                                        </div>
                                    </div>
                                    <div class="pallete__item">
                                        <div class="pallete__color pallete__color_beige">

                                        </div>
                                        <div class="pallete__subtitle">
                                            - Работы закончены
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {% if roles.isAuthor %}
                <input type="text" class="role" readonly hidden value="Автор">
                {% endif %}
                {% if roles.isDispatcher %}
                <input type="text" class="role" readonly hidden value="Диспетчер">
                {% endif %}
                {% if roles.isReplacementEngineer %}
                <input type="text" class="role" readonly hidden value="Сменный инженер">
                {% endif %}
                {% if roles.isInspectingEngineer %}
                <input type="text" class="role" readonly hidden value="Проверяющий инженер">
                {% endif %}
				<div class="filter-content__funcs">
                    <div class="input button button-content filter button-permission">Фильтры</div>
					<form method="post" class="content-search">
						<input type="text" class="input input-search" name="search_info" value="{{search_info}}" placeholder="Поиск...">
						<span class="icon-search"></span>
						<input type="submit" hidden name="search_permission" class="permission-search">
					</form>
                    {% if roles.isDispatcher %}
                    <form action="" method="post" class="" id="scv-permission">
                        <input type="submit" name="excel-permission" class="input button button-content button-permission button-scv" value="Выгрузить в scv">
                        <input type="text" class="row-id-process input-scv" hidden name="id" required id="">
                    </form>
                    {% endif %}
                    {% if roles.isAuthor %}
                    <form action="http://trans/permission/add" method="post" id="create-permission">
                        <input type="submit" class="input button button-content button-permission" name="create-permission" value="Создать">
                    </form>
                    <form action="" method="post" class="hidden" id="create-by-permission">
                        <input type="submit" name="create-permission-by" class="input button button-content permission-event button-permission" value="Создать на основе">
                        <input type="text" class="row-id-process" hidden name="id" required id="">
                    </form>
                    {% endif %}
					<form action="" method="post" class="hidden" id="edit-permission">
						<input type="submit" name="edit-permission" class="input button button-content permission-event button-permission" value="Править">
						<input type="text" class="row-id-process" hidden name="id" required id="">
					</form>
                    {% if roles.isAuthor %}
                    <form action="" method="post" class="hidden" id="del-permission">
                        <input type="submit" name="del-permission" class="input button button-content permission-event button-permission" value="Удалить">
                        <input type="text" class="row-id-process" hidden name="id" required id="">
                    </form>
                    {% endif %}
                    {% if roles.isAuthor %}
                    <form action="" method="post" class="hidden" id="cancel-agreement-permission">
                        <input type="submit" name="cancel-agreement-permission" class="input button button-content permission-event button-permission" value="На доработку">
                        <input type="text" class="row-id-process" hidden name="id" required id="">
                    </form>
                    {% endif %}
                    {% if roles.isAuthor %}
                    <form action="" method="post" class="hidden" id="agreement-permission">
                        <input type="submit" name="agreement-permission" class="input button button-content permission-event button-permission" value="На согласование">
                        <input type="text" class="row-id-process" hidden name="id" required id="">
                    </form>
                    {% endif %}
                    <!--  -->
                    {% if roles.isDispatcher %}
                    <form action="" method="post" class="hidden" id="activemasking-permission">
                        <input type="submit" name="activemasking-permission" class="input button button-content permission-event button-permission" value="Требуется маскирование">
                        <input type="text" class="row-id-process" hidden name="id" required id="">
                    </form>
                    {% endif %}
                    <!-- Маскирование -->
                    {% if roles.isReplacementEngineer %}
                    <div class="hidden" id="masking-permission">
                        <span class="input button button-content permission-event button-permission masking-permission">Замаскировать</span>
                        <input type="text" class="row-id-process" hidden name="id" required id="">
                    </div>
                    {% endif %}
                    <!-- Проверка маскирования -->
                    {% if roles.isInspectingEngineer %}
                    <div class="hidden" id="check_masking-permission">
                        <span class="input button button-content permission-event button-permission check_masking-permission">Проверить маскирование</span>
                        <input type="text" class="row-id-process" hidden name="id" required id="">
                    </div>
                    {% endif %}
                    {% if roles.isDispatcher %}
                    <form action="" method="post" class="hidden" id="activeunmasking-permission">
                        <input type="submit" name="activeunmasking-permission" class="input button button-content permission-event button-permission" value="Требуется демаскирование">
                        <input type="text" class="row-id-process" hidden name="id" required id="">
                    </form>
                    {% endif %}
                    <!-- Демаскирование -->
                    {% if roles.isReplacementEngineer %}
                    <div class="hidden" id="unmasking-permission">
                        <span class="input button button-content permission-event button-permission unmasking-permission">Демаскировать</span>
                        <input type="text" class="row-id-process" hidden name="id" required id="">
                    </div>
                    {% endif %}
                    <!-- Проверка демаскирования -->
                    {% if roles.isInspectingEngineer %}
                    <div class="hidden" id="check_unmasking-permission">
                        <span class="input button button-content permission-event button-permission check_unmasking-permission">Проверить демаскирование</span>
                        <input type="text" class="row-id-process" hidden name="id" required id="">
                    </div>
                    {% endif %}
                    {% if roles.isDispatcher %}
                    <form action="" method="post" class="hidden" id="completed-permission">
                        <input type="submit" name="completed-permission" class="input button button-content permission-event button-permission" value="Завершить">
                        <input type="text" class="row-id-process" hidden name="id" required id="">
                    </form>
                    {% endif %}
                    {% if roles.isAuthor %}
                    <form action="" method="post" class="permission__block-button hidden" id="apply-permission">
                        <a class="input button button-content permission-event button-permission">Утверждено</a>
                        <input type="text" class="row-id-process" hidden name="id" required id="">
                        <div class="permission__status permission-status">
                            <div class="permission-status__body">
                                <div class="permission-status__subtitle">
                                    Фактическая дата утверждения разрешения:
                                </div>
                                <input type="text" name="date" required="required" class="table-col__input date-mask input date permission-status__date" pattern="^(?:(?:31(\.)(?:0?[13578]|1[02]))\1|(?:(?:29|30)(\.)(?:0?[1,3-9]|1[0-2])\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})$|^(?:29(\.)0?2\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00))))$|^(?:0?[1-9]|1\d|2[0-8])(\.)(?:(?:0?[1-9])|(?:1[0-2]))\4(?:(?:1[6-9]|[2-9]\d)?\d{2})$">
                                <div class="permission-status__subtitle">
                                    Фактическое время утверждения разрешения:
                                </div>
                                <input type="text" name="time" required="required" class="table-col__input time-mask input permission-status__time" pattern="^([0-1][0-9]|2[0-4]):[0-5][0-9]$">
                                <div class="permission-status__subtitle">
                                    Комментарий:
                                </div>
                                <textarea class="permission-status__comment input textarea" name="comment" id="" cols="30" rows="10">
								</textarea>
                                <input type="text" readonly hidden class="permission-status__id">
                                <input type="submit" name="apply-permission" class="permission-status__button permission-status__ok input button" value="Ок">
                                <a class="permission-status__button permission-status__cancel input button">Отменить</a>
                            </div>
                        </div>
                    </form>
                    {% endif %}
                    {% if roles.isAuthor %}
                    <form action="" method="post" class="permission__block-button hidden" id="cancel-apply-permission">
                        <a class="input button button-content permission-event button-permission">Отменить утверждение</a>
                        <input type="text" class="row-id-process" hidden name="id" required id="">
                        <div class="permission__status permission-status">
                            <div class="permission-status__body">
                                <div class="permission-status__subtitle">
                                    Фактическая дата отмены утверждения разрешения:
                                </div>
                                <input type="text" name="date" required="required" class="table-col__input date-mask input date permission-status__date" pattern="^(?:(?:31(\.)(?:0?[13578]|1[02]))\1|(?:(?:29|30)(\.)(?:0?[1,3-9]|1[0-2])\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})$|^(?:29(\.)0?2\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00))))$|^(?:0?[1-9]|1\d|2[0-8])(\.)(?:(?:0?[1-9])|(?:1[0-2]))\4(?:(?:1[6-9]|[2-9]\d)?\d{2})$">
                                <div class="permission-status__subtitle">
                                    Фактическое время отмены утверждения разрешения:
                                </div>
                                <input type="text" name="time" required="required" class="table-col__input time-mask input permission-status__time" pattern="^([0-1][0-9]|2[0-4]):[0-5][0-9]$">
                                <div class="permission-status__subtitle">
                                    Комментарий:
                                </div>
                                <textarea class="permission-status__comment input textarea" name="comment" id="" cols="30" rows="10">
								</textarea>
                                <input type="text" readonly hidden class="permission-status__id">
                                <input type="submit" name="cancel-apply-permission" class="permission-status__button permission-status__ok input button" value="Ок">
                                <a class="permission-status__button permission-status__cancel input button">Отменить</a>
                            </div>
                        </div>
                    </form>
                    {% endif %}
                    {% if roles.isDispatcher %}
                    <form action="" method="post" class="permission__block-button hidden" id="open-permission">
                        <a class="input button button-content permission-event button-permission">Открыть</a>
                        <input type="text" class="row-id-process" hidden name="id" required id="">
                        <div class="permission__status permission-status">
                            <div class="permission-status__body">
                                <div class="permission-status__subtitle">
                                    Фактическая дата открытия разрешения:
                                </div>
                                <input type="text" name="date" required="required" class="table-col__input date-mask input date permission-status__date" pattern="^(?:(?:31(\.)(?:0?[13578]|1[02]))\1|(?:(?:29|30)(\.)(?:0?[1,3-9]|1[0-2])\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})$|^(?:29(\.)0?2\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00))))$|^(?:0?[1-9]|1\d|2[0-8])(\.)(?:(?:0?[1-9])|(?:1[0-2]))\4(?:(?:1[6-9]|[2-9]\d)?\d{2})$">
                                <div class="permission-status__subtitle">
                                    Фактическое время открытия разрешения:
                                </div>
                                <input type="text" name="time" required="required" class="table-col__input time-mask input permission-status__time" pattern="^([0-1][0-9]|2[0-4]):[0-5][0-9]$">
                                <div class="permission-status__subtitle">
                                    Комментарий:
                                </div>
                                <textarea class="permission-status__comment input textarea" name="comment" id="" cols="30" rows="10"></textarea>
                                <input type="text" readonly hidden class="permission-status__id">
                                <input type="submit" name="open-permission" class="permission-status__button permission-status__ok input button" value="Ок">
                                <a class="permission-status__button permission-status__cancel input button">Отменить</a>
                            </div>
                        </div>
                    </form>
                    {% endif %}
                    {% if roles.isDispatcher %}
                    <form action="" method="post" class="permission__block-button hidden" id="pause-permission">
                        <a class="input button button-content permission-event button-permission">Приостановить</a>
                        <input type="text" class="row-id-process" hidden name="id" required id="">
                        <div class="permission__status permission-status">
                            <div class="permission-status__body">
                                <div class="permission-status__subtitle">
                                    Фактическая дата приостановки разрешения:
                                </div>
                                <input type="text" name="date" required="required" class="table-col__input date-mask input date permission-status__date" pattern="^(?:(?:31(\.)(?:0?[13578]|1[02]))\1|(?:(?:29|30)(\.)(?:0?[1,3-9]|1[0-2])\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})$|^(?:29(\.)0?2\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00))))$|^(?:0?[1-9]|1\d|2[0-8])(\.)(?:(?:0?[1-9])|(?:1[0-2]))\4(?:(?:1[6-9]|[2-9]\d)?\d{2})$">
                                <div class="permission-status__subtitle">
                                    Фактическое время приостановки разрешения:
                                </div>
                                <input type="text" name="time" required="required" class="table-col__input time-mask input permission-status__time" pattern="^([0-1][0-9]|2[0-4]):[0-5][0-9]$">
                                <div class="permission-status__subtitle">
                                    Комментарий:
                                </div>
                                <textarea class="permission-status__comment input textarea" name="comment" id="" cols="30" rows="10">
								</textarea>
                                <input type="text" readonly hidden class="permission-status__id">
                                <input type="submit" name="pause-permission" class="permission-status__button permission-status__ok input button" value="Ок">
                                <a class="permission-status__button permission-status__cancel input button">Отменить</a>
                            </div>
                        </div>
                    </form>
                    {% endif %}
                    {% if roles.isDispatcher %}
                    <form action="" method="post" class="permission__block-button hidden" id="close-permission">
                        <a class="input button button-content permission-event button-permission">Закрыть</a>
                        <input type="text" class="row-id-process" hidden name="id" required id="">
                        <div class="permission__status permission-status">
                            <div class="permission-status__body">
                                <div class="permission-status__subtitle">
                                    Фактическая дата закрытия разрешения:
                                </div>
                                <input type="text" name="date" required="required" class="table-col__input date-mask input date permission-status__date" pattern="^(?:(?:31(\.)(?:0?[13578]|1[02]))\1|(?:(?:29|30)(\.)(?:0?[1,3-9]|1[0-2])\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})$|^(?:29(\.)0?2\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00))))$|^(?:0?[1-9]|1\d|2[0-8])(\.)(?:(?:0?[1-9])|(?:1[0-2]))\4(?:(?:1[6-9]|[2-9]\d)?\d{2})$">
                                <div class="permission-status__subtitle">
                                    Фактическое время закрытия разрешения:
                                </div>
                                <input type="text" name="time" required="required" class="table-col__input time-mask input permission-status__time" pattern="^([0-1][0-9]|2[0-4]):[0-5][0-9]$">
                                <div class="permission-status__subtitle">
                                    Комментарий:
                                </div>
                                <textarea class="permission-status__comment input textarea" name="comment" id="" cols="30" rows="10">
								</textarea>
                                <input type="text" readonly hidden class="permission-status__id">
                                <input type="submit" name="close-permission" class="permission-status__button permission-status__ok input button" value="Ок">
                                <a class="permission-status__button permission-status__cancel input button">Отменить</a>
                            </div>
                        </div>
                    </form>
                    {% endif %}
                    {% if roles.isDispatcher %}
                    <form action="" method="post" class="permission__block-button hidden" id="start-work">
                        <a class="input button button-content permission-event button-permission">Работы начаты</a>
                        <input type="text" class="row-id-process" hidden name="id" required id="">
                        <div class="permission__status permission-status">
                            <div class="permission-status__body">
                                <div class="permission-status__subtitle">
                                    Фактическая дата начала работ:
                                </div>
                                <input type="text" name="date" required="required" class="table-col__input date-mask input date permission-status__date" pattern="^(?:(?:31(\.)(?:0?[13578]|1[02]))\1|(?:(?:29|30)(\.)(?:0?[1,3-9]|1[0-2])\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})$|^(?:29(\.)0?2\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00))))$|^(?:0?[1-9]|1\d|2[0-8])(\.)(?:(?:0?[1-9])|(?:1[0-2]))\4(?:(?:1[6-9]|[2-9]\d)?\d{2})$">
                                <div class="permission-status__subtitle">
                                    Фактическое время начала работ:
                                </div>
                                <input type="text" name="time" required="required" class="table-col__input time-mask input permission-status__time" pattern="^([0-1][0-9]|2[0-4]):[0-5][0-9]$">
                                <div class="permission-status__subtitle">
                                    Комментарий:
                                </div>
                                <textarea class="permission-status__comment input textarea" name="comment" id="" cols="30" rows="10">
								</textarea>
                                <input type="text" readonly hidden class="permission-status__id">
                                <input type="submit" name="start-work" class="permission-status__button permission-status__ok input button" value="Ок">
                                <a class="permission-status__button permission-status__cancel input button">Отменить</a>
                            </div>
                        </div>
                    </form>
                    {% endif %}
                    {% if roles.isDispatcher %}
                    <form action="" method="post" class="permission__block-button hidden" id="finish-work">
                        <a class="input button button-content permission-event button-permission">Работы закончены</a>
                        <input type="text" class="row-id-process" hidden name="id" required id="">
                        <div class="permission__status permission-status">
                            <div class="permission-status__body">
                                <div class="permission-status__subtitle">
                                    Фактическая дата окончания работ:
                                </div>
                                <input type="text" name="date" required="required" class="table-col__input date-mask input date permission-status__date" pattern="^(?:(?:31(\.)(?:0?[13578]|1[02]))\1|(?:(?:29|30)(\.)(?:0?[1,3-9]|1[0-2])\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})$|^(?:29(\.)0?2\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00))))$|^(?:0?[1-9]|1\d|2[0-8])(\.)(?:(?:0?[1-9])|(?:1[0-2]))\4(?:(?:1[6-9]|[2-9]\d)?\d{2})$">
                                <div class="permission-status__subtitle">
                                    Фактическое время окончания работ:
                                </div>
                                <input type="text" name="time" required="required" class="table-col__input time-mask input permission-status__time" pattern="^([0-1][0-9]|2[0-4]):[0-5][0-9]$">
                                <div class="permission-status__subtitle">
                                    Комментарий:
                                </div>
                                <textarea class="permission-status__comment input textarea" name="comment" id="" cols="30" rows="10">
								</textarea>
                                <input type="text" readonly hidden class="permission-status__id">
                                <input type="submit" name="finish-work" class="permission-status__button permission-status__ok input button" value="Ок">
                                <a class="permission-status__button permission-status__cancel input button">Отменить</a>
                            </div>
                        </div>
                    </form>
                    {% endif %}
                    {% if roles.isDispatcher %}
                    <form action="" method="post" class="hidden" id="recovery-permission">
                        <input type="submit" name="recovery-permission" class="input button button-content permission-event button-permission" value="Восстановить">
                        <input type="text" class="row-id-process" hidden name="id" id="" required>
                    </form>
                    {% endif %}
                    <form action="http://trans/story" method="post" class="hidden" id="story-permission">
                        <input type="submit" name="story" class="input button button-content permission-event button-permission" value="История">
                        <input type="text" class="row-id-process" hidden name="id" id="" required>
                    </form>
                    {% if roles.isAuthor %}
                    <form action="http://trans/permission" method="post" class="hidden" id="pdf-permission">
                        <input type="submit" name="pdf" class="input button button-content permission-event button-permission" value="Выгрузить в PDF">
                        <input type="text" class="row-id-process" hidden name="id" id="" required>
                    </form>
                    {% endif %}
				</div>
				<div class="content__filter filter-content">
					<form method="post" class="filter-content__block">
						<div class="filter-content__list">
                            {% if roles.isAuthor or is_archive %}
                            <div class="filter-content__item">
                                <div class="filter-content__subtitle">
                                    Периоды работ
                                </div>
                                <div class="filter-content__date date-filter">
                                    <div class="date-filter__block">
                                        <span class="filter-content__span">Начальная дата</span><input type="date" value="{{date_start}}" name="date_start">
                                    </div>
                                    <div class="date-filter__block">
                                        <span class="filter-content__span">Конечная дата</span> <input type="date" value="{{date_end}}" name="date_end">
                                    </div>
                                </div>
                            </div>
                            {% endif %}
                            {% if is_archive != true %}
                            <div class="filter-content__item">
                                <div class="filter-content__subtitle">
                                    Статусы разрешений
                                </div>
                                <div class="filter-content__status-list">
                                    {% for status in statuses %}
                                    <div class="filter-content__status-item">
                                        {% if status.active == true %}
                                        <input id="{{status.id}}" class="filter-content__status-id" type="checkbox" checked="checked">
                                        {% else %}
                                        <input id="{{status.id}}" class="filter-content__status-id" type="checkbox">
                                        {% endif %}
                                        <label for="{{status.id}}">{{status.name}}</label>
                                    </div>
                                    {% endfor %}
                                </div>
                            </div>
                            <div class="filter-content__item">
                                <div class="filter-content__subtitle">
                                    Статусы масок
                                </div>
                                <div class="filter-content__status-list">
                                    {% for status in statuses_mask %}
                                    <div class="filter-content__status-item">
                                        {% if status.active == true %}
                                        <input id="{{status.id}}" class="filter-content__status-id" type="checkbox" checked="checked">
                                        {% else %}
                                        <input id="{{status.id}}" class="filter-content__status-id" type="checkbox">
                                        {% endif %}
                                        <label for="{{status.id}}">{{status.name}}</label>
                                    </div>
                                    {% endfor %}
                                </div>
                            </div>
                            <div class="filter-content__item">
                                <div class="filter-content__subtitle">
                                    Статусы работ
                                </div>
                                <div class="filter-content__status-list">
                                    {% for status in statuses_work %}
                                    <div class="filter-content__status-item">
                                        {% if status.active == true %}
                                        <input id="{{status.id}}" class="filter-content__status-id" type="checkbox" checked="checked">
                                        {% else %}
                                        <input id="{{status.id}}" class="filter-content__status-id" type="checkbox">
                                        {% endif %}
                                        <label for="{{status.id}}">{{status.name}}</label>
                                    </div>
                                    {% endfor %}
                                </div>
                            </div>
                            {% endif %}
							<div class="filter-content__item">
								<div class="filter-content__buttons">
                                    <input type="submit" class="input button filter-content__button apply-filter" name="filter" value="Применить">
									<div class="input button filter-content__button close-filter">Закрыть</div>
								</div>
							</div>
						</div>
                        <input type="text" readonly name="statuses" hidden class="filter-content__statuses">
					</form>
				</div>
                {% if permissions|length == 0 %}
                    <div class="table_error_message">{{message}}</div>
                {% else %}
				<div class="content__table">
					<div class="content__table table-content table-permission">
						<div class="table-content__row table-content__row_head table-permission__row_head">
                            <div class="table-content__col table-content__head table-permission__head"></div>
                            <div class="table-content__col table-content__head table-permission__head table-permission__id">№</div>
                            <div class="table-content__col table-content__head table-permission__head table-permission__number">№ в СЭД</div>
                            <div class="table-content__col table-content__head table-permission__head table-permission__status">Статус разрешения</div>
                            <div class="table-content__col table-content__head table-permission__head table-permission__status">Статус работ</div>
                            <div class="table-content__col table-content__head table-permission__head table-permission__status">Статус маскирования</div>
                            {% if roles.isReplacementEngineer or roles.isInspectingEngineer or roles.isDispatcher %}
                            <div class="table-content__col table-content__head table-permission__head table-permission__masking">Маскирование</div>
                            {% endif %}
                            <div class="table-content__col table-content__head table-permission__head table-permission__subdivision">Подразделение</div>
                            <div class="table-content__col table-content__head table-permission__head table-permission__person">Ответственные за подготовку работ</div>
                            <div class="table-content__col table-content__head table-permission__head table-permission__person">Ответственные за выполнение работ</div>
                            <div class="table-content__col table-content__head table-permission__head table-permission__person">Ответственные за контроль при производстве работ</div>
                            <div class="table-content__col table-content__head table-permission__head table-permission__period">Периоды работ</div>
                            <div class="table-content__col table-content__head table-permission__head table-permission__text">Типовые работы</div>
                            <div class="table-content__col table-content__head table-permission__head table-permission__text">Нетиповые работы</div>
                            <div class="table-content__col table-content__head table-permission__head table-permission__text">Иное основание для создания разрешения</div>
                            <div class="table-content__col table-content__head table-permission__head table-permission__text">Дополнительно</div>
						</div>
                        {% for permission in permissions %}
                        <input type="text" readonly value="{{permission.mask_color}}" hidden class="table-mask__background">
                        <input type="text" readonly value="{{permission.work_color}}" hidden class="table-work__background">
                        <input type="text" readonly value="{{permission.color}}" hidden class="table-permission__background">
						<div class="table-content__row table-row table-permission__row">
                            <div class="table-content__col table-col table-permission__col col-check">
                              <input type="checkbox" class="input-choice input-choice-permission">
                            </div>
                            <div class="table-content__col table-col table-permission__col table-permission__id">
                                {{permission.id}}
                            </div>
							<div class="table-content__col table-col table-permission__col table-permission__number">
                                {{permission.number}}
							</div>
							<div class="table-content__col table-col table-permission__col table-permission__status">
                                {{permission.status_permission_name}}<span style="font-size: 11px; margin: 5px 0 0 0;">{{permission.status_permission_date}}</span>
							</div>
                            <div class="table-content__col table-col table-permission__col table-permission__status table-permission__cell-work">
                                {{permission.status_work_name}}<span style="font-size: 11px; margin: 5px 0 0 0;">{{permission.status_work_date}}</span>
                            </div>
                            <div class="table-content__col table-col table-permission__col table-permission__status table-permission__cell-mask">
                                {{permission.status_mask_name}}<span style="font-size: 11px; margin: 5px 0 0 0;">{{permission.status_mask_date}}</span>
                            </div>
                             <!-- Максирование -->

                             {% if roles.isReplacementEngineer or roles.isInspectingEngineer  or roles.isDispatcher %}
                            <div class="table-content__col table-col table-permission__col-mask table-permission__masking-block">
								<div class="table-content__row table-content__row_head table-permission__row_head">
									<div class="table-content__head table-permission__protection">Защиты</div>
									<div class="table-content__head table-permission__mask-status">М</div>
                                    <div class="table-content__head table-permission__mask-status">ПМ</div>
									<div class="table-content__head table-permission__mask-status">Д</div>
									<div class="table-content__head table-permission__mask-status">ПД</div>
								</div>
                                <form action="" method="post" class="masking-form" id="masking-submit">
                                <input type="text" name="id" class="masking-text" value="{{permission.id}}" hidden >
                                {% set i = 0 %}
                                {% for protection in protections %}
                                {% if protection.permissionid ==  permission.id %}
                                {% set i = i + 1 %}
                                    <div class="table-content__row table-permission__row-mask table-content__row-main">
                                        <div class="table-col table-permission__protection table-permission__item-mask protection-{{i}}">
                                            <input type="text" name="protection-{{i}}" value="{{protection.protection_name}}" hidden >
                                            {{protection.protection_name}}
                                        </div>
                                        <!-- Диспетчер -->
                                        {% if roles.isDispatcher %}
                                        {% if protection.masking == true %}
                                        <div class="table-col table-permission__mask-status table-permission__item-mask">
                                            <label class="check-mask">
                                                <input type="checkbox" class="check-mask__input masking-{{i}}" name="masking-{{i}}" hidden checked disabled>
                                                <span class="check-mask__span"></span>
                                            </label>
                                        </div>
                                        {% else %}
                                        <div class="table-col table-permission__mask-status table-permission__item-mask">
                                            <label class="check-mask">
                                                <input type="checkbox" class="check-mask__input masking-{{i}}" name="masking-{{i}}" hidden disabled>
                                                <span class="check-mask__span"></span>
                                            </label>
                                        </div>
                                        {% endif %}
                                        {% if protection.check_masking == true %}
                                        <div class="table-col table-permission__mask-status table-permission__item-mask">
                                            <label class="check-mask" >
                                                <input type="checkbox" class="check-mask__input check_masking-{{i}}" name="check_masking-{{i}}" hidden checked disabled>
                                                <span class="check-mask__span"></span>
                                            </label>
                                        </div>
                                        {% else %}
                                        <div class="table-col table-permission__mask-status table-permission__item-mask">
                                            <label class="check-mask" >
                                                <input type="checkbox" class="check-mask__input check_masking-{{i}}" name="check_masking-{{i}}" hidden disabled>
                                                <span class="check-mask__span"></span>
                                            </label>
                                        </div>
                                        {% endif %}
                                        {% if protection.unmasking == true %}
                                        <div class="table-col table-permission__mask-status table-permission__item-mask">
                                            <label class="check-mask">
                                                <input type="checkbox" class="check-mask__input unmasking-{{i}}" name="unmasking-{{i}}" hidden checked disabled>
                                                <span class="check-mask__span"></span>
                                            </label>
                                        </div>
                                        {% else %}
                                        <div class="table-col table-permission__mask-status table-permission__item-mask">
                                            <label class="check-mask">
                                                <input type="checkbox" class="check-mask__input unmasking-{{i}}" name="unmasking-{{i}}" hidden disabled>
                                                <span class="check-mask__span"></span>
                                            </label>
                                        </div>
                                        {% endif %}
                                        {% if protection.check_unmasking == true %}
                                        <div class="table-col table-permission__mask-status table-permission__item-mask">
                                            <label class="check-mask">
                                                <input type="checkbox" class="check-mask__input check_unmasking-{{i}}" name="check_unmasking-{{i}}" hidden checked disabled>
                                                <span class="check-mask__span"></span>
                                            </label>
                                        </div>
                                        {% else %}
                                        <div class="table-col table-permission__mask-status table-permission__item-mask">
                                            <label class="check-mask">
                                                <input type="checkbox" class="check-mask__input check_unmasking-{{i}}" name="check_unmasking-{{i}}" hidden disabled>
                                                <span class="check-mask__span"></span>
                                            </label>
                                        </div>
                                        {% endif %}
                                        {% endif %}
                                        <!--  -->
                                        <!-- Сменный инженер -->
                                        {% if roles.isReplacementEngineer %}
                                        {% if protection.masking == true %}
                                        <div class="table-col table-permission__mask-status table-permission__item-mask">
                                            <label class="check-mask">
                                                <input type="checkbox" class="check-mask__input masking-{{i}}" name="masking-{{i}}" hidden checked>
                                                <span class="check-mask__span"></span>
                                            </label>
                                        </div>
                                        {% else %}
                                        <div class="table-col table-permission__mask-status table-permission__item-mask">
                                            <label class="check-mask">
                                                <input type="checkbox" class="check-mask__input masking-{{i}}" name="masking-{{i}}" hidden>
                                                <span class="check-mask__span"></span>
                                            </label>
                                        </div>
                                        {% endif %}
                                        {% if protection.unmasking == true %}
                                        <div class="table-col table-permission__mask-status table-permission__item-mask">
                                            <label class="check-mask">
                                                <input type="checkbox" class="check-mask__input unmasking-{{i}}" name="unmasking-{{i}}" hidden checked>
                                                <span class="check-mask__span"></span>
                                            </label>
                                        </div>
                                        {% else %}
                                        <div class="table-col table-permission__mask-status table-permission__item-mask">
                                            <label class="check-mask">
                                                <input type="checkbox" class="check-mask__input unmasking-{{i}}" name="unmasking-{{i}}" hidden>
                                                <span class="check-mask__span"></span>
                                            </label>
                                        </div>
                                        {% endif %}
                                        {% if protection.check_masking == true %}
                                        <div class="table-col table-permission__mask-status table-permission__item-mask">
                                            <label class="check-mask" >
                                                <input type="checkbox" class="check-mask__input check_masking-{{i}}" name="check_masking-{{i}}" hidden checked disabled>
                                                <span class="check-mask__span"></span>
                                            </label>
                                        </div>
                                        {% else %}
                                        <div class="table-col table-permission__mask-status table-permission__item-mask">
                                            <label class="check-mask" >
                                                <input type="checkbox" class="check-mask__input check_masking-{{i}}" name="check_masking-{{i}}" hidden disabled>
                                                <span class="check-mask__span"></span>
                                            </label>
                                        </div>
                                        {% endif %}
                                        {% if protection.check_unmasking == true %}
                                        <div class="table-col table-permission__mask-status table-permission__item-mask">
                                            <label class="check-mask">
                                                <input type="checkbox" class="check-mask__input check_unmasking-{{i}}" name="check_unmasking-{{i}}" hidden checked disabled>
                                                <span class="check-mask__span"></span>
                                            </label>
                                        </div>
                                        {% else %}
                                        <div class="table-col table-permission__mask-status table-permission__item-mask">
                                            <label class="check-mask">
                                                <input type="checkbox" class="check-mask__input check_unmasking-{{i}}" name="check_unmasking-{{i}}" hidden disabled>
                                                <span class="check-mask__span"></span>
                                            </label>
                                        </div>
                                        {% endif %}
                                        {% endif %}
                                        <!--  -->
                                        <!-- Проверяющий инженер -->
                                        {% if roles.isInspectingEngineer %}
                                        {% if protection.masking == true %}
                                        <div class="table-col table-permission__mask-status table-permission__item-mask">
                                            <label class="check-mask">
                                                <input type="checkbox" class="check-mask__input masking-{{i}}" name="masking-{{i}}" hidden checked disabled>
                                                <span class="check-mask__span"></span>
                                            </label>
                                        </div>
                                        {% else %}
                                        <div class="table-col table-permission__mask-status table-permission__item-mask">
                                            <label class="check-mask">
                                                <input type="checkbox" class="check-mask__input masking-{{i}}" name="masking-{{i}}" hidden disabled>
                                                <span class="check-mask__span"></span>
                                            </label>
                                        </div>
                                        {% endif %}
                                        {% if protection.unmasking == true %}
                                        <div class="table-col table-permission__mask-status table-permission__item-mask">
                                            <label class="check-mask">
                                                <input type="checkbox" class="check-mask__input unmasking-{{i}}" name="unmasking-{{i}}" hidden checked disabled>
                                                <span class="check-mask__span"></span>
                                            </label>
                                        </div>
                                        {% else %}
                                        <div class="table-col table-permission__mask-status table-permission__item-mask">
                                            <label class="check-mask">
                                                <input type="checkbox" class="check-mask__input unmasking-{{i}}" name="unmasking-{{i}}" hidden disabled>
                                                <span class="check-mask__span"></span>
                                            </label>
                                        </div>
                                        {% endif %}
                                        {% if protection.check_masking == true %}
                                        <div class="table-col table-permission__mask-status table-permission__item-mask">
                                            <label class="check-mask" >
                                                <input type="checkbox" class="check-mask__input check_masking-{{i}}" name="check_masking-{{i}}" hidden checked>
                                                <span class="check-mask__span"></span>
                                            </label>
                                        </div>
                                        {% else %}
                                        <div class="table-col table-permission__mask-status table-permission__item-mask">
                                            <label class="check-mask" >
                                                <input type="checkbox" class="check-mask__input check_masking-{{i}}" name="check_masking-{{i}}" hidden>
                                                <span class="check-mask__span"></span>
                                            </label>
                                        </div>
                                        {% endif %}
                                        {% if protection.check_unmasking == true %}
                                        <div class="table-col table-permission__mask-status table-permission__item-mask">
                                            <label class="check-mask">
                                                <input type="checkbox" class="check-mask__input check_unmasking-{{i}}" name="check_unmasking-{{i}}" hidden checked>
                                                <span class="check-mask__span"></span>
                                            </label>
                                        </div>
                                        {% else %}
                                        <div class="table-col table-permission__mask-status table-permission__item-mask">
                                            <label class="check-mask">
                                                <input type="checkbox" class="check-mask__input check_unmasking-{{i}}" name="check_unmasking-{{i}}" hidden >
                                                <span class="check-mask__span"></span>
                                            </label>
                                        </div>
                                        {% endif %}
                                        {% endif %}
                                    <!--  -->
                                    </div>
                                {% endif %}
                                {% endfor %}

                                    <input type="submit" name="masking-submit" class="masking-submit" hidden>
                                </form>                                 
							</div>
                            {% endif %}
                            <!--  -->

							<div class="table-content__col table-col table-permission__col table-permission__subdivision">
                                {{permission.subdivision_name}}
                            </div>
							<div class="table-content__col table-col table-permission__col table-permission__person">
                                {% for responsible in responsiblesForPreparation %}
                                    {% if responsible.permission_id == permission.id %}
                                        <div class="table-permission__subname">
                                            {{responsible.lastname}} {{responsible.name}} {{responsible.patronymic}}
                                        </div>
                                    {% endif %}
                                {% endfor %}
							</div>
                            <div class="table-content__col table-col table-permission__col table-permission__person">
                                {% for responsible in responsiblesForExecute %}
                                {% if responsible.permission_id == permission.id %}
                                <div class="table-permission__subname">
                                    {{responsible.lastname}} {{responsible.name}} {{responsible.patronymic}}
                                </div>
                                {% endif %}
                                {% endfor %}
                            </div>
                            <div class="table-content__col table-col table-permission__col table-permission__person">
                                {% for responsible in responsiblesForControl %}
                                {% if responsible.permission_id == permission.id %}
                                <div class="table-permission__subname">
                                    {{responsible.lastname}} {{responsible.name}} {{responsible.patronymic}}
                                </div>
                                {% endif %}
                                {% endfor %}
                            </div>
                            <div class="table-content__col table-col table-permission__col table-permission__period">
                                {% if permission.period_start > '' %}
                                <div class="table-permission__subname">
                                    {{permission.period_start}} - {{permission.period_end}}
                                </div>
                                {% else %}
                                {% for date in dates %}
                                {% if date.permissionid == permission.id %}
                                <div class="table-permission__subname">
                                    {{date.date}} {{date.from_time}}-{{date.to_time}}
                                </div>
                                {% endif %}
                                {% endfor %}
                                {% endif %}
                            </div>
                            <div class="table-content__col table-col table-permission__col table-permission__text">
                                {% for work in typical_works %}
                                {% if work.permission_id == permission.id %}
                                <div class="table-permission__subname">
                                    {{work.name}}
                                    {% if work.description > '' %}
                                    ({{work.description}})
                                    {% endif %}
                                </div>
                                {% endif %}
                                {% endfor %}
                            </div>
                            <div class="table-content__col table-col table-permission__col table-permission__text">
                                {{permission.untypical_work}}
                            </div>
                            <div class="table-content__col table-col table-permission__col table-permission__text">
                                {{permission.description}}
                            </div>
                            <div class="table-content__col table-col table-permission__col table-permission__text">
                                {{permission.addition}}
                            </div>
							<input type="text" class="row-id" name="id" hidden readonly value="{{permission.id}}">
						</div>
                        {% endfor %}
					</div>
				</div>
                {% endif %}
                {% if is_archive and nums_pages|length > 1 %}
                <div class="pagination">
                    <div class="pagination__body">
                        <div class="pagination__list">
                            <div class="pagination__item">
                                <span class="icon-arrow-left"></span>
                                {% for num_page in nums_pages %}
                                {% if num_page.left %}
                                <input type="text" readonly hidden class="pagination__input" value="{{num_page.num}}">
                                {% endif %}
                                {% endfor %}
                            </div>
                            {% for num_page in nums_pages %}
                                    {% if num_page.fl %}
                                        <div class="pagination__item pagination__item_active">{{num_page.num}}</div>
                                    {% else %}
                                        {% if num_page.points %}
                                        <div class="pagination__item">
                                            ...
                                            <input type="text" readonly hidden class="pagination__input" value="{{num_page.num}}">
                                        </div>
                                        {% else %}
                                        <div class="pagination__item">
                                            {{num_page.num}}
                                            <input type="text" readonly hidden class="pagination__input" value="{{num_page.num}}">
                                        </div>
                                        {% endif %}
                                    {% endif %}
                            {% endfor %}
                            <div class="pagination__item">
                                <span class="icon-arrow-right"></span>
                                {% for num_page in nums_pages %}
                                {% if num_page.right %}
                                <input type="text" readonly hidden class="pagination__input" value="{{num_page.num}}">
                                {% endif %}
                                {% endfor %}
                            </div>
                        </div>
                    </div>
                    <form action="" method="get" id="form_num_page">
                        <input type="text" readonly hidden id="num_page" name="num_page">
                    </form>
                </div>
                {% endif %}
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
		<script src="/public/js/permission.js"></script>
	</body>
</html>