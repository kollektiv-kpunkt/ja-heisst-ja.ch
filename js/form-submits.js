// $('#sign_step1').submit( function(e) {
//     e.preventDefault();
//     alert("App is currently deactivated: It will be launched on Monday at 5PM");
// });

$('#sign_step1').one('submit', function(e) {
    e.preventDefault();
    var formData = $(this).serialize();
    axios({
        method: 'POST',
        url: '/support/app/1.php',
        data: formData
    })
    .then(function (response) {
        console.log(response.data);
        if (response.data == "Good") {
            $('#sign_step1').submit();
        } else if (response.data == "403") {
            $("#403error").css({"display" : "block"})
        }
    })
    .catch(function (error) {
        console.log(error);
    });
});


$('#sign_step2').submit(function(e) {
    e.preventDefault();
    var checkval = document.getElementById("sign_step2").reportValidity();
    var formData = $(this).serialize();
    if (checkval == true) {
        axios({
            method: 'POST',
            url: '/support/app/2.php',
            data: formData
        })
        .then(function (response) {
            console.log(response.data);
            if (response.data == "Good") {
                document.getElementById("email-data").classList.add("is-active");
            }
        })
        .catch(function (error) {
            console.log(error);
        });
    }
});

$('#sign_step3').submit(function(e) {
    e.preventDefault();
    var checkval = document.getElementById("sign_step3").reportValidity();
    tinymce.triggerSave();
    var formData = $(this).serialize();
    if (checkval == true) {
        axios({
            method: 'POST',
            url: '/support/app/3.php',
            data: formData
        })
        .then(function (response) {
            console.log(response.data);
            if (response.data == 1) {
                document.getElementById("errormsg").style.display = "unset";
            }
            if (response.data == "Good") {
                document.getElementById("end-screen").classList.add("is-active");
            }
        })
        .catch(function (error) {
            console.log(error);
        });
    }
});

$('#back_step3').click(function(){
    document.getElementById("email-data").classList.remove("is-active");
});

// $('#sign_step4').submit(function(e) {
//     e.preventDefault();
//     var checkval = document.getElementById("sign_step4").reportValidity();
//     var formData = $(this).serialize();
//     if (checkval == true) {
//         axios({
//             method: 'POST',
//             url: '/support/app/4.php',
//             data: formData
//         })
//         .then(function (response) {
//             console.log(response.data);
//             if (response.data == "Good") {
//                 document.getElementById("end-screen").classList.add("is-active");
//             }
//         })
//         .catch(function (error) {
//             console.log(error);
//         });
//     }
// });

// $('#back_step4').click(function(){
//     document.getElementById("reasons-data").classList.remove("is-active");
// });

$('#sign_step5').submit(function(e) {
    e.preventDefault();
    var formData = $(this).serialize();
    axios({
        method: 'POST',
        url: '/support/app/send.php',
        data: formData
    })
    .then(function (response) {
        console.log(response.data);
        if (response.data == "Good") {
            window.location.replace("/?" + formData);
        }
    })
});

$('#back_step5').click(function(){
    document.getElementById("end-screen").classList.remove("is-active");
});