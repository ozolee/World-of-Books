<script>var error_empty_field = "<?php echo lang('error_empty_field'); ?>"; </script>
<script>var error_invalid_email = "<?php echo lang('error_invalid_email'); ?>"; </script>

<?php $this->home->add_script(site_url('js/welcome.js')); ?>

<div id="welcome">
    <div class="inner">
        <div class="title">
            <h1><?php echo lang('enter'); ?></h1>
        </div>
        <div class="login_form">
            <div class="m_col left_col">
                <div class="input_label"><?php echo lang('label_email'); ?></div><!--
                --><input type="text" id="login_email" class="input transit">
            </div><!--
            --><div class="m_col right_col">
                <div class="input_label"><?php echo lang('label_pass'); ?></div><!--
                --><input type="password" id="login_pass" class="input transit">
            </div>
            <div class="button_row">
                <div id="login_button" class="button transit"><?php echo lang('login'); ?></div>
            </div>
        </div>
    </div>
</div>
