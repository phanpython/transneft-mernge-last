//Открытие формы фильтрации при нажатии на соответсвующую кнопку
if(document.querySelector('.filter')) {
    let submitFilter = document.querySelector('.filter');
    let blockFilter = document.querySelector('.filter-content');
    let closeFilter = document.querySelector('.close-filter');
    let buttonSearch = document.querySelector('.icon-search');
    let formSearch = document.querySelector('.content-search');
    let inputSearch = document.querySelector('.input-search');

    submitFilter.addEventListener('click', () => {
        blockFilter.classList.toggle('filter-content_active');
    });

    closeFilter.addEventListener('click', () => {
        blockFilter.classList.toggle('filter-content_active');
    });

    //Вешаем слушателя на исконку поиска
    buttonSearch.addEventListener('click', (e) => {
            formSearch.submit();
    });

    setMaskSearch(inputSearch);

    function setMaskSearch(inputSearch) {
        let dateOptions = {
            mask: /^[а-яА-Я0-9-]*$/,
            lazy: false
        };

        new IMask(inputSearch, dateOptions);
    }
}

//Выгрузка файла scv
if(document.querySelector('.button-scv')) {
    let cols = document.querySelectorAll('.table-permission__col.table-permission__id');
    let buttonSCV = document.querySelector('.button-scv');
    let inputSCV = document.querySelector('.input-scv');
    let listExcel = [];

    cols.forEach(e => {
        listExcel.push(e.innerHTML.trim());
    })

    buttonSCV.addEventListener('click', () => {
        let fl = true;

        listExcel.forEach(e => {
            if(fl) {
                fl = false;
                inputSCV.value = e;
            } else {
                inputSCV.value = inputSCV.value + " " + e;
            }
        });
    });
}

