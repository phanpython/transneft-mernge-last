//Подготовка массива типовых разрешений к отправке формы

if(document.querySelector('.typical-work__checkbox')) {
    let checkboxes = document.querySelectorAll('.typical-work__checkbox');
    let inputTypesWorks = document.querySelector('.array_types_works');
    let arrTypesWorks = [];

    checkboxes.forEach(e => {
        if(e.checked) {
            toggleIdOfTypeWorkToArray(e);
        }

       e.addEventListener('change', () => {
            toggleIdOfTypeWorkToArray(e);
       });
    });

    function toggleIdOfTypeWorkToArray(e) {
        let id = e.getAttribute('id').match(/\d+/)[0];
        let index = arrTypesWorks.indexOf(id);

        if(index + 1) {
            arrTypesWorks.splice(index, 1);
        } else {
            arrTypesWorks.push(id);
        }
    }

    //Отправка типов работ 
    let buttonSendTypesWork = document.querySelector('.button-send-types-work');
    let formTypesWork = document.querySelector('.content__types-work');

    buttonSendTypesWork.addEventListener('click', () => {
        arrTypesWorks.forEach(e => {
            if(!inputTypesWorks.value) {
                inputTypesWorks.value = inputTypesWorks.value + e;
            } else {
                inputTypesWorks.value = inputTypesWorks.value + " " + e;
            }
        });

        formTypesWork.submit();
    });
}

if(document.querySelector('.typical-work__checkbox')) {
    let checkboxTypicalWork = document.querySelectorAll('.typical-work__checkbox');

    checkboxTypicalWork.forEach(e => {
        toggleClass(e);

        e.addEventListener('click', () => {
            toggleClass(e);
        });
    });

    //Функция вывода и прикрытия описания работы
    function toggleClass(e) {
        let textarea = e.parentElement.parentElement.querySelector('.typical-work__textarea');

        if(e.checked) {
            textarea.classList.add('typical-work__textarea_active');
        } else {
         textarea.classList.remove('typical-work__textarea_active');
        }
    }
}