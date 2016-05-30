$(document).ready(function () {

    $("#question_add #question").keyup(function () {

        var empty = false;
        $('#question_add #question').each(function () {
            if ($(this).val().length == 0) {
                empty = true;
            }
        });

        if (!empty) {

            $('#question_add #add_question').removeAttr('disabled');
            $('#question_add #confirm').prop('disabled', true);
        } else {
            $('#question_add #confirm').removeAttr('disabled');
        }
    });

});
