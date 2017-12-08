<?php $this->home->add_script(site_url('js/users.js')); ?>

<div id="users" class="list">
  <div class="section">
      <div class="inner">
          <div class="button_row">
              <div class="transit button popup_open" data-name="new_admin_popup" ><i class="fa fa-plus-circle"></i> Regisztráció</div>
          </div>
          <table class="users_table">
              <thead>
                  <tr class="header_tr">
                      <td>
                          Név
                      </td>
                      <td>
                          E-mail cím
                      </td>
                      <td>
                          Utolsó Belépés
                      </td>
                      <td></td>
                  </tr>
              </thead>
              <tbody>
                  <?php if(!empty($users)){?>
                      <?php foreach($users as $u){?>
                          <?php
                            if($u->permission == 0){
                              $permission = "Admin";
                            } else if($u->permission == 1){
                              $permission = "User";
                            } else if($u->permission == 2){
                              $permission = "Reader";
                            }
                          ?>
                          <tr data-index="<?php echo $u->user_id; ?>">
                              <td>
                                  <?php echo $u->name; ?>
                              </td>
                              <td>
                                  <?php echo $u->email; ?>
                              </td>
                              <td>
                                   <?php echo $permission; ?>
                              </td>
                              <td>
                                  <i class="delete_ico transit fa fa-trash" data-id="<?php echo $u->user_id; ?>" title="Felhasználó törlése"></i>
                              </td>
                          </tr>
                      <?php }?>

                  <?php }else{?>
                          <tr class="empty_row transit">
                              <td colspan="3">
                                  Nincs még felhasználó felvéve
                              </td>
                          </tr>
                  <?php } ?>
              </tbody>
          </table>
      </div>
  </div>
</div>
<div id="new_user_popup" class="popup">
    <div class="close-popup transit">
        <i class="fa fa-close"></i>
    </div>
    <div class="form_sec">
        <div class="input_label">Név</div><!--
        --><input type="text" id="new_user_name" class="input transit">
        <div class="input_label">E-mail cím</div><!--
        --><input type="text" id="new_user_email" class="input transit">
        <div class="input_label">Jelszó</div><!--
        --><input type="password" id="new_user_pass" class="input transit">
        <div class="input_label">Jelszó újra</div><!--
        --><input type="password" id="new_user_pass_again" class="input transit">
        <div id="add_new_user" class="button transit">Felvétel</div>
    </div>
</div>
