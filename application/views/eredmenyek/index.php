<script>var limit = "<?php echo $limit; ?>"</script>
<script>var TotalPages = "<?php echo $count; ?>"</script>
<script>var title_modify_result = "<?php echo lang('title_modify_result'); ?>"; </script>
<script>var title_delete_result = "<?php echo lang('title_delete_result'); ?>"; </script>
<script>var empty_result_row = "<?php echo lang('empty_result_row'); ?>"; </script>
<?php $this->home->add_script(site_url('js/results.js')); ?>

<div id="results" class="list">
    <div class="section">

        <div class="inner">
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
                        <?php foreach($results as $r){?>
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
                                    <i class="fa fa-pencil transit" title="<?php echo lang('title_modify_result'); ?>"></i>
                                </td>
                                <td>
                                    <i class="delete_ico transit fa fa-trash" data-id="<?php echo $r->id; ?>" title="<?php echo lang('title_delete_result'); ?>"></i>
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
        <div class="pagination c">
            <ul>
              <li class="transit first_page"><?php echo lang('pag_first'); ?></li>
              <li class="transit previous_page deactivate_li"><?php echo lang('pag_previous'); ?></li>
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
                <li class="transit next_page"><?php echo lang('pag_next'); ?></li>
                <li class="transit last_page"><?php echo lang('pag_last'); ?></li>
            </ul>
        </div>
    </div>

</div>