//Фиксирование строки таблицы
if(document.querySelector('.table-permission__row')) {
    let checkboxes = document.querySelectorAll('.input-choice-permission');
    let rows = document.querySelectorAll('.table-row');
    let cols = document.querySelectorAll('.col-check');
    let activeForms = [];
    let activeCheckbox;
    let countClicksOnOneCheckbox = 0;

    //Вешаем лисенеры на ячейку чекбокса
    rows.forEach(e => {
        addListenerForColChoice(e.querySelector('.input-choice'), '.input-choice')
    });

    checkboxes.forEach((e) => {
        e.addEventListener('click', (event) => {
            addListenerAddIdToForms(e, checkboxes)
            event.stopPropagation();
        });
    });

    cols.forEach((e) => {
        e.addEventListener('click', (event) => {
            addListenerAddIdToForms(e, cols)
        });
    });

    function addListenerAddIdToForms(e, elems) {
        elems.forEach(el => {
            if(e.querySelector('.input-choice')) {
                e = e.querySelector('.input-choice');
            }

            if(e.checked && e !== el) {
                el.checked = false;
            }
        });

        if(e.classList.contains('col-check')) {
            e = e.querySelector('.input-choice');
        }

        let idPermission = e.parentElement.parentElement.querySelector('.row-id').value;
        let inputsProcess = document.querySelectorAll('.row-id-process');
        let inputsIdPermissionForDispatcher = document.querySelectorAll('.permission-status__id');
        let color = e.closest('.table-permission__row').previousElementSibling.value;

        //Перетекания айди разрешений в события править, создать на основе, удалить разрешение
        inputsProcess.forEach(input => {
            let buttonName = input.previousElementSibling.getAttribute('name');

            if(e.checked) {
                input.value = idPermission;
            } else {
                input.value = '';
            }
        })

        //Перетекания айди разрешений в события открыть, приостановить, закрыть разрешение
        inputsIdPermissionForDispatcher.forEach(input => {
            if(e.checked) {
                input.value = idPermission;
            } else {
                input.value = '';
            }
        })

        managementFormsFunc(color, e);
    }

    function hiddenActiveForms() {
        activeForms.forEach(e => {
            e.classList.add('hidden');
        });
    }

    function managementFormsFunc(color, e) {
        countClicksOnOneCheckbox++;

        if(activeCheckbox !== e) {
            countClicksOnOneCheckbox = 1;
            hiddenActiveForms(activeForms);
        }

        setActiveForms(color);

        if(countClicksOnOneCheckbox % 2 === 0) {
            hiddenActiveForms(activeForms);
        } else {
            showFormsFuncs();
        }

        activeCheckbox = e;
    }

    function setActiveForms(color) {
        let userRole = document.querySelector('.role').value;
        let formStoryPermission = document.getElementById('story-permission');

        if(color == 'violet') {
            let formEditPermission = document.getElementById('edit-permission');
            let formCreateByPermission = document.getElementById('create-by-permission');
            let formAgreementPermission = document.getElementById('agreement-permission');
            let formDelPermission = document.getElementById('del-permission');
            let formPDFPermission = document.getElementById('pdf-permission');
            activeForms = [formStoryPermission, formPDFPermission, formEditPermission, formCreateByPermission, formAgreementPermission, formDelPermission];
        } else if(color == 'beige') {
            if(userRole === 'Диспетчер') {
                let formEditPermission = document.getElementById('edit-permission');
                activeForms = [formStoryPermission, formEditPermission];
            } else if(userRole === 'Автор') {
                let formApplyPermission = document.getElementById('apply-permission');
                let formPDFPermission = document.getElementById('pdf-permission');
                let formCreateByPermission = document.getElementById('create-by-permission');
                let formCancelAgreementPermission = document.getElementById('cancel-agreement-permission');
                activeForms = [formStoryPermission, formPDFPermission, formApplyPermission, formCreateByPermission, formCancelAgreementPermission];
            }else if(userRole === 'Проверяющий инженер') {
                activeForms = [formStoryPermission];
            }else if(userRole === 'Сменный инженер') {
                activeForms = [formStoryPermission];
            }
        } else if(color == 'blue') {
            if(userRole === 'Диспетчер') {
                let formOpenPermission = document.getElementById('open-permission');
                let formClosePermission = document.getElementById('close-permission');
                let formStartWork = document.getElementById('start-work');
                let formFinishWork = document.getElementById('finish-work');
                let formActiveMaskingPermission = document.getElementById('activemasking-permission'); 
                activeForms = [formStoryPermission, formFinishWork, formOpenPermission, formClosePermission, formStartWork, formActiveMaskingPermission];
            } else if(userRole === 'Автор') {
                let formEditPermission = document.getElementById('edit-permission');
                let formCancelApplyPermission = document.getElementById('cancel-apply-permission');
                let formCreateByPermission = document.getElementById('create-by-permission');
                let formPDFPermission = document.getElementById('pdf-permission');
                activeForms = [formStoryPermission, formPDFPermission, formEditPermission, formCancelApplyPermission, formCreateByPermission];
            }else if(userRole === 'Проверяющий инженер') {
                let formMaskingPermission = document.getElementById('check_masking-permission');
                let formCheckUnmaskingPermission = document.getElementById('check_unmasking-permission');
                activeForms = [formStoryPermission, formMaskingPermission, formCheckUnmaskingPermission];
            }else if(userRole === 'Сменный инженер') {
                let formMaskingPermission = document.getElementById('masking-permission');
                let formUnmaskingPermission = document.getElementById('unmasking-permission');
                activeForms = [formStoryPermission, formMaskingPermission, formUnmaskingPermission];
            }
        } else if(color == 'green') {
            if(userRole === 'Диспетчер') {
                let formStartWork = document.getElementById('start-work');
                let formClosePermission = document.getElementById('close-permission');
                let formPausePermission = document.getElementById('pause-permission');
                let formActiveUnaskingPermission = document.getElementById('activeunmasking-permission'); 
                let formActiveMaskingPermission = document.getElementById('activemasking-permission');
                let formFinishWork = document.getElementById('finish-work');
                activeForms = [formStartWork, formFinishWork, formStoryPermission, formClosePermission, formPausePermission, formActiveUnaskingPermission, formActiveMaskingPermission];
            } else if(userRole === 'Автор') {
                let formCreateByPermission = document.getElementById('create-by-permission');
                let formPDFPermission = document.getElementById('pdf-permission');
                activeForms = [formStoryPermission, formCreateByPermission, formPDFPermission];
            }else if(userRole === 'Проверяющий инженер') {
                let formMaskingPermission = document.getElementById('check_masking-permission');
                let formCheckUnmaskingPermission = document.getElementById('check_unmasking-permission');
                activeForms = [formStoryPermission, formMaskingPermission, formCheckUnmaskingPermission];
            }else if(userRole === 'Сменный инженер') {
                let formMaskingPermission = document.getElementById('masking-permission');
                let formUnmaskingPermission = document.getElementById('unmasking-permission');
                activeForms = [formStoryPermission, formMaskingPermission, formUnmaskingPermission];
            }
        } else if(color == 'yellow') {
            if(userRole === 'Диспетчер') {
                let formStartWork = document.getElementById('start-work');
                let formFinishWork = document.getElementById('finish-work');
                let formClosePermission = document.getElementById('close-permission');
                let formOpenPermission = document.getElementById('open-permission');
                let formActiveUnaskingPermission = document.getElementById('activeunmasking-permission');
                let formActiveMaskingPermission = document.getElementById('activemasking-permission');
                activeForms = [formStoryPermission, formStartWork, formFinishWork, formClosePermission, formOpenPermission, formActiveUnaskingPermission, formActiveMaskingPermission];
            } else if(userRole === 'Автор') {
                let formPDFPermission = document.getElementById('pdf-permission');
                let formCreateByPermission = document.getElementById('create-by-permission');
                activeForms = [formStoryPermission, formPDFPermission, formCreateByPermission];
            }else if(userRole === 'Проверяющий инженер') {
                let formMaskingPermission = document.getElementById('check_masking-permission');
                let formCheckUnmaskingPermission = document.getElementById('check_unmasking-permission');
                activeForms = [formStoryPermission, formMaskingPermission, formCheckUnmaskingPermission];
            }else if(userRole === 'Сменный инженер') {
                let formMaskingPermission = document.getElementById('masking-permission');
                let formUnmaskingPermission = document.getElementById('unmasking-permission');
                activeForms = [formStoryPermission, formMaskingPermission, formUnmaskingPermission];
            }
        }   else if(color == 'gray') {
            if (userRole === 'Диспетчер') {
                let formStartWork = document.getElementById('start-work');
                let formFinishWork = document.getElementById('finish-work');
                let formActiveUnaskingPermission = document.getElementById('activeunmasking-permission');
                let completePermission = document.getElementById('completed-permission');
                activeForms = [formStoryPermission, formStartWork, formActiveUnaskingPermission, completePermission, formFinishWork];
            } else if (userRole === 'Автор') {
                let formPDFPermission = document.getElementById('pdf-permission');
                let formCreateByPermission = document.getElementById('create-by-permission');
                activeForms = [formStoryPermission, formCreateByPermission, formPDFPermission];
            } else if (userRole === 'Проверяющий инженер') {
                let formMaskingPermission = document.getElementById('check_masking-permission');
                let formCheckUnmaskingPermission = document.getElementById('check_unmasking-permission');
                activeForms = [formStoryPermission, formMaskingPermission, formCheckUnmaskingPermission];
            } else if (userRole === 'Сменный инженер') {
                let formMaskingPermission = document.getElementById('masking-permission');
                let formUnmaskingPermission = document.getElementById('unmasking-permission');
                activeForms = [formStoryPermission, formMaskingPermission, formUnmaskingPermission];
            }
        }  else if(color == 'pastel') {
            if (userRole === 'Диспетчер') {
                let dormRecoveryPermission = document.getElementById('recovery-permission');
                activeForms = [formStoryPermission, dormRecoveryPermission];
            } else if (userRole === 'Автор') {
                let formCreateByPermission = document.getElementById('create-by-permission');
                activeForms = [formStoryPermission, formCreateByPermission];
            } else if (userRole === 'Проверяющий инженер') {
                activeForms = [formStoryPermission];
            } else if (userRole === 'Сменный инженер') {
                activeForms = [formStoryPermission];
            }
        }
    }

    function showFormsFuncs() {
        activeForms.forEach(e => {
           e.classList.remove('hidden');
        });
    }
}

