$(document).ready(function(){

  var chose_page = 0;
  var offset = 0;

  var prevprev = 0;
  var prev = 0;
  var next = 0;
  var nextnext = 0;

  $(document).on("click",".pagination li", function(){
    var max_page = Number(TotalPages - 2);
    if($(this).hasClass('number_li')){
      chose_page = $(this).attr('data-id');
      if(chose_page <= 3){
        click_pagination_li(chose_page,limit,max_page);
      } else if(chose_page >= max_page){
        click_pagination_li(chose_page,limit,max_page);
      } else {
        prevprev = Number(chose_page - 2);
        prev = Number(chose_page - 1);
        next = parseInt(chose_page) + 1;
        nextnext = parseInt(chose_page) + 2;
        $('.pagination li.number_li').addClass('hidden_li');
        $('.pagination li[data-id="'+prevprev+'"]').removeClass('hidden_li');
        $('.pagination li[data-id="'+prev+'"]').removeClass('hidden_li');
        $('.pagination li[data-id="'+chose_page+'"]').removeClass('hidden_li');
        $('.pagination li[data-id="'+next+'"]').removeClass('hidden_li');
        $('.pagination li[data-id="'+nextnext+'"]').removeClass('hidden_li');
        click_pagination_li(chose_page,limit,max_page);
      }

    } else {
      if($(this).hasClass('first_page')){
          $('.pagination li.number_li').addClass('hidden_li');
          $('.pagination li[data-id="1"]').removeClass('hidden_li');
          $('.pagination li[data-id="2"]').removeClass('hidden_li');
          $('.pagination li[data-id="3"]').removeClass('hidden_li');
          $('.pagination li[data-id="4"]').removeClass('hidden_li');
          $('.pagination li[data-id="5"]').removeClass('hidden_li');
          click_pagination_li(1,limit,max_page);
      } else if(($(this).hasClass('previous_page')) && (!$(this).hasClass('deactivate_li'))){
        chose_page = Number ($('.pagination .actual_page').attr('data-id') - 1);
        prevprev = Number(chose_page - 2);
        prev = Number(chose_page - 1);
        next = parseInt(chose_page) + 1;
        nextnext = parseInt(chose_page) + 2;
        $('.pagination li.number_li').addClass('hidden_li');
        $('.pagination li[data-id="'+prevprev+'"]').removeClass('hidden_li');
        $('.pagination li[data-id="'+prev+'"]').removeClass('hidden_li');
        $('.pagination li[data-id="'+chose_page+'"]').removeClass('hidden_li');
        $('.pagination li[data-id="'+next+'"]').removeClass('hidden_li');
        $('.pagination li[data-id="'+nextnext+'"]').removeClass('hidden_li');
        click_pagination_li(chose_page,limit,max_page);
      } else if(($(this).hasClass('next_page')) && (!$(this).hasClass('deactivate_li'))){
        chose_page = parseInt($('.pagination .actual_page').attr('data-id')) + 1;
        prevprev = Number(chose_page - 2);
        prev = Number(chose_page - 1);
        next = parseInt(chose_page) + 1;
        nextnext = parseInt(chose_page) + 2;
        $('.pagination li.number_li').addClass('hidden_li');
        $('.pagination li[data-id="'+prevprev+'"]').removeClass('hidden_li');
        $('.pagination li[data-id="'+prev+'"]').removeClass('hidden_li');
        $('.pagination li[data-id="'+chose_page+'"]').removeClass('hidden_li');
        $('.pagination li[data-id="'+next+'"]').removeClass('hidden_li');
        $('.pagination li[data-id="'+nextnext+'"]').removeClass('hidden_li');
        click_pagination_li(chose_page,limit,max_page);

      } else if($(this).hasClass('last_page')){
        var last_four = Number(TotalPages - 4);
        var last_three = Number(TotalPages - 3);
        var last_two = Number(TotalPages - 2);
        var last_one = Number(TotalPages - 1);
        $('.pagination li.number_li').addClass('hidden_li');
        $('.pagination li[data-id="'+last_four+'"]').removeClass('hidden_li');
        $('.pagination li[data-id="'+last_three+'"]').removeClass('hidden_li');
        $('.pagination li[data-id="'+last_two+'"]').removeClass('hidden_li');
        $('.pagination li[data-id="'+last_one+'"]').removeClass('hidden_li');
        $('.pagination li[data-id="'+TotalPages+'"]').removeClass('hidden_li');
        click_pagination_li(TotalPages,limit,max_page);
      }
    }
  });

  $('#add_new_result').click(function() {

      if($('#new_result_date').val()
      && $('#new_result_home_team').val()
      && $('#new_result_away_team').val()
      && $('#new_result_home_score').val()
      && $('#new_result_away_score').val()
      && $('#new_result_tournament').val()
      && $('#new_result_city').val()
      && $('#new_result_country').val())
      {

        $.ajax({
            type:'post',
            dataType:'json',
            data:{
                'user_id'     : user_id,
                'date'		    :   $( "#new_result_date" ).val(),
                'home_team'		:   $( "#new_result_home_team" ).val(),
                'away_team'		:   $( "#new_result_away_team" ).val(),
                'home_score'		:   $( "#new_result_home_score" ).val(),
                'away_score'		:   $( "#new_result_away_score" ).val(),
                'tournament'		:   $( "#new_result_tournament" ).val(),
                'city'		  :   $( "#new_result_city" ).val(),
                'country'		:   $( "#new_result_country" ).val(),
            },
            url:site_url+'/eredmenyek/save_new_result',
            success:function(dat){
                if(dat.success){
                  if($('.pagination .actual_page').attr('data-id') == TotalPages){

                    var html = "";

                    if(user_permission == 2){
                      var handling = "deactive_handling";
                    } else {
                       var handling = "active_handling";
                    }

                    html += '<tr data-index="'+dat.result_id+'">';
                    html += '<td class="date_td">'+$( "#new_result_date" ).val()+'</td>';
                    html += '<td class="home_td">'+$( "#new_result_home_team" ).val()+'</td>';
                    html += '<td class="away_td">'+$( "#new_result_away_team" ).val()+'</td>';
                    html += '<td class="score_td">'+$( "#new_result_home_score" ).val()+':'+$( "#new_result_away_score" ).val()+'</td>';
                    html += '<td class="tournament_td">'+$( "#new_result_tournament" ).val()+'</td>';
                    html += '<td class="city_td">'+$( "#new_result_city" ).val()+'</td>';
                    html += '<td class="country_td">'+$( "#new_result_country" ).val()+'</td>';
                    html += '<td><i class="fa fa-pencil transit update_popup_open '+handling+'" title="'+title_modify_result+'"  data-name="update_result_popup" data-index="'+dat.result_id+'"></i></td>';
                    html += '<td><i class="delete_ico transit fa fa-trash '+handling+'" data-id="'+dat.result_id+'" title="'+title_delete_result+'"></i></td>';
                    html += '</tr>';

                    $('.results_table tbody').append(html);

                    $('#new_result_date').val('');
                    $('#new_result_home_team').val('');
                    $('#new_result_away_team').val('');
                    $('#new_result_home_score').val('');
                    $('#new_result_away_score').val('');
                    $('#new_result_tournament').val('');
                    $('#new_result_city').val('');
                    $('#new_result_country').val('');


                  } else {
                    var last_four = Number(TotalPages - 4);
                    var last_three = Number(TotalPages - 3);
                    var last_two = Number(TotalPages - 2);
                    var last_one = Number(TotalPages - 1);
                    $('.pagination li.number_li').addClass('hidden_li');
                    $('.pagination li[data-id="'+last_four+'"]').removeClass('hidden_li');
                    $('.pagination li[data-id="'+last_three+'"]').removeClass('hidden_li');
                    $('.pagination li[data-id="'+last_two+'"]').removeClass('hidden_li');
                    $('.pagination li[data-id="'+last_one+'"]').removeClass('hidden_li');
                    $('.pagination li[data-id="'+TotalPages+'"]').removeClass('hidden_li');
                    click_pagination_li(TotalPages,limit,last_two);
                  }

                  $('#new_result_popup .close-popup').click();


                }else {
                    alertify.error(dat.msg);
                }
            }
        })

      } else {
          alertify.error(error_empty_field);
      }
  });

  $(document).on("click",".update_popup_open", function(){
    if(!$(this).hasClass('deactive_handling')){

      var popup_name = $(this).attr('data-name');
      var result_id = $(this).attr('data-index');

      $.ajax({
          type:'post',
          dataType:'json',
          data:{
              'result_id'		:   result_id,
          },
          url:site_url+'/eredmenyek/get_datas',
          success:function(dat){
              if(dat.success){
                  $('#'+popup_name+' #update_result_date').val(dat.date);
                  $('#'+popup_name+' #update_result_home_team').val(dat.home_team);
                  $('#'+popup_name+' #update_result_away_team').val(dat.away_team);
                  $('#'+popup_name+' #update_result_home_score').val(dat.home_score);
                  $('#'+popup_name+' #update_result_away_score').val(dat.away_score);
                  $('#'+popup_name+' #update_result_tournament').val(dat.tournament);
                  $('#'+popup_name+' #update_result_city').val(dat.city);
                  $('#'+popup_name+' #update_result_country').val(dat.country);
                  $('#'+popup_name+' #hidden_result_id').val(dat.result_id);

              }else {
                  alertify.error(dat.msg);
              }
          }
      })

      $('#'+popup_name).bPopup({
          transition: 'slideDown',
          closeClass: 'close-popup'
      });

    }
  });

});

