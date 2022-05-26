
//Перетекание данных для отправки данных на сервер

if(document.getElementById('description_form')) {
    let textareaDescription = document.getElementById('description');
    let textareaDescriptionFrom = document.getElementById('description_form');

    if(textareaDescription.value !== '') {
        textareaDescriptionFrom.value = textareaDescription.value;
    }

    textareaDescription.addEventListener('change', () => {
        textareaDescriptionFrom.value = textareaDescription.value;
    });
}

if(document.getElementById('addition_form')) {
    let textareaAddition = document.getElementById('addition');
    let textareaAdditionForm = document.getElementById('addition_form');

    if(textareaAddition.value !== '') {
        textareaAdditionForm.value = textareaAddition.value;
    }

    textareaAddition.addEventListener('change', () => {
        textareaAdditionForm.value = textareaAddition.value;
    });
}
if(document.getElementById('minute_form')) {
    let inputMinutes = document.getElementById('minute');
    let minutesForm = document.getElementById('minute_form');

    if(inputMinutes.value !== '') {
        minutesForm.value = inputMinutes.value;
    }

    inputMinutes.addEventListener('change', () => {
        minutesForm.value = inputMinutes.value;
    });
}
if(document.getElementById('yes-emergency-activation')) {
    let yesEmergencyActivation = document.getElementById('yes-emergency-activation');
    let noEmergencyActivation = document.getElementById('no-emergency-activation');
    let EmergencyActivationForm = document.getElementById('emergency-activation');

    yesEmergencyActivation.addEventListener('click', () => {
        EmergencyActivationForm.value = 1;
    });

    noEmergencyActivation.addEventListener('click', () => {
        EmergencyActivationForm.value = 0;
    });
}


//Установка маски номерам разрешений
if(document.querySelector('.permission__number')) {
    let firstNumber = document.querySelector('.permission__number_first');
    let secondNumber = document.querySelector('.permission__number_second');

    let dateOptionsFirst = {
        mask: /^[0-9/-]*$/,
        lazy: false
    };

    let dateOptionsSecond = {
        mask: /^[0-9]*$/,
        lazy: false
    };

    new IMask(firstNumber, dateOptionsFirst);
    new IMask(secondNumber, dateOptionsSecond);
}

//Установка маски для времени аварийной готовности
if(document.querySelector('.condition-permission__minute')) {
    let inputMinute = document.querySelector('.condition-permission__minute');

    let dateOption = {
        mask: /^[0-9]*$/,
        lazy: false
    };

    new IMask(inputMinute, dateOption);
}


//Обработка подзагаловков типов работ
if(document.querySelector('.permission-add__subtitile_typical')) {
    if(issetTypicalWork()) {
        setSubtitleTypicalWork('2.1. Типовые работы:');
    }
}

function setSubtitleTypicalWork(text) {
    let subtitileTypical = document.querySelector('.permission-add__subtitile_typical');
    subtitileTypical.innerHTML = text;
}

function issetTypicalWork() {
    if(document.querySelector('.permission-add__type')) {
        return true;
    }
    return false;
}

function issetUntypicalWork() {
    if(document.getElementById('untypical_works')) {
        return true;
    }
    return false;
}

function setSubtitleUntypicalWork(text) {
    let subtitileUntypical = document.querySelector('.permission-add__subtitile_untypical');
    subtitileUntypical.innerHTML = text;
}

if(document.querySelector('.permission-add__subtitile_untypical')) {
    subtitileUntypical = document.querySelector('.permission-add__subtitile_untypical');

    if(document.querySelector('.permission-add__block')) {
        if(issetTypicalWork()) {
            setSubtitleUntypicalWork('2.2. Нетиповые работы:')
        } else if(issetUntypicalWork()) {
            setSubtitleUntypicalWork('2.1. Нетиповые работы:')
        }
    }
}


//--------------------------------------- Ajax ----------------------------------------

//Удаление типовых работ BEGIN
if(document.querySelector('.current_typical_work_del')) {
    let buttonDelTypicalWork = document.querySelectorAll('.current_typical_work_del');

    buttonDelTypicalWork.forEach(e => {
        let parentForm = e.closest('.permission-add__type');

        e.addEventListener('click', () => {
            let idTypicalWork = +parentForm.querySelector('.permission-add__typical').querySelector('.current_typical_work_id').getAttribute('value');
            delTypicalWork(idTypicalWork, parentForm);
        });
    });
}

function delTypicalWork(id, parentForm){
    let xmlhttp = new XMLHttpRequest();
    let params = 'id_type_work=' + encodeURIComponent(id);

    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            parentForm.remove();

            if(!issetTypicalWork()) {
                setSubtitleTypicalWork('');
                setSubtitleUntypicalWork('2.1. Нетиповые работы:')
            }
        }
    };
    xmlhttp.open("GET", "add?" + params, true);
    xmlhttp.send();
}
//Удаление типовых работ END;

//Удаление ответственных BEGIN
if(document.querySelector('.permission-add__responsible')) {
    let buttonDelResponsible = document.querySelectorAll('.permission__del_user');

    buttonDelResponsible.forEach(e => {
        let parentForm = e.closest('.permission-add__responsible');

        e.addEventListener('click', () => {
            let idTypicalWork = +parentForm.querySelector('.responsible__id').getAttribute('value');
            delResponsible(idTypicalWork, parentForm);
        });
    });
}

function delResponsible(id, parentForm){
    let xmlhttp = new XMLHttpRequest();
    let idTypePerson = parentForm.parentElement.querySelector('input[name="id_type_person"]').value;
    let params = 'id_responsible=' + encodeURIComponent(id) + '&id_type_person=' + encodeURIComponent(idTypePerson);

    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            parentForm.remove();
        }
    };
    xmlhttp.open("GET", "add?" + params, true);
    xmlhttp.send();
}
//Удаление ответственных END;

//Открытие и скрытие формы добавления периода
if(document.querySelector('.period-permission__form')) {
    let buttonAddPeriod = document.querySelector('.period-permission__button');
    let formPeriod = document.querySelector('.period-permission__form');
    let buttonClear = document.querySelector('.period-permission__clear');

    buttonAddPeriod.addEventListener('click', () => {
        formPeriod.classList.toggle('period-permission__form_active');
    });

    buttonClear.addEventListener('click', () => {
        formPeriod.classList.remove('period-permission__form_active');
    });
}

