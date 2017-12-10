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
              html += '<tr data-index="'+item.id+'">';
              html += '<td class="date_td">'+item.date+'</td>';
              html += '<td class="home_td">'+item.home_team+'</td>';
              html += '<td class="away_td">'+item.away_team+'</td>';
              html += '<td class="score_td">'+item.home_score+':'+item.away_score+'</td>';
              html += '<td class="tournament_td">'+item.tournament+'</td>';
              html += '<td class="city_td">'+item.city+'</td>';
              html += '<td class="country_td">'+item.country+'</td>';
              html += '<td><i class="fa fa-pencil transit" title="'+title_modify_result+'"></i></td>';
              html += '<td><i class="delete_ico transit fa fa-trash" data-id="'+item.id+'" title="'+title_delete_result+'"></i></td>';
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
