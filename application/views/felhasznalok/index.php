<script>var error_empty_field = "<?php echo lang('error_empty_field'); ?>"; </script>
<script>var error_invalid_email = "<?php echo lang('error_invalid_email'); ?>"; </script>
<script>var error_invalid_passwords = "<?php echo lang('error_invalid_passwords'); ?>"; </script>
<script>var error_delete_yourself = "<?php echo lang('error_delete_yourself'); ?>"; </script>
<script>var question_delete_user = "<?php echo lang('question_delete_user'); ?>"; </script>
<script>var empty_user_row = "<?php echo lang('empty_user_row'); ?>"; </script>
<script>var user_id = "<?php echo $this->session->userdata('user_id'); ?>"; </script>

<?php $this->home->add_script(site_url('js/users.js')); ?>

<div id="users" class="list">
  <div class="section">
      <div class="inner">
          <div class="button_row">
              <div class="transit button popup_open" data-name="new_user_popup" ><i class="fa fa-plus-circle"></i> <?php echo lang('registration'); ?></div>
          </div>
          <table class="users_table">
              <thead>
                  <tr class="header_tr">
                      <td>
                          <?php echo lang('label_name'); ?>
                      </td>
                      <td>
                          <?php echo lang('label_email'); ?>
                      </td>
                      <td>
                          <?php echo lang('label_permission'); ?>
                      </td>
                      <td></td>
                  </tr>
              </thead>
              <tbody>
                  <?php if(!empty($users)){?>
                      <?php foreach($users as $u){?>
                          <?php
                            if($u->permission == 0){
                              $permission = lang('permission_admin');
                            } else if($u->permission == 1){
                              $permission = lang('permission_user');
                            } else if($u->permission == 2){
                              $permission = lang('permission_reader');
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
                                  <i class="delete_ico transit fa fa-trash <?php echo $this->session->userdata('user_permission') > 0 ? "deactivate_delete" : "";?>" data-id="<?php echo $u->user_id; ?>" title="<?php echo lang('delete_user'); ?>"></i>
                              </td>
                          </tr>
                      <?php }?>

                  <?php }else{?>
                          <tr class="empty_row transit">
                              <td colspan="4">
                                  <?php echo lang('empty_user_row'); ?>
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
        <div class="input_label"><?php echo lang('label_name'); ?></div><!--
        --><input type="text" id="new_user_name" class="input transit">
        <div class="input_label"><?php echo lang('label_email'); ?></div><!--
        --><input type="text" id="new_user_email" class="input transit">
        <div class="input_label"><?php echo lang('label_pass'); ?></div><!--
        --><input type="password" id="new_user_pass" class="input transit">
        <div class="input_label"><?php echo lang('label_pass_again'); ?></div><!--
        --><input type="password" id="new_user_pass_again" class="input transit">
        <div class="input_label"><?php echo lang('label_permission'); ?></div><!--
        --><select id="new_user_permission" class="input transit">
            <option disabled selected><?php echo lang('label_permission_select'); ?></option>
            <option value="0"><?php echo lang('permission_admin'); ?></option>
            <option value="1"><?php echo lang('permission_user'); ?></option>
            <option value="2"><?php echo lang('permission_reader'); ?></option>
        </select>
        <div id="add_new_user" class="button transit"><?php echo lang('add_button'); ?></div>
    </div>
</div>