//Работа с массивом статусов
if(document.querySelector('.filter-content__statuses')) {
    let inputStatutes = document.querySelector('.filter-content__statuses');
    let inputsStatus = document.querySelectorAll('.filter-content__status-id');
    let button = document.querySelector('.apply-filter');
    let statutes = [];

    inputsStatus.forEach(e => {
       if(e.getAttribute('checked') === 'checked') {
           statutes.push(e.getAttribute('id'));
       }

       e.addEventListener('change', () => {
           if(e.getAttribute('checked') === 'checked') {
               let count = 0;

               inputsStatus.forEach(e => {
                   if(e.getAttribute('checked') === 'checked') {
                       count++;
                   }
               });

               if(count > 1) {
                   e.setAttribute('checked', '');

                   let i = statutes.indexOf(e.getAttribute('id'));
                   statutes.splice(i, 1);
               } else {
                   e.checked = true;
               }
           } else {
               e.setAttribute('checked', 'checked');
               statutes.push(e.getAttribute('id'));
           }
       });
    });

    button.addEventListener('click', (event) => {
        let count = 1;
        statutes.forEach(e => {
            if(count === 1) {
                inputStatutes.value = e;
            } else {
                inputStatutes.value = inputStatutes.value + ' ' + e;
            }

            count++;
        });
    })
}

