$(() => {
    $('#form-user-pjax').on('click', '.user-save', function () {
        jQuery(function ($) {
            jQuery('#form-user').yiiActiveForm([
                {
                    "id": "user-name",
                    "name": "name",
                    "container": ".field-user-name",
                    "input": "#user-name",
                    "validate": function (attribute, value, messages, deferred, $form) {
                        yii.validation.required(value, messages, {"message": "Необходимо заполнить «Имя»."});
                    }
                },
                {
                    "id": "user-surname",
                    "name": "surname",
                    "container": ".field-user-surname",
                    "input": "#user-surname",
                    "validate": function (attribute, value, messages, deferred, $form) {
                        yii.validation.required(value, messages, {"message": "Необходимо заполнить «Фамилия»."});
                    }
                },
                {
                    "id": "user-patronymic",
                    "name": "patronymic",
                    "container": ".field-user-patronymic",
                    "input": "#user-patronymic",
                    "validate": function (attribute, value, messages, deferred, $form) {
                        yii.validation.required(value, messages, {"message": "Необходимо заполнить «Отчество»."});
                    }
                }
            ], []);

            // Применение класса для подсветки ошибки
            if ($('#user-name').val() === '') {
                $('#user-name').addClass('is-invalid');
            } else {
                $('#user-name').removeClass('is-invalid');
            }

            if ($('#user-surname').val() === '') {
                $('#user-surname').addClass('is-invalid');
            } else {
                $('#user-surname').removeClass('is-invalid');
            }

            if ($('#user-patronymic').val() === '') {
                $('#user-patronymic').addClass('is-invalid');
            } else {
                $('#user-patronymic').removeClass('is-invalid');
            }
        });
    });
});
