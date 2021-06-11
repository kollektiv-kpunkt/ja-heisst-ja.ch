$(".ajax-form").submit( function(e){
    e.preventDefault()
    let formData = $(this).serialize()
    let interface = $(this).attr("data-interface")
    let nextStep = parseInt($(this).attr("data-step")) + 1
    let nextForm = $(`form[data-step=${nextStep}]`)
    let thisForm = $(this);
    $.ajax({
        url : `/interfaces/${interface}`,
        type: "POST",
        data : formData,
        success: function(response, textStatus, jqXHR) {
            console.log(response);
            if (response.code == 200) {
                thisForm.css("display", "none")
                nextForm.css("display", "flex")
                nextForm.children("input[name='uuid']").val(response.uuid)
                thisForm.siblings(".alert").css("display", "none")
            } else {
                thisForm.siblings(".alert").addClass(response.type)
                thisForm.siblings(".alert").html(response.text)
                thisForm.siblings(".alert").css("display", "block")
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(jqXHR);
            console.log(textStatus);
            console.log(errorThrown);
            thisForm.siblings(".alert").addClass("error")
            thisForm.siblings(".alert").html("Something went wrong. Please try again")
            thisForm.siblings(".alert").css("display", "block")

        }
    });
})