//Устанавливаем фон строкам таблицы разрешений
if(document.querySelector('.table-permission__background')) {
    let tablePermissionColors = document.querySelectorAll('.table-permission__background');

    tablePermissionColors.forEach(e => {
        let cols = e.nextElementSibling.querySelectorAll('.table-permission__col');

        if(e.value === 'violet') {
            cols.forEach(e => {
                e.classList.add('table-permission__col_violet');
            })
        } else if(e.value === 'beige') {
            cols.forEach(e => {
                e.classList.add('table-permission__col_beige');
            })
        } else if(e.value === 'blue') {
            cols.forEach(e => {
                e.classList.add('table-permission__col_blue');
            })
        } else if(e.value === 'green') {
            cols.forEach(e => {
                e.classList.add('table-permission__col_green');
            })
        } else if(e.value === 'yellow') {
            cols.forEach(e => {
                e.classList.add('table-permission__col_yellow');
            })
        } else if(e.value === 'gray') {
            cols.forEach(e => {
                e.classList.add('table-permission__col_gray');
            })
        } else if(e.value === 'pastel') {
            cols.forEach(e => {
                e.classList.add('table-permission__col_pastel');
            })
        }
    });

    let tableWorkColors = document.querySelectorAll('.table-work__background');

    tableWorkColors.forEach(e => {
        let cell = e.nextElementSibling.nextElementSibling.querySelector('.table-permission__cell-work');

        if(e.value === 'violet') {
            delColor(cell);
            cell.classList.add('table-permission__col_violet');
        } else if(e.value === 'beige') {
            delColor(cell);
            cell.classList.add('table-permission__col_beige');
        }
    });

    let tableMaskColors = document.querySelectorAll('.table-mask__background');

    tableMaskColors.forEach(e => {
        let cell = e.nextElementSibling.nextElementSibling.nextElementSibling.querySelector('.table-permission__cell-mask');

        if(e.value === 'darkviolet') {
            delColor(cell);
            cell.classList.add('table-permission__col_darkviolet');
        } else if(e.value === 'orange') {
            delColor(cell);
            cell.classList.add('table-permission__col_orange');
        } else if(e.value === 'brown') {
            delColor(cell);
            cell.classList.add('table-permission__col_brown');
        } else if(e.value === 'darkgreen') {
            delColor(cell);
            cell.classList.add('table-permission__col_darkgreen');
        } else if(e.value === 'darkyellow') {
            delColor(cell);
            cell.classList.add('table-permission__col_darkyellow');
        } else if(e.value === 'darkblue') {
            delColor(cell);
            cell.classList.add('table-permission__col_darkblue');
        }
    });
}

function delColor(cell) {
    if(cell.classList.contains('table-permission__col_violet')) {
        cell.classList.remove('table-permission__col_violet');
    }else if(cell.classList.contains('table-permission__col_beige')) {
        cell.classList.remove('table-permission__col_beige');
    }else if(cell.classList.contains('table-permission__col_blue')) {
        cell.classList.remove('table-permission__col_blue');
    }else if(cell.classList.contains('table-permission__col_yellow')) {
        cell.classList.remove('table-permission__col_yellow');
    }else if(cell.classList.contains('table-permission__col_green')) {
        cell.classList.remove('table-permission__col_green');
    }else if(cell.classList.contains('table-permission__col_gray')) {
        cell.classList.remove('table-permission__col_gray');
    }else if(cell.classList.contains('table-permission__col_pastel')) {
        cell.classList.remove('table-permission__col_pastel');
    }
}

