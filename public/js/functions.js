//Функция добавления слушателя на нажатие на ячейку чекбокса
function addListenerForColChoice(checkbox, nameInputChoice) {
    let colChoice = checkbox.closest('.table-content__col');
    colChoice.addEventListener('click', (event) => {
        document.querySelectorAll(nameInputChoice).forEach(e => {
            if(e !== checkbox) {
                e.checked = false;
            }
        });

        if(event.target.classList.contains('table-content__col')) {
            if(checkbox.checked) {
                checkbox.checked = false;
            } else {
                checkbox.checked = true;
            }
        }
    });
}



//Функции для дерева подразделений
function setSubdivisionsForTree(id, elem, input){
    if (id > 0) {
        let xmlhttp = new XMLHttpRequest();
        let params = 'id_for_sub=' + encodeURIComponent(id);
        let subdivisions;

        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                let json = this.responseText;

                subdivisions = JSON.parse(json);
                subdivisions.forEach(e => {
                    createListTree(elem, e, input);
                });
            }
        };
        xmlhttp.open("GET", "?" + params, true);
        xmlhttp.send();
    }
}

function createListTree(elem, subdivision, inputt) {
    let list = document.createElement('div');
    let item = document.createElement('div');
    let block = document.createElement('div');
    let input = document.createElement('input');
    let span = document.createElement('span');
    let text = document.createElement('div');

    list.setAttribute('class', 'tree__list');
    item.setAttribute('class', 'tree__item');
    block.setAttribute('class', 'tree__item-block');
    input.setAttribute('class', 'tree__input');
    input.setAttribute('hidden', 'hidden');
    input.setAttribute('value', subdivision.id);

    if (subdivision.flag) {
        span.setAttribute('class', 'icon-square-plus-solid tree__plus tree__plus_active');
    } else {
        span.setAttribute('class', 'icon-square-plus-solid tree__plus');
    }

    text.setAttribute('class', 'tree__text');
    text.innerHTML = subdivision.name;

    if(typeof setEventListenerForText == 'function') {
        setEventListenerForText(text, inputt);
    }

    setEventListenerForPlus(span, inputt);

    elem.appendChild(list);
    list.appendChild(item);
    item.appendChild(block);
    block.appendChild(input);
    block.appendChild(span);
    block.appendChild(text);

    if(document.querySelector('.registration')) {
        text.addEventListener('click', (event) => {
            subdivisionFromTreeToTextarea(text);
            subdivisionIdFromTreeToInputSubdivisionForm(text);
            event.stopPropagation();
        })
    }
}

function setEventListenerForPlus(e, input) {
    e.addEventListener('click', (event) => {
        let item = e.parentElement.parentElement;

        if(item.querySelector('.tree__list')) {
            delSubdivisionsFromParent(item.querySelectorAll('.tree__list'));
        } else {
            input.value = item.querySelector('.tree__input').value;
            setSubdivisionsForTree(input.value, item, input);
            event.stopPropagation();
        }
    });
}

function delSubdivisionsFromParent(lists) {
    lists.forEach(e => {
        e.remove();
    });
}

//Выход из учетной записи
if(document.querySelector('.header__exit')) {
    let form = document.querySelector('.header__exit');

    form.addEventListener('click', () => {
       form.submit();
    });
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


/* Дима */

function setObjectsForTree(id, elem, input){
    if (id > 0) {
        let xmlhttp = new XMLHttpRequest();
        let params = 'id_for_object=' + encodeURIComponent(id);
        let objects;

        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                let json = this.responseText;
                console.log(json);

                objects = JSON.parse(json);
                objects.forEach(e => {
                    createListTreeObject(elem, e, input);
                });
            }
        };
        xmlhttp.open("GET", "?" + params, true);
        xmlhttp.send();
    }
}

function createListTreeObject(elem, subdivision, inputt) {
    let list = document.createElement('div');
    let item = document.createElement('div');
    let block = document.createElement('div');
    let input = document.createElement('input');
    let span = document.createElement('span');
    let text = document.createElement('div');

    list.setAttribute('class', 'tree__list');
    item.setAttribute('class', 'tree__item');
    block.setAttribute('class', 'tree__item-block');
    input.setAttribute('class', 'tree__input');
    input.setAttribute('hidden', 'hidden');
    input.setAttribute('value', subdivision.id);

    if (subdivision.flag) {
        span.setAttribute('class', 'icon-square-plus-solid tree__plus tree__plus_active');
    } else {
        span.setAttribute('class', 'icon-square-plus-solid tree__plus');
    }

    text.setAttribute('class', 'tree__text');
    text.innerHTML = subdivision.name;

    if(typeof setEventListenerForText == 'function') {
        setEventListenerForText(text, inputt);
    }

    setEventListenerForPlusObject(span, inputt);

    elem.appendChild(list);
    list.appendChild(item);
    item.appendChild(block);
    block.appendChild(input);
    block.appendChild(span);
    block.appendChild(text);

    if(document.querySelector('.registration')) {
        text.addEventListener('click', (event) => {
            subdivisionFromTreeToTextarea(text);
            subdivisionIdFromTreeToInputSubdivisionForm(text);
            event.stopPropagation();
        })
    }
}

function setEventListenerForPlusObject(e, input) {
    e.addEventListener('click', (event) => {
        let item = e.parentElement.parentElement;

        if(item.querySelector('.tree__list')) {
            delSubdivisionsFromParent(item.querySelectorAll('.tree__list'));
        } else {
            input.value = item.querySelector('.tree__input').value;
            setObjectsForTree(input.value, item, input);
            event.stopPropagation();
        }
    });
}

if(document.querySelector('.tree')) {
    /* console.log('yes'); */
    let input = document.querySelector('.tree-send__input');
    let table = document.querySelector('.responsible__table');
    setEventListenerForPlusObject(document.querySelector('.tree__plus'), input, table);
}

let countRows = document.querySelectorAll('.table-row').length;

let buttonsLocation = [];

for (let i = 1; i < countRows+1; i++) {
    buttonsLocation[i] = document.querySelector('.button-location-'+ i);
}



for (let i = 1; i < countRows+1; i++) {
    buttonsLocation[i].addEventListener('click', (event) => {
        let treeObject = document.querySelector('.responsible__tree');
        treeObject.removeAttribute("hidden");
        treeObject.setAttribute("name",buttonsLocation[i].name);
    })
}



//Перетекание подразделения из дерева в textarea
if(document.querySelector('.tree__text')) {
    let textTree = document.querySelectorAll('.tree__text');

    textTree.forEach(e => {
        e.addEventListener('click', (event) => {
            let treeObject = document.querySelector('.responsible__tree');
            let idLocation = treeObject.getAttribute("name");
            subdivisionFromTreeToTextarea(idLocation, e);
            event.stopPropagation();
        })
    })
}

function subdivisionFromTreeToTextarea(id, treeText) {
    console.log(treeText);
    console.log(id);
    let inputSub = document.querySelector('.location-' + id);
    inputSub.value = treeText.innerHTML.trim();

}

/* Дима */