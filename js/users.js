
$(document).ready(function(){

	$('#add_new_user').click(function() {

      if($('#new_user_name').val() &&$('#new_user_email').val() && $('#new_user_pass').val() && $('#new_user_pass_again').val()){

          if((/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/.test($( "#new_user_email" ).val()))) {

              if($('#new_user_pass').val() == $('#new_user_pass_again').val()){

                  $.ajax({
                      type:'post',
                      dataType:'json',
                      data:{
                          'name'		:   $( "#new_user_name" ).val(),
                          'email'		:   $( "#new_user_email" ).val(),
                          'pass'		:   $( "#new_user_pass" ).val(),
                      },
                      url:site_url+'/felhasznalok/save_new_user',
                      success:function(dat){
                          if(dat.success){

                            location.reload();

                          }else {
                              alertify.error(dat.msg);
                          }
                      }
                  })

              } else {
                  alertify.error(error_invalid_passwords);
              }

          } else {
              alertify.error(error_invalid_email);
          }

      } else {
          alertify.error(error_empty_field);
      }
  });

    $('.delete_ico').on('click', function(e){
        e.preventDefault();
        if(confirm(question_delete_user)){

            var user_id = $(this).attr('data-id');

            $.ajax({
                type:'post',
                dataType:'json',
                data:{
                    'user_id'		:   user_id,
                },
                url: site_url+'/felhasznalok/delete_user',
                success:function(dat){
                    if(dat.success){

                      $('.users_table tr[data-index="'+user_id+'"]').hide();

                      if(dat.count == 0){
                        var html = '<tr class="empty_row transit">';
                        html +=  '<td colspan="3">';
                        html +=  empty_user_row;
                        html +=  '</td>';
                        html +=  '</tr>';

                        $('.users_table tbody').append(html);
                      }

                      alertify.success(dat.msg);

                    }else {
                        alertify.error(dat.msg);
                    }
                }
            })
        }
    });

});
