function career_scroll(){
    //alert($("#career").scrollTop());
    var offset = 180;
    var target = $("#career").offset().top - offset;
    $('html, body').animate({
        scrollTop: target
    }, 500);
    event.preventDefault();
}
$(document).ready(function() {
    // $('html, body').animate({
    //                     scrollTop: $("#career_scroll").offset().top
    //                 }, 1000);
    //var id = $(this).attr("#career_scroll");
    event.preventDefault();
    $("#remove_cert").click(function () {
        //alert("hello");
        //$('#cert_items').fadeOut();
        $("#cert_items .form-group").last().remove();
        $("#cert_items .form-group").last().remove();
        $("#cert_items hr").last().remove();
    });
    $("#remove_sc").click(function () {
        //alert("hello");
        //$('#cert_items').fadeOut();
        $("#sc_items .form-group").last().remove();
        $("#sc_items .form-group").last().remove();
        $("#sc_items hr").last().remove();
    });
    $(".showdata").show();
    $("#cnic , #answer").keyup(function() {
        //alert($("#cnic").val() + $("#secretquestion").val() + $("#answer").val() );
        // var name=$(".example").val();
        // var testdata = 'query='+name;
        var form_data={'cnic':$('#cnic').val() , 'sq':$('#secretquestion').val() , 'answer':$('#answer').val()};
        $.ajax({
            type:'POST',
            dataType:'json',
            data:form_data,
            url:"../switch2itech/checkcv.php",
            success:function(info){
                if(info.result == 'yes'){
                    $('.showresult').html('Click here to edit already submitted cv');
                    $("#editcv").fadeIn();
                    $('.showresult').css("color","red");
                    $('.showresult').css("font-size","15px");
                    $("#copy-cnic").val($("#cnic").val());
                    $("#copy-sq").val($("#secretquestion").val());
                    $("#copy-answer").val($("#answer").val());
                    $("#start_btn").hide();
                    var newurl= "cvdetail.php?id="+info.id;
                    $("#savecv").show();
                    $('#savecv').attr('href', newurl);
                }
                else{
                    $('.showresult').html('');
                    $("#editcv").fadeOut();
                    $("#copy-cnic").val("");
                    $("#copy-sq").val("");
                    $("#copy-answer").val("");
                    $("#savecv").hide();
                    $("#start_btn").fadeIn();

                }

            }

        });
    });
    $("#secretquestion").change(function() {
        //var form_data={'program':$('#program').val()};
        //alert($("#cnic").val() + $("#secretquestion").val() + $("#answer").val() );
        // var name=$(".example").val();
        // var testdata = 'query='+name;
        var form_data={'cnic':$('#cnic').val() , 'sq':$('#secretquestion').val() , 'answer':$('#answer').val()};
        $.ajax({
            type:'POST',
            dataType:'json',
            data:form_data,
            url:"../switch2itech/checkcv.php",
            success:function(info){
                if(info.result == 'yes'){
                    $('.showresult').html('Click here to edit already submitted cv');
                    $("#editcv").fadeIn();
                    $('.showresult').css("color","red");
                    $('.showresult').css("font-size","15px");
                    $("#copy-cnic").val($("#cnic").val());
                    $("#copy-sq").val($("#secretquestion").val());
                    $("#copy-answer").val($("#answer").val());
                    $("#start_btn").hide();
                    var newurl= "cvdetail.php?id="+info.id;
                    $("#savecv").show();
                    $('#savecv').attr('href', newurl);
                }
                else{
                    $('.showresult').html('');
                    $("#editcv").fadeOut();
                    $("#copy-cnic").val("");
                    $("#copy-sq").val("");
                    $("#copy-answer").val("");
                    $("#savecv").hide();
                    $("#start_btn").fadeIn();

                }

            }

        });
    });
    $( "#editcv" ).click(function() {
        $( "#hidden-form" ).submit();
    });
    $('[data-toggle="tooltip"]').tooltip();
    $(".validate_cnic").keypress(function(event) {
        var cnic_len= $(this).val().length;
        var cnic_val= $(this).val();
        if(cnic_len == 5 || cnic_len == 13 ){
            $(this).val( cnic_val + "-");
        }
        if(cnic_len > 14){
            return false;
        }
    });
    $('#job_checkbox').change(function(){
        $("#jobinfo").slideToggle();
    });
    $('#matric_checkbox').change(function(){
        $("#matric_section").slideToggle();
    });
    $('#inter_checkbox').change(function(){
        $("#inter_section").slideToggle();
    });
    $('#bm_checkbox').change(function(){
        $("#bm_section").slideToggle();
    });
    $('#ms_checkbox').change(function(){
        $("#ms_section").slideToggle();
    });
    $('#cert_checkbox').change(function(){
        $("#cert_section").slideToggle();
    });
    $('#sc_checkbox').change(function(){
        $("#sc_section").slideToggle();
    });
    $("#add_cert").click(function (e) {
        $("#cert_items").append('<div class="form-group"> <label class="col-md-2 control-label">Name</label> <div class="col-md-3 inputGroupContainer"> <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-education"></i></span> <input name="cert_name[]" placeholder="city" class="form-control" type="text"> </div> </div> <label class="col-md-3 control-label">Duration</label> <div class="col-md-3 inputGroupContainer"> <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-education"></i></span> <input name="cert_duration[]" placeholder="city" class="form-control" type="text"> </div> </div> </div> <div class="form-group"> <label class="col-md-2 control-label">Institute</label> <div class="col-md-3 inputGroupContainer"> <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-education"></i></span> <input name="cert_institute[]" placeholder="city" class="form-control" type="text"> </div> </div> <label class="col-md-3 control-label">Year</label> <div class="col-md-3 inputGroupContainer"> <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-education"></i></span> <input name="cert_year[]" placeholder="city" class="form-control" type="text"> </div> </div> </div><hr>'); });
    $("#add_sc").click(function (e) {
        $("#sc_items").append('<div class="form-group"> <label class="col-md-2 control-label">Name</label> <div class="col-md-3 inputGroupContainer"> <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-education"></i></span> <input name="sc_name[]" placeholder="city" class="form-control" type="text"> </div> </div> <label class="col-md-3 control-label">Duration</label> <div class="col-md-3 inputGroupContainer"> <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-education"></i></span> <input name="sc_duration[]" placeholder="city" class="form-control" type="text"> </div> </div> </div> <div class="form-group"> <label class="col-md-2 control-label">Institute</label> <div class="col-md-3 inputGroupContainer"> <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-education"></i></span> <input name="sc_institute[]" placeholder="city" class="form-control" type="text"> </div> </div> <label class="col-md-3 control-label">Year</label> <div class="col-md-3 inputGroupContainer"> <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-education"></i></span> <input name="sc_year[]" placeholder="city" class="form-control" type="text"> </div> </div> </div><hr>'); });
    $("#start_btn").click(function () {
        setTimeout(function (){
            $("#front_controller").slideUp();
        }, 1);

        setTimeout(function (){
            $("#loadinggif").css('display','block');
        }, 800);
        setTimeout(function (){
            $("#loadinggif").css('display','none');
        }, 1500);
        setTimeout(function (){
            $("#cv_content").slideDown();
        }, 1501);


    });

    $("#myCarousel").carousel({
        interval: 1e4
    }),

        /*navigation fixed effact on scrll down*/
        $(window).bind('scroll', function() {

            if ($(window).scrollTop() > 50) {
                $('.header-top').addClass('none', {
                    duration: 500
                });

            } else {
                $('.header-top').removeClass('none', {
                    duration: 500
                });
            }

        });
    $(".loadmore").click(function(){
        $(".load").toggle('slow');
    });

    /*navigation fixed effact on scrll down*/
    $(window).bind('scroll', function() {

        if ($(window).scrollTop() > 50) {
            $('.header').addClass('cust-fixed', {
                duration: 500
            });

        } else {
            $('.header').removeClass('cust-fixed', {
                duration: 500
            });
        }

    });
    $('#quote-carousel').carousel({
        pause: true,
        interval: 4000,
    });
    $('a[href^="#"]').click(function(event) {
        var id = $(this).attr("href");
        var offset = 20;
        var target = $(id).offset().top - offset;
        $('html, body').animate({scrollTop:target}, 1000);
        event.preventDefault();
    });

    // Show or hide the sticky footer button
    $(window).scroll(function() {
        if ($(this).scrollTop() > 200) {
            $('.go-top').fadeIn(500);
        } else {
            $('.go-top').fadeOut(300);
        }
    });

    // Animate the scroll to top
    $('.go-top').click(function(event) {
        event.preventDefault();

        $('html, body').animate({
            scrollTop: 0
        }, 300);
    })


    $(".SeeMore2").click(function() {
        var e = $(this);
        e.toggleClass("SeeMore2"), e.hasClass("SeeMore2") ? e.text("Read More") : e.text(" Less")
    })
    $(document).ready(function() {
        $('#contact_form').bootstrapValidator({
                // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    first_name: {
                        validators: {
                            stringLength: {
                                min: 2,
                            },
                            notEmpty: {
                                message: 'Please supply your first name'
                            }
                        }
                    },
                    last_name: {
                        validators: {
                            stringLength: {
                                min: 2,
                            },
                            notEmpty: {
                                message: 'Please supply your last name'
                            }
                        }
                    },
                    email: {
                        validators: {
                            notEmpty: {
                                message: 'Please supply your email address'
                            },
                            emailAddress: {
                                message: 'Please supply a valid email address'
                            }
                        }
                    },
                    phone: {
                        validators: {
                            notEmpty: {
                                message: 'Please supply your phone number'
                            },
                            phone: {
                                country: 'US',
                                message: 'Please supply a vaild phone number with area code'
                            }
                        }
                    },
                    address: {
                        validators: {
                            stringLength: {
                                min: 8,
                            },
                            notEmpty: {
                                message: 'Please supply your street address'
                            }
                        }
                    },
                    city: {
                        validators: {
                            stringLength: {
                                min: 4,
                            },
                            notEmpty: {
                                message: 'Please supply your city'
                            }
                        }
                    },
                    state: {
                        validators: {
                            notEmpty: {
                                message: 'Please select your state'
                            }
                        }
                    },
                    zip: {
                        validators: {
                            notEmpty: {
                                message: 'Please supply your zip code'
                            },
                            zipCode: {
                                country: 'US',
                                message: 'Please supply a vaild zip code'
                            }
                        }
                    },
                    comment: {
                        validators: {
                            stringLength: {
                                min: 10,
                                max: 200,
                                message:'Please enter at least 10 characters and no more than 200'
                            },
                            notEmpty: {
                                message: 'Please supply a description of your project'
                            }
                        }
                    }
                }
            })
            .on('success.form.bv', function(e) {
                $('#success_message').slideDown({ opacity: "show" }, "slow") // Do something ...
                $('#contact_form').data('bootstrapValidator').resetForm();

                // Prevent form submission
                e.preventDefault();

                // Get the form instance
                var $form = $(e.target);

                // Get the BootstrapValidator instance
                var bv = $form.data('bootstrapValidator');

                // Use Ajax to submit form data
                $.post($form.attr('action'), $form.serialize(), function(result) {
                    console.log(result);
                }, 'json');
            });
    });


});