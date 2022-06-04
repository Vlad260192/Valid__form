$(document).ready(function () {
    $('select').niceSelect ();
});

"use strict"

document.addEventListener('DOMContentLoaded',function() {
    const form = document.getElementById('form');
    form.addEventListener('submit', formSend);

    async function formSend(e) {
        e.preventDefault();

        let error = formValidate(form);

        if (error===0) {

        }else{
            alert('Заповніть обовʼязкові поля');
        }
    }

    function formValidate(form) {
        let error = 0;
        let formReq = document.querySelectorAll('._req');
        
        for (let index = 0; index < formReq.length; index++) {
            const input = formReq[index];
            formRemoveError(input);

            if(input.classList.contains('_email')) {
                if (emailTest(input)) {
                    formAddError(input);
                    error++;
                }
            }else if(input.getAttribute("type") === "checkbox" && input.checked === false) {
                formAddError(input);
                error++;
            }else {
                if (input.value === '') {
                    formAddError(input);
                    error++;
                }
            }
        }
        return error;
    }
    function formAddError(input) {
        input.parentElement.classList.add('_error');
        input.classList.add('_error');
    }
    function formRemoveError(input) {
        input.parentElement.classList.remove('_error');
        input.classList.remove('_error');
    }

    // Функція тесту email
    function emailTest(input) {
        return !/^\w+([\.-]\w+)*@\w+([\.-]?\w+)*(\.\w{2,8})+$/.test(input.value);
    }

    // Отримуємо input file в змінну
    const formImage = document.getElementById('formImage');
    // Отримуємо div для preview в змінну
    const formPreview = document.getElementById('formPreview');
});