$(document).ready ( function () {
    $("#submit_registration").bind("click", function () {
        $.ajax ({
            url: "chek_reg.php",
            type: "POST",
            data: ({
                login: $("#login").val(),
                password: $("#password").val(),
                password2: $("#password2").val(),
                email: $("#email").val(),
                name: $("#name").val()
            }),
            dataType: "html",
            success: function (data) {
                if(data == '5') {

                    window.location.href = "index.php";
                }
                else {
                    var result1 = $('<div />').append(data).find('#111').html();
                    var result2 = $('<div />').append(data).find('#112').html();
                    var result3 = $('<div />').append(data).find('#113').html();
                    var result4 = $('<div />').append(data).find('#114').html();
                    var result5 = $('<div />').append(data).find('#115').html();
                    var result6 = $('<div />').append(data).find('#116').html();
                    var result7 = $('<div />').append(data).find('#117').html();
                    var result8 = $('<div />').append(data).find('#118').html();
                    var result9 = $('<div />').append(data).find('#119').html();
                    var result10 = $('<div />').append(data).find('#120').html();
                    var result11 = $('<div />').append(data).find('#121').html();

                    if(result1) res1.innerHTML = result1;
                    else{
                        if(result2) res1.innerHTML = result2;
                        else if(result10) res1.innerHTML = result10;
                        else res1.innerHTML = '';
                    }
                    if(result3) res2.innerHTML = result3;
                    else{
                        if(result4) res2.innerHTML = result4;
                        else res2.innerHTML = '';
                    }
                    if(result5) res3.innerHTML = result5;
                    else{
                        if(result6) res3.innerHTML = result6;
                        else res3.innerHTML = '';
                    }
                    if(result7) res4.innerHTML = result7;
                    else{
                        if(result8) res4.innerHTML = result8;
                        if(result11) res4.innerHTML = result11;
                        else res4.innerHTML = '';
                    }
                    if (result9) res5.innerHTML = result9;
                    else res5.innerHTML = '';
                }
            }
        });
    });

    $("#submit_enter").bind("click", function () {
        $.ajax ({
            url: "chek_log.php",
            type: "POST",
            data: ({login: $("#login1").val(), password: $("#password1").val()}),
            dataType: "html",
            success: function (data) {
                if(data == '1') {

                    window.location.href = "index.php";
                }
                else{
                    // if($('<font />').append(data).find('#111').html()){
                    //     res.innerHTML = result;
                    // }
                    var result30 = $('<div />').append(data).find('#130').html();
                    var result40 = $('<div />').append(data).find('#140').html();
                    var result31 = $('<div />').append(data).find('#131').html();
                    var result41 = $('<div />').append(data).find('#141').html();

                    if(result30) res11.innerHTML = result30;
                    else{
                        if(result31) res11.innerHTML = result31;
                        else res11.innerHTML = '';
                    }
                    if(result40) res12.innerHTML = result40;
                    else{
                        if(result41) res12.innerHTML = result41;
                        else res12.innerHTML = '';
                    }
                }
            }
        });
    });
});
