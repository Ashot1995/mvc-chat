$(document).ready(function () {
    //login

    $('.ex-login').submit(function (event) {
        event.preventDefault();
        if ($(".login").val() == "" && $(".password").val() == "") {
            $("#loginErr").text("Please insert empty inputs")
        } else {
            $.ajax({
                type: $(this).attr('method'),
                url: "postlogin",
                data: $("form").serializeArray(),
                dataType: 'JSON',
                success: function (data) {
                    if (data['success'] == false) {

                        $('#loginErr').html(data['errorMessage']).css("color", "red");
                    } else {
                        window.location.href = "/chat";

                    }
                },
            });
        }
    });


//valid username
    var $regexname = /^([a-zA-Z0-9]{2,21})$/;
    $('#username').on('keypress keydown keyup', function () {

        if (!$(this).val().match($regexname)) {
            $('.emsg').html('Please enter minimum 3 letters').css('color', 'red');
            $('#sub').attr("disabled", "disabled")
        }
        else {
            $('#sub').attr("disabled", false)
            $('.emsg').html('Username matches').css('color', 'green');
        }

    });


//email validation

    $('#email').on('keypress keydown keyup', function () {
        var $pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;

        if (!$(this).val().match($pattern)) {
            $('.erremail').html('Please enter validate email').css('color', 'red');
            $('#sub').attr("disabled", "disabled")

        } else {
            $('#sub').attr("disabled", false)
            $('.erremail').html('Email matches').css('color', 'green');
        }

    });

    //valid password

    $('#password, #confirmPass').on('keypress keydown keyup', function () {
        if ($('#password').val() == $('#confirmPass').val()) {
            $('#sub').attr("disabled", false);
            $('#error').html('Password matches').css('color', 'green');
        } else {
            $('#sub').attr("disabled", "disabled");
            $('#error').html('\n' +
                'Password does not match').css('color', 'red');

        }
    });


//registration

    $('form.ex-register').submit(function (event) {
        if ($('#username').val() == "" && $('#email').val() == "" && $('#password').val() == "") {
            $("#regerr").text("Please insert empty inputs")
        } else {
            event.preventDefault();
            $.ajax({
                type: $(this).attr('method'),
                url: "postregister",
                data: $("form").serializeArray(),
                dataType: 'JSON',
                success: function (data) {
                    if (data["success"]) {
                        window.location.href = "/chat";
                    } else {
                        $("#regerr").html(data["errorMessage"]).css("color", "red")

                    }

                },
            });
        }

    });


//insert and select group chat data

    $('#btn').click(function () {
        if ($.trim($('#message').val()) == ""  || $("#message").val()=="  ") {
            $(".errmess").text("Please insert message").css("color","red");
        } else {
            $(".errmess").text(" ")
            var message = {'message': ($.trim($('#message').val()))};
            $.ajax({
                type: "post",
                url: "postmessage",
                data: message,
                dataType: "json",
                success: function (data) {
                    setInterval(function () {
                        $.ajax({
                            type: "post",
                            url: "postmessage",
                            data: "",
                            dataType: 'json',
                            success: function (data) {
                                console.log($("#message").text())
                                $(".messText").remove();
                                for (var i = 0; i < data[0].length; i++) {

                                    $("#text").append('<p class="messText">' + htmlspecialchars(data[0][i]["text"]) + '</p>')
                                }


                            }
                        });
                    }, 3000);
                    $("#message").val(" ");
                    $("#text").append('<p class="messText">' + htmlspecialchars(data[0]["text"]) + '</p>');

                    $("#text").animate({scrollTop: 9999}, 1001);

                },

            });
        }


    });


//logout

    $("#ex_logout").click(function () {
        $.ajax({
            type: "post",
            url: "postlogout",
            data: "",
            success: function () {
                window.location.href = "/chat/login";

            }
        })
    });

});


//select data in group chat
$(window).load(function () {
    $("#text").animate({scrollTop: 9999}, 1001);
    $.ajax({
        type: "post",
        url: "postmessage",
        data: "",
        dataType: 'json',
        success: function (data) {
            $("#yourname").html(data[2][0]['username'])
            for (var i = 0; i < data[1].length; i++) {
                $(".users").append('<li><a href="#" onclick="showDetails(event)" class="musers"  id="' + data[1][i]["id"] + '">' + data[1][i]["username"] + '</a></li>')
                if ($(".musers")[i].id === data[2][0]['id']) {
                    $("#" + data[2][0]['id']).css("color", "red")

                }
            }
                for (var i = 0; i < data[0].length; i++) {
                    $("#text").append('<p class="messText">' + htmlspecialchars(data[0][i]["text"]) + '</p>')
                }

        }
    });


})



//open personal chat and select data

function showDetails(e) {
    user_id = e.target.id;
    $("#usern").text(e.srcElement.textContent);
    $("#text1 .messText").remove();
    $("#text1").animate({scrollTop: 9999}, 1);
    $(".messText1").remove();
    $(".dhide1").show();
    var message1 = {
        'persmessage': "",
        'user_id': user_id
    };

    $.ajax({
        type: "post",
        url: "postpersmessage",
        data: message1,
        dataType: 'json',
        success: function (data) {
            $(".messText1").remove();
            for (var i = 0; i < data.length; i++) {
                $("#text1").append('<p class="messText1">' + htmlspecialchars(data[i]["pers_text"]) + '</p>')
            }
        }
    });
}

//insert and select personal message

$("#persbtn").click(function () {
    $("#text1").animate({scrollTop: 9999}, 1);

    var message1 = {
        'persmessage': $.trim($('#message1').val()),
        'user_id': user_id
    };


        if ($.trim($('#message1').val()) == "" || $("#message1").val()=="  " ) {
            $(".errmess1").text("Please insert message").css("color","red");
        } else {
            $(".errmess1").text(" ")
        $.ajax({
            type: "post",
            url: "postpersmessage",
            data: message1,
            dataType: 'json',
            success: function (data) {
                $("#message1").val(" ");
                for (var i = 0; i < data.length; i++) {
                    $("#text1").append('<p class="messText1">' + htmlspecialchars(data[i]["pers_text"]) + '</p>')
                }
            }
        });

    }
});
//delete personal chat(div)

$(".delete").click(function () {
    $(".dhide").hide();
    $(".open").show();
});

$("#delete1").click(function () {
    $(".dhide1").hide();
});
//open in group chat
$(".open").click(function () {
    $(".dhide").show();
});

function htmlspecialchars(text) {
    return text
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#039;");
}