//Всплытие окна фактического времени изменения статуса разрешения и комментарий для диспетчера
if(document.querySelector('.permission__block-button')) {
    let blocks = document.querySelectorAll('.permission__block-button');

    blocks.forEach(block => {
        let buttonOpenWindow = block.querySelector('.button-content');
        let window = block.querySelector('.permission-status');
        let buttonCancel = block.querySelector('.permission-status__cancel');
        let inputDate = block.querySelector('.permission-status__date');
        let inputTime = block.querySelector('.permission-status__time');

        buttonOpenWindow.addEventListener('click', e => {
            let permissionId = +block.querySelector('.permission-status__id').value;

            if(permissionId > 0) {
                hiddenWindows();
                toggleWindow(window);
            }
        });

        buttonCancel.addEventListener('click', () => {
            toggleWindow(window);
        });

        function toggleWindow(window) {
            let currentDate = new Date();
            let year = currentDate.getFullYear();
            let month = currentDate.getMonth() + 1;
            let day = currentDate.getDate();
            let hour = currentDate.getHours();
            let minute = currentDate.getMinutes();

            month = setZero(month);
            day = setZero(day);
            hour = setZero(hour);
            minute = setZero(minute);

            inputDate.value = day +  "." + month + "." + year;
            inputTime.value = hour + ':' + minute;

            window.classList.toggle('permission-status_active');
        }

        function setZero(elem) {
            if(+elem < 10) {
                return '0' + elem;
            }

            return elem;
        }
    });
}

function hiddenWindows() {
    let windows = document.querySelectorAll('.permission-status');

    windows.forEach(e => {
        e.classList.remove('permission-status_active')
    });
}

//Пагинация
if(document.getElementById('num_page')) {
    let inputNumPage = document.getElementById('num_page');
    let inputsNumPages = document.querySelectorAll('.pagination__input');
    let formNumPagination = document.getElementById('form_num_page');

    inputsNumPages.forEach(e => {
        e.closest('.pagination__item').addEventListener('click', () => {
            inputNumPage.value = e.value;
            formNumPagination.submit();
        });
    })
}


if(document.querySelector('.masking-permission')){
    let buttonMaskingPermission = document.querySelector('.masking-permission');
    let formMasking = document.querySelector('.masking-submit');

    buttonMaskingPermission.addEventListener('click', () => {
        let forms = document.querySelectorAll('.masking-form');
        let currentId = document.querySelector('.row-id-process').value;

        forms.forEach((e) => {
            if(currentId == e.querySelector('.masking-text').value) {
                let button = e.closest('.masking-form').querySelector('.masking-submit');
                button.value = 'masking';
                button.click();
            }
        }) 
    });
}

if(document.querySelector('.unmasking-permission')){
    let buttonUnmaskingPermission = document.querySelector('.unmasking-permission');
    let formMasking = document.querySelectorAll('.masking-submit');
    formMasking.value = 'unmasking';

    buttonUnmaskingPermission.addEventListener('click', () => {
        let forms = document.querySelectorAll('.masking-form');
        let currentId = document.querySelector('.row-id-process').value;

        forms.forEach((e) => {
            if(currentId == e.querySelector('.masking-text').value) {
                let button = e.closest('.masking-form').querySelector('.masking-submit');
                button.value = 'unmasking';
                button.click();
            }
        }) 
    });
}

if(document.querySelector('.check_masking-permission')){
    let buttonCheckMaskingPermission = document.querySelector('.check_masking-permission');
    let formMasking = document.querySelector('.masking-submit');

    buttonCheckMaskingPermission.addEventListener('click', () => {
        let forms = document.querySelectorAll('.masking-form');
        let currentId = document.querySelector('.row-id-process').value;

        forms.forEach((e) => {
            if(currentId == e.querySelector('.masking-text').value) {
                let button = e.closest('.masking-form').querySelector('.masking-submit');
                button.value = 'check_masking';
                button.click();
            }
        }) 
    });
}

if(document.querySelector('.check_unmasking-permission')){
    let buttonCheckUnmaskingPermission = document.querySelector('.check_unmasking-permission');
    let formMasking = document.querySelector('.masking-submit');

    buttonCheckUnmaskingPermission.addEventListener('click', () => {
        let forms = document.querySelectorAll('.masking-form');
        let currentId = document.querySelector('.row-id-process').value;

        forms.forEach((e) => {
            if(currentId == e.querySelector('.masking-text').value) {
                let button = e.closest('.masking-form').querySelector('.masking-submit');
                button.value = 'check_unmasking';
                button.click();
            }
        }) 
    });
}