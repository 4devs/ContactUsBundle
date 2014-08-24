$(function () {

    var formId = 'f_devs_contact_us_message';
    $("input,textarea").jqBootstrapValidation({
        preventSubmit: true,
        submitError: function ($form, event, errors) {
            // additional error messages or events
        },
        submitSuccess: function ($form, event) {
            event.preventDefault(); // prevent default submit behaviour
            var firstName = $("#" + formId + "_name").val();

            if (firstName.indexOf(' ') >= 0) {
                firstName = name.split(' ').slice(0, -1).join(' ');
            }
            //$("#f_devs_contact_us_message").submit()

            $.ajax({
                url: $("#" + formId).attr('action'),
                type: "POST",
                data: $("#" + formId).serialize(),
                cache: false,
                success: function (data) {
                    if (data.status == 'error') {
                        $.each(data.error, function (index, value) {
                            var helpBlock = $('#' + formId + '_' + index).next();
                            var html = '<ul>';
                            for (var key in value) {
                                html += '<li>' + value[key] + '</li>';
                            }
                            html += '</ul>';
                            helpBlock.html(html);
                        });
                    } else {
                        // Success message
                        $('#success').html("<div class='alert alert-success'>");
                        $('#success > .alert-success').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
                            .append("</button>");
                        $('#success > .alert-success')
                            .append("<strong>" + data.message + "</strong>");
                        $('#success > .alert-success')
                            .append('</div>');

                        //clear all fields
                        $('#' + formId).trigger("reset");
                    }
                },
                error: function () {
                    // Fail message
                    $('#success').html("<div class='alert alert-danger'>");
                    $('#success > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
                        .append("</button>");
                    $('#success > .alert-danger').append("<strong>Sorry " + firstName + ", it seems that my mail server is not responding. Please try again later!");
                    $('#success > .alert-danger').append('</div>');
                    //clear all fields
                    $('#' + formId).trigger("reset");
                }
            })
        },
        filter: function () {
            return $(this).is(":visible");
        },
    });

    $("a[data-toggle=\"tab\"]").click(function (e) {
        e.preventDefault();
        $(this).tab("show");
    });
});


/*When clicking on Full hide fail/success boxes */
$('#name').focus(function () {
    $('#success').html('');
});
