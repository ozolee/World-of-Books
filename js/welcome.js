
$(document).ready(function(){

    $('#login_button').click(function() {
       login();
    });


    $('#login_pass').keypress(function(e) {
        if(e.which == 10 || e.which == 13) {
            login();
        }
    });


});

function login(){
    if($('#login_email').val() && $('#login_pass').val()){

            if((/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/.test($( "#login_email" ).val()))) {

                $.ajax({
                    type:'post',
                    dataType:'json',
                    data:{
                        'email'		:   $( "#login_email" ).val(),
                        'pass'		:   $( "#login_pass" ).val(),
                    },
                    url: site_url+'/welcome/login',
                    success:function(dat){
                        if(dat.success){

                          window.location = site_url+'/felhasznalok';

                        }else {
                            alertify.error(dat.msg);
                        }
                    }
                })

            } else {
                alertify.error('Érvénytelen e-mail cím!');
            }

        } else {
            alertify.error('Minden mező kitöltése kötelező!');
        }
}
