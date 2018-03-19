$(document).ready(function() {
    var $feedbackForm = $('.feedback-form'),
        $emailInput = $feedbackForm.find('input'),
        $textAreaInput = $feedbackForm.find('textarea'),
        $alert = $('.form-alert');
    
    $feedbackForm.on('submit', function(event) {
        event.preventDefault();
        var valid = $emailInput.val() != '' && $textAreaInput.val() != '';

        $.post('/edit', $feedbackForm.serialize())
            .done(function(r) {
                location.reload();
            })
            .fail(function(r) {
                $alert.removeClass('alert-success').addClass('alert-danger').text(r.responseJSON.message);
            })
        ;
    });
});
