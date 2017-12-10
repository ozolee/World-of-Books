<script>var limit = "<?php echo $limit; ?>"</script>
<?php $this->home->add_script(site_url('js/results.js')); ?>

<div id="results" class="list">
    <div class="section">

        <div class="inner">
            <table class="results_table">
                <thead>
                    <tr class="header_tr">
                        <td>
                            Dátum
                        </td>
                        <td>
                            Hazai csapat
                        </td>
                        <td>
                            Vendég csapat
                        </td>
                        <td>
                            Eredmény
                        </td>
                        <td>
                            Bajnokság
                        </td>
                        <td>
                            Város
                        </td>
                        <td>
                            Ország
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
                                    <i class="fa fa-pencil transit"></i>
                                </td>
                                <td>
                                    <i class="delete_ico transit fa fa-trash" data-id="<?php echo $r->id; ?>" title="Eredmény törlése"></i>
                                </td>
                            </tr>
                        <?php }?>

                    <?php }else{?>
                            <tr class="empty_row transit">
                                <td colspan="9">
                                    Nincs még eredmény felvéve
                                </td>
                            </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <div class="pagination c">
            <ul>
              <li class="transit first_page">Első</li>
              <li class="transit previous_page">Előző</li>
              <?php
              for($i = 1; $i<= $count; $i++){
                  if($i == 1){
                      $a = "actual_page";
                  } else {
                      $a = "";
                  }

                  echo '<li data-id="'.$i.'" class="transit '.$a.'">'.$i.'</li>';
              }
              ?>
                <li class="transit next_page">Következő</li>
                <li class="transit last_page">Előző</li>
            </ul>
        </div>
    </div>

</div>