function click_pagination_li(chose_page,limit,max_page){
  $('.pagination li').removeClass('actual_page');
  $('.pagination li[data-id="'+chose_page+'"]').addClass('actual_page');
  offset = Number((chose_page - 1) * limit);
  if(chose_page <= 3){
    $('.pagination li.previous_page').addClass('deactivate_li');
      $('.pagination li.next_page').removeClass('deactivate_li');
  } else if(chose_page >= max_page){
    $('.pagination li.previous_page').removeClass('deactivate_li');
    $('.pagination li.next_page').addClass('deactivate_li');
  } else {
    $('.pagination li').removeClass('deactivate_li');
  }
  ajax_pagination(limit,offset);
}

function ajax_pagination(limit,offset){

    $.ajax({
        type: 'post',
        dataType: 'json',
        data:{
            'team'         : "",
        },
        url: site_url+"/eredmenyek/results_list_view/"+limit+"/"+offset,
        success: function(data) {
          var html = "";

          if(data){
            $.each(data, function(i, item){
              if(user_permission == 2){
                var handling = "deactive_handling";
              } else if((user_permission == 1) && (user_id != item.user_id)){
                var handling = "deactive_handling";
              } else {
                 var handling = "active_handling";
              }
              
              html += '<tr data-index="'+item.id+'">';
              html += '<td class="date_td">'+item.date+'</td>';
              html += '<td class="home_td">'+item.home_team+'</td>';
              html += '<td class="away_td">'+item.away_team+'</td>';
              html += '<td class="score_td">'+item.home_score+':'+item.away_score+'</td>';
              html += '<td class="tournament_td">'+item.tournament+'</td>';
              html += '<td class="city_td">'+item.city+'</td>';
              html += '<td class="country_td">'+item.country+'</td>';
              html += '<td><i class="fa fa-pencil transit update_popup_open '+handling+'" title="'+title_modify_result+'"  data-name="update_result_popup" data-index="'+item.id+'"></i></td>';
              html += '<td><i class="delete_ico transit fa fa-trash '+handling+'" data-id="'+item.id+'" title="'+title_delete_result+'"></i></td>';
              html += '</tr>';
            });
        } else {
          html = '<tr class="empty_row transit"><td colspan="9">'+empty_result_row+'</td></tr>';
        }


          $('.results_table tbody').html('');
          $('.results_table tbody').html(html);

            //pagination_calibrate(limit,offset);
        }
    })

}
