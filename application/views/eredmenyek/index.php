<script>var limit = "<?php echo $limit; ?>"</script>
<script>var user_id = "<?php echo $user_id; ?>"</script>
<script>var user_permission = "<?php echo $user_permission; ?>"</script>
<script>var title_modify_result = "<?php echo lang('title_modify_result'); ?>"; </script>
<script>var title_delete_result = "<?php echo lang('title_delete_result'); ?>"; </script>
<script>var empty_result_row = "<?php echo lang('empty_result_row'); ?>"; </script>
<script>var error_empty_field = "<?php echo lang('error_empty_field'); ?>"; </script>
<script>var question_delete_result = "<?php echo lang('question_delete_result'); ?>"; </script>
<script>var empty_filter_row = "<?php echo lang('empty_filter_row'); ?>"; </script>
<script>var pag_first = "<?php echo lang('pag_first'); ?>"; </script>
<script>var pag_previous = "<?php echo lang('pag_previous'); ?>"; </script>
<script>var pag_next = "<?php echo lang('pag_next'); ?>"; </script>
<script>var pag_last = "<?php echo lang('pag_last'); ?>"; </script>



<?php $this->home->add_stylesheet(site_url('datepicker/jquery-ui.css')); ?>
<?php $this->home->add_script(site_url('datepicker/jquery-ui.js')); ?>

<?php $this->home->add_script(site_url('js/results.js')); ?>

