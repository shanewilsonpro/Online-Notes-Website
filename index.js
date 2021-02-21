
//sign up form once form is submitted
$("#signupform").submit(function (event) {
    event.preventDefault();

    var datatopost = $(this).serializeArray();

    console.log(datatopost);

    $.ajax({
        url: "signup.php",
        type: "POST",
        data: datatopost,
        success: function (data) {
            if (data) {
                $("#signupmessage").html(data);
            }
        },
        error: function () {
            $("#signupmessage").html("<div class='alert alert-danger'>There was an error with the Ajax Call. Please try again later.</div>");
        }
    });
});