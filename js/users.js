    
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
                            url:'adminok/save_new_admin',
                            success:function(dat){
                                if(dat.success){

                                  location.reload();

                                }else {
                                    alertify.error(dat.msg); 
                                }
                            }
                        })
                        
                    } else {
                        alertify.error('A két jelszónak meg kell egyeznie!');
                    }

                } else {
                    alertify.error('Érvénytelen e-mail cím!');
                }
                
            } else {
                alertify.error('Minden mező kitöltése kötelező!');
            }
        });
        
        $('.delete_ico').on('click', function(e){
            e.preventDefault();
            if(confirm('Valóban törlöd ezt az admint?')){
                
                var user_id = $(this).attr('data-id');
                
                $.ajax({
                    type:'post',
                    dataType:'json',
                    data:{
                        'user_id'		:   user_id,
                    },
                    url:'adminok/delete_admin',
                    success:function(dat){
                        if(dat.success){

                          $('.users_table tr[data-index="'+user_id+'"]').hide();
                          
                          if(dat.count == 0){
                            var html = '<tr class="empty_row transit">';
                            html +=  '<td colspan="3">';
                            html +=  'Nincs még admin felvéve';                              
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


