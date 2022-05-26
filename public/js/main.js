//Скрытие пароля
if(document.querySelector('.authorization__icon')) {
    toggleShowPassword(document.querySelectorAll('.authorization__password'))
}

function toggleShowPassword(blockPass) {
    blockPass.forEach( (pass, index) =>  {
        let icon = pass.lastElementChild;

        icon.addEventListener('click', () => {
            let inputPassword = document.querySelectorAll('.input-password')[index];

            if (inputPassword.getAttribute('type') == 'password') {
                icon.classList.remove('icon-password');
                icon.classList.add('icon-password-hidden');
                inputPassword.setAttribute('type', 'text');
            } else {
                icon.classList.remove('icon-password-hidden');
                icon.classList.add('icon-password');
                inputPassword.setAttribute('type', 'password');
            }
        });
    });
}

if(document.querySelectorAll('input').length > 0) {
    let inputs = [];

    document.querySelectorAll('input').forEach(e => {
        inputs.push(e);
    });

    inputs = inputs.filter(e => e.type !== "submit");

    inputs.forEach(e => {
        if(e.value === '') {
            e.classList.add('valid');
        }

        e.addEventListener('input', () => {
            e.classList.remove('valid');
        });
    });
}

//Выбор поля
if(document.querySelector(".custom-select")) {
    let x, i, j, l, ll, selElmnt, a, b, c;
    x = document.getElementsByClassName("custom-select");
    l = x.length;
    for (i = 0; i < l; i++) {

        //Блокировка селектов
        if(document.querySelector('.responsible-content__submit') && i > 0) {
            x[i].classList.add("date-disabled");
        }

        selElmnt = x[i].getElementsByTagName("select")[0];
        ll = selElmnt.length;
        a = document.createElement("DIV");
        a.setAttribute("class", "select-selected");
        a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
        x[i].appendChild(a);
        b = document.createElement("DIV");
        b.setAttribute("class", "select-items select-hide");
        for (j = 1; j < ll; j++) {
            c = document.createElement("DIV");
            c.innerHTML = selElmnt.options[j].innerHTML;
            c.setAttribute('idDivWithChild', selElmnt.options[j].getAttribute('idDivWithChild'));

            c.addEventListener("click", function(e) {
                let y, i, k, s, h, sl, yl, input;
                s = this.parentNode.parentNode.getElementsByTagName("select")[0];
                sl = s.length;
                h = this.parentNode.previousSibling;

                for (i = 0; i < sl; i++) {
                    if (s.options[i].innerHTML == this.innerHTML) {
                        s.selectedIndex = i;
                        h.innerHTML = this.innerHTML;

                        input = document.querySelector('.input-position');
                        input.value = h.innerHTML;

                        y = this.parentNode.getElementsByClassName("same-as-selected");
                        yl = y.length;
                        for (k = 0; k < yl; k++) {
                            y[k].removeAttribute("class");
                        }
                        this.setAttribute("class", "same-as-selected");
                        break;
                    }
                }

                h.click();
            });

            b.appendChild(c);
        }


        x[i].appendChild(b);
        a.addEventListener("click", function(e) {
            e.stopPropagation();
            closeAllSelect(this);
            this.nextSibling.classList.toggle("select-hide");
            this.classList.toggle("select-arrow-active");
        });
    }

    function closeAllSelect(elmnt) {
        let x, y, i, xl, yl, arrNo = [];
        x = document.getElementsByClassName("select-items");
        y = document.getElementsByClassName("select-selected");
        xl = x.length;
        yl = y.length;
        for (i = 0; i < yl; i++) {
            if (elmnt == y[i]) {
                arrNo.push(i)
            } else {
                y[i].classList.remove("select-arrow-active");
            }
        }
        for (i = 0; i < xl; i++) {
            if (arrNo.indexOf(i)) {
                x[i].classList.add("select-hide");
            }
        }
    }

    document.addEventListener("click", closeAllSelect);
}


if(document.querySelector('.registration')) {
    let form = document.querySelector('.registration');
    let firstInputPassword = document.querySelector('.reg-pass-first');
    let secondInputPassword = document.querySelector('.reg-pass-second');
    let messageError = document.getElementById('password-different');

    //Запрет отправки формы если пароли не совпадают
    form.addEventListener('submit', function(event) {
        let firstPassword  = firstInputPassword.value;
        let secondPassword  = secondInputPassword.value;
        let subdivision = document.getElementById('input-subdivision').value;

        //Проверка выбрана ли должность
        // let inputPosition = document.querySelector('.input-position');
        // let selects = document.querySelectorAll('.select-selected');
        // if(!inputPosition.value) {
        //     selects[0].classList.add('select-selected_active');

        //     setTimeout(() => {
        //         selects[0].classList.remove('select-selected_active');
        //     }, 1000);

        //     event.preventDefault();
        // }

        //Проверка совпадают ли пароли
        if(firstPassword !== secondPassword) {
            event.preventDefault();
        }

        //Проверка выбрано ли подразделение
        if(subdivision === '') {
            event.preventDefault();
        }
    });

    // Вывод подсказки в случае, если пароли не совпадают
    firstInputPassword.addEventListener('input', () => {
        if(!checkPasswords(firstInputPassword, secondInputPassword)) {
            messageError.innerHTML = 'Пароли не сопадают!';
        } else {
            messageError.innerHTML = '';
        }
    });
    secondInputPassword.addEventListener('input', () => {
        if(!checkPasswords(firstInputPassword, secondInputPassword)) {
            messageError.innerHTML = 'Пароли не сопадают!';
        } else {
            messageError.innerHTML = '';
        }
    });

    function checkPasswords(firstInputPassword, secondInputPassword) {
        let firstPassword  = firstInputPassword.value;
        let secondPassword  = secondInputPassword.value;

        if(firstPassword !== secondPassword) {
            return false;
        }

        return true;
    }
}