<div id="results" class="list">
    <div class="section">

        <div class="inner">
            <?php if ($user_permission != 2){?>
              <div class="button_row">
                  <div class="transit button popup_open" data-name="new_result_popup" ><i class="fa fa-plus-circle"></i> <?php echo lang('label_new_result'); ?></div>
              </div>
            <?php } ?>
            <div class="filter_form">
              <input type="text" class="filter_input transit" id="filter_team" placeholder="<?php echo lang('filter_team'); ?>">
            </div>

            <table class="results_table">
                <thead>
                    <tr class="header_tr">
                        <td>
                            <?php echo lang('label_date'); ?>
                        </td>
                        <td>
                            <?php echo lang('label_home_team'); ?>
                        </td>
                        <td>
                            <?php echo lang('label_away_team'); ?>
                        </td>
                        <td>
                            <?php echo lang('label_result'); ?>
                        </td>
                        <td>
                            <?php echo lang('label_tournament'); ?>
                        </td>
                        <td>
                            <?php echo lang('label_city'); ?>
                        </td>
                        <td>
                            <?php echo lang('label_country'); ?>
                        </td>
                        <td></td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($results)){?>
                        <?php foreach($results as $r){
                            if($user_permission == 2){
                              $handling = "deactive_handling";
                            } else if(($user_permission == 1) && ($user_id != $r->user_id)){
                              $handling = "deactive_handling";
                            } else {
                              $handling = "active_handling";
                            }
                          ?>
                            <tr data-index="<?php echo $r->id; ?>">
                                <td class="date_td">
                                    <?php echo $r->date; ?>
                                </td>
                                <td class="home_td">
                                    <?php echo $r->home_team; ?>
                                </td>
                                <td class="away_td">
                                    <?php echo $r->away_team; ?>
                                </td>
                                <td class="score_td">
                                    <?php echo $r->home_score.":".$r->away_score; ?>
                                </td>
                                <td class="tournament_td">
                                    <?php echo $r->tournament; ?>
                                </td>
                                <td class="city_td">
                                    <?php echo $r->city; ?>
                                </td>
                                <td class="country_td">
                                    <?php echo $r->country; ?>
                                </td>
                                <td>
                                    <i class="fa fa-pencil transit update_popup_open <?php echo $handling; ?>" title="<?php echo lang('title_modify_result'); ?>"  data-name="update_result_popup" data-index="<?php echo $r->id; ?>"></i>
                                </td>
                                <td>
                                    <i class="delete_ico transit fa fa-trash <?php echo $handling; ?>" data-id="<?php echo $r->id; ?>" title="<?php echo lang('title_delete_result'); ?>"></i>
                                </td>
                            </tr>
                        <?php }?>

                    <?php }else{?>
                            <tr class="empty_row transit">
                                <td colspan="9">
                                    <?php echo lang('empty_result_row'); ?>
                                </td>
                            </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <input type="hidden" id="hidden_total_pages" value="<?php echo $count?>">
        <div class="pagination c">
            <ul>
              <li class="transit first_page"><?php echo lang('pag_first'); ?></li>
              <li class="transit previous_page deactivate_li"><i class="fa fa-angle-double-left"></i><?php //echo lang('pag_previous'); ?></li>
              <?php
              for($i = 1; $i<= $count; $i++){
                  $hidden_li = "";
                  if($i == 1){
                      $a = "actual_page";
                  } else {
                      $a = "";
                  }
                  if($i > 5){
                    $hidden_li = "hidden_li";
                  }

                  echo '<li data-id="'.$i.'" class="transit number_li '.$hidden_li.' '.$a.'">'.$i.'</li>';
              }
              ?>
                <li class="transit next_page"><i class="fa fa-angle-double-right"></i><?php //echo lang('pag_next'); ?></li>
                <li class="transit last_page"><?php echo lang('pag_last'); ?></li>
            </ul>
        </div>
    </div>

</div>

<?php if ($user_permission != 2){?>
  <div id="new_result_popup" class="popup">
      <div class="close-popup transit">
          <i class="fa fa-close"></i>
      </div>
      <div class="form_sec">
          <div class="input_label"><?php echo lang('label_date'); ?></div><!--
          --><input type="text" id="new_result_date" class="input transit date">
          <div class="input_label"><?php echo lang('label_home_team'); ?></div><!--
          --><input type="text" id="new_result_home_team" class="input transit">
          <div class="input_label"><?php echo lang('label_away_team'); ?></div><!--
          --><input type="text" id="new_result_away_team" class="input transit">
          <div class="input_label"><?php echo lang('label_home_score'); ?></div><!--
          --><input type="text" id="new_result_home_score" class="input transit numeric">
          <div class="input_label"><?php echo lang('label_away_score'); ?></div><!--
          --><input type="text" id="new_result_away_score" class="input transit numeric">
          <div class="input_label"><?php echo lang('label_tournament'); ?></div><!--
          --><input type="text" id="new_result_tournament" class="input transit">
          <div class="input_label"><?php echo lang('label_city'); ?></div><!--
          --><input type="text" id="new_result_city" class="input transit">
          <div class="input_label"><?php echo lang('label_country'); ?></div><!--
          --><input type="text" id="new_result_country" class="input transit">

          <div id="add_new_result" class="button transit"><?php echo lang('add_button'); ?></div>
      </div>
  </div>

  <div id="update_result_popup" class="popup">
      <div class="close-popup transit">
          <i class="fa fa-close"></i>
      </div>
      <div class="form_sec">
          <div class="input_label"><?php echo lang('label_date'); ?></div><!--
          --><input type="text" id="update_result_date" class="input transit date">
          <div class="input_label"><?php echo lang('label_home_team'); ?></div><!--
          --><input type="text" id="update_result_home_team" class="input transit">
          <div class="input_label"><?php echo lang('label_away_team'); ?></div><!--
          --><input type="text" id="update_result_away_team" class="input transit">
          <div class="input_label"><?php echo lang('label_home_score'); ?></div><!--
          --><input type="text" id="update_result_home_score" class="input transit numeric">
          <div class="input_label"><?php echo lang('label_away_score'); ?></div><!--
          --><input type="text" id="update_result_away_score" class="input transit numeric">
          <div class="input_label"><?php echo lang('label_tournament'); ?></div><!--
          --><input type="text" id="update_result_tournament" class="input transit">
          <div class="input_label"><?php echo lang('label_city'); ?></div><!--
          --><input type="text" id="update_result_city" class="input transit">
          <div class="input_label"><?php echo lang('label_country'); ?></div><!--
          --><input type="text" id="update_result_country" class="input transit">
          <input type="hidden" id="hidden_result_id">
          <div id="update_result" class="button transit"><?php echo lang('modify_button'); ?></div>
      </div>
  </div>
<?php } ?>
