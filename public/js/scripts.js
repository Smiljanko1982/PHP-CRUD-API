$(function(){


    $("#register_email").on('change', function(){


    var email = $(this).val();



    $.post("ajax_functions.php", {email : email}, function(data){

    

        $(".db-feedback").html(data);

    });




    });

   





    // $('#login-form-link').click(function(e) {
    //     $("#login-form").delay(100).fadeIn(100);
    //     $("#register-form").fadeOut(100);
    //     $('#register-form-link').removeClass('active');
    //     $(this).addClass('active');
    //     e.preventDefa                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          