//Оповещение об успешной подачи заявки на регистрацию
if(document.querySelector('.content__ad')) {
    if(document.querySelector('.content__ad').value) {
        const SPEED_ANIMATE = 500;
        const modal = document.querySelector('.window-ad');
        const closeModal = document.querySelector('.window-ad__clear');
        const button = document.querySelector('.window-ad__button');

        modal.classList.add('open');

        closeModal.addEventListener('click', () => {
            modal.classList.remove('open');
            modal.classList.add('hide');

            setTimeout(() => {
                modal.classList.remove('hide');
            }, SPEED_ANIMATE);
        });

        button.addEventListener('click', () => {
            modal.classList.remove('open');
            modal.classList.add('hide');

            setTimeout(() => {
                modal.classList.remove('hide');
            }, SPEED_ANIMATE);
        });


        addEventListener('keydown', (e) => {
            if(e.key === 'Escape') {
                if(modal.classList.contains('open')) {
                    modal.classList.remove('open');
                    modal.classList.add('hide');
                }

                setTimeout(() => {
                    modal.classList.remove('hide');
                }, SPEED_ANIMATE);
            }
        });
    }
}

//Установка масок элементам формы регистрации
if(document.getElementById('mobile-phone')) {
    let phone = document.getElementById('mobile-phone');

    phone.addEventListener('focus', () => {
        let dateOptions = {
            mask: '+7 (000) 000-00-00',
            lazy: false
        };

        new IMask(phone, dateOptions);
    })
}

if(document.querySelector('.text-input')) {
    let textInputs = document.querySelectorAll('.text-input');

    textInputs.forEach(e => {
        e.addEventListener('focus', () => {
            let dateOptions = {
                mask: /^[а-яА-Я]{0,100}$/,
                lazy: false
            };

            new IMask(e, dateOptions);
        })
    });
}

if(document.getElementById('mats')) {
    let phone = document.getElementById('mats');

    phone.addEventListener('focus', () => {
        let dateOptions = {
            mask: '(0000) 0000',
            lazy: false
        };

        new IMask(phone, dateOptions);
    })
}

if(document.getElementById('dect')) {
    let phone = document.getElementById('dect');

    phone.addEventListener('focus', () => {
        let dateOptions = {
            mask: '(0000) 0000',
            lazy: false
        };

        new IMask(phone, dateOptions);
    })
}

if(document.getElementById('gats')) {
    let phone = document.getElementById('gats');

    phone.addEventListener('focus', () => {
        let dateOptions = {
            mask: '000000',
            lazy: false
        };

        new IMask(phone, dateOptions);
    })
}

//Переключение между формами
if(document.querySelector('.content__button-checkout')) {
    // let buttonsCheckout = document.querySelectorAll('.content__button-checkout');
    let authButton = document.querySelector('.content__button-authorization');
    let regButton = document.querySelector('.content__button-registration');
    let authorization = document.querySelector('.authorization');
    let registration = document.querySelector('.registration');

    if(registration.classList.contains('registration_active')) {
        setRegActive();
    }

    regButton.addEventListener('click', () => {
        setRegActive();
    });

    authButton.addEventListener('click', () => {
        setAuthActive();
    });

    function setRegActive() {
        registration.classList.add('registration_active');
        authorization.classList.remove('authorization_active');
        regButton.classList.add('content__button-checkout_active');
        authButton.classList.remove('content__button-checkout_active');
    }

    function setAuthActive() {
        registration.classList.remove('registration_active');
        authorization.classList.add('authorization_active');
        authButton.classList.add('content__button-checkout_active');
        regButton.classList.remove('content__button-checkout_active');
    }
}

//Перетекание подразделения из дерева в textarea
if(document.querySelector('.tree__text')) {
    let textTree = document.querySelectorAll('.tree__text');

    textTree.forEach(e => {
        e.addEventListener('click', (event) => {
            subdivisionFromTreeToTextarea(e);
            subdivisionIdFromTreeToInputSubdivisionForm(e);
            event.stopPropagation();
        })
    })
}
function subdivisionIdFromTreeToInputSubdivisionForm(treeText) {
    let id = treeText.closest('.tree__item_top').querySelector('.tree__input').value;
    let inputSubdivision = document.getElementById('subdivision_id');

    inputSubdivision.value = id;
}

function subdivisionFromTreeToTextarea(treeText) {
    let inputSub = document.getElementById('textarea-subdivision');
    inputSub.value = treeText.innerHTML.trim();

    if(inputSub.scrollHeight > 0){
        let currentHeight = inputSub.scrollHeight;

        for(let i = 0; i < inputSub.scrollHeight; i++) {
            inputSub.style.height = inputSub.scrollHeight + "px";
            currentHeight = inputSub.style.height;

            if(currentHeight == inputSub.scrollHeight) {
                return;
            }
        }
    }
}

if(document.querySelector('.tree')) {
    
    let input = document.querySelector('.tree-send__input');
    let table = document.querySelector('.responsible__table');
    setEventListenerForPlus(document.querySelector('.tree__plus'), input, table);
}
