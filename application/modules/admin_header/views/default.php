<div id="languages">
    <div class="lang_item <?php echo $this->lang->lang() == 'hu' ? 'active_lang' : ''; ?>" data-language="hu">
        <?php echo anchor($this->lang->switch_uri('hu'),'hu'); ?>
    </div><!--
    --><div class="lang_item <?php echo $this->lang->lang() == 'en' ? 'active_lang' : ''; ?>" data-language="en">
        <?php echo anchor($this->lang->switch_uri('en'),'en'); ?>
    </div>
</div>

<?php if(($url != "") && ($url != "welcome")){?>
<div id="welcome">
    <div class="top">
        <div class="left_block block"><?php echo lang('greetings').', '; echo $this->session->userdata('user_name');?>!</div><!--
        --><div class="block middle_block"></div><!--
        --><div class="block right_block transit logout"><i class="fa fa-sign-out"></i><?php echo lang('logout'); ?></div>
    </div>
    <div class="menu_sec">
        <div class="inner">
            <div id="users_point" class="menu_point transit <?php echo $url == "felhasznalok" ? "active" : ''; ?>">
                <a href="<?php echo site_url('felhasznalok'); ?>"><?php echo lang('users'); ?></a>
            </div><!--
            --><div id="results_point" class="menu_point transit <?php echo $url == "eredmenyek" ? "active" : ''; ?>">
                <a href="<?php echo site_url('eredmenyek'); ?>"><?php echo lang('results'); ?></a>
            </div>
        </div>
    </div>
</div>
<?php } ?>
