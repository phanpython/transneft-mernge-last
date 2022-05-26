//Вставка новой строки в таблицу
if(document.querySelector('.button-add-row')) {
    let buttonAdd = document.querySelector('.button-add-row');
    let table = document.querySelector('.table-content');
    let namesCols = getNamesCols();
    let nameInputChoice = '.input-choice';
    
    buttonAdd.addEventListener('click', () => {
        addRow();   
    })

    //Функция добавления строки
    function addRow() {
        let addRow;

        document.querySelectorAll('.table-row').forEach(e => {
            if(e.querySelector(nameInputChoice).checked) {
                addRow = e.cloneNode(true);
            }
        });

        //Добавление на основе выделенной строки 
        if(addRow) {
            processRow(addRow);
            addListenerForColChoice(addRow.querySelector(nameInputChoice), nameInputChoice)
            setMasks();
        } 
        //Обычное добавление пустой строки
        else {
            let tableRow = document.querySelector('.table-row');
            addRow = tableRow.cloneNode(true);
            cleanRow(addRow);
            processRow(addRow);
            addListenerForColChoice(addRow.querySelector(nameInputChoice), nameInputChoice)
            setMasks();
        }
    }

    function getNamesCols() {
        let inputs = getInputs();
        let result = [];
        
        for (let input of inputs) {
            result.push(input.name.slice(0, -1));
        }

        return result;
    }

    function getInputs() {
        let row = document.querySelector('.table-row');
        let result = [];

        for (let child of row.children) {
            result.push(child.firstElementChild);
        }

        return result;
    }

    //Функция обработки добавляемой строки
    function processRow(addRow) {
        addRow.querySelector(nameInputChoice).checked = false;
        table.appendChild(addRow);
        setNamesRows(addRow);
    }

    function setNamesRows() {
        let rows = document.querySelectorAll('.table-row');
        let id = 1;

        rows.forEach(e => {
            for (let i = 0; i < e.children.length; i++) {
                let name = namesCols[i] + id;
                e.children[i].firstElementChild.name = name; 
            }
            id++;
        });
    }

    document.querySelectorAll('.table-row').forEach(e => {
        addListenerForColChoice(e.querySelector(nameInputChoice), nameInputChoice)
    })

    //Удаление строки
    let delButton = document.querySelector('.button-del-row');

    delButton.addEventListener('click', () => {
        let countRows = document.querySelectorAll(nameInputChoice).length;
        let delRow = getDelRow();
            
        if(countRows === 1) {
            cleanRow(delRow);
            setMasks();
        } else if(delRow) {
            delRow.remove();
        } else {
            return;
        }

        setNamesRows();
    });

    function getDelRow() {
        let result;
        document.querySelectorAll(nameInputChoice).forEach(e => {
            if(e.checked) {
                result =  e.closest('.table-content__row');
            }
        });

        return result;
    }

    function cleanRow(delRow) {
        for (let children of delRow.children) {
            children.firstElementChild.value = '';
        }
    }

//Сохранение дат
let saveButton = document.querySelector('.save-dates');
let submitSaveDates = document.querySelector('.submit-save-dates');

saveButton.addEventListener('click', () => {
    let timesFrom = document.querySelectorAll('.time-from');
    let timesTo = document.querySelectorAll('.time-to');

    if(checkTimes(timesFrom, timesTo) ) {
        submitSaveDates.click();
    }
});

//Проверка времени начала и окончания работ (нужно, чтобы время окончания было больше, чем время начала)
function checkTimes(timesFrom, timesTo) {
    let reg = '^([0-1][0-9]|2[0-4]):[0-5][0-9]$';
    let fl = true;

    timesFrom.forEach((e,i) => {
        if(timesFrom[i].value.search(reg) + 1 && timesTo[i].value.search(reg) + 1) {
            let objDateFrom = new Date();
            let objDateTo = new Date();
    
            objDateFrom.setHours(timesFrom[i].value.slice(0,2));
            objDateFrom.setMinutes(timesFrom[i].value.slice(3,5));
            objDateTo.setHours(timesTo[i].value.slice(0,2));
            objDateTo.setMinutes(timesTo[i].value.slice(3,5));
    
            if(objDateFrom >= objDateTo) {
                fl = false;
                timesFrom[i].classList.add('error-animation');
                timesTo[i].classList.add('error-animation');
            }
        } 
        else {
            timesFrom[i].classList.add('error-animation');
            timesTo[i].classList.add('error-animation');
            fl = false;
        }

        setTimeout(() => {
            if(document.querySelector('.error-animation')) {
                let errorAnimation = document.querySelectorAll('.error-animation');

                errorAnimation.forEach(e => {
                    e.classList.remove('error-animation');
                });
            }
        }, 1000);
    })

    return fl;
}

//Функция установки масок
function setMasks() {
    if(document.querySelector('.date-mask')) {
        setMaskDate();
    }

    if(document.querySelector('.time-mask')) {
        setMaskTime();
    }
}
}

//Вызов функции установки маски даты
if(document.querySelector('.date-mask')) {
    setMaskDate();
}

//Функция установки маски даты
function setMaskDate() {
    let dates = document.querySelectorAll('.date-mask');
    let dateOptions = {
        mask: '00.00.0000',
        lazy: false
    };

    dates.forEach(e => {
        new IMask(e, dateOptions);
    });
}


//Вызов функции установки маски времени
if(document.querySelector('.time-mask')) {
    setMaskTime();
}

//Функция установки маски времени
function setMaskTime() {
    let dates = document.querySelectorAll('.time-mask');
    let dateOptions = {
        mask: '00:00',
        lazy: false
    };

    dates.forEach(e => {
        new IMask(e, dateOptions);
    });
}