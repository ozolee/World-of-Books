<?php if(($url != "") && ($url != "welcome")){?>
<div id="welcome">
    <div class="top">
        <div class="left_block block">Üdvözlet, <?php echo $this->session->userdata('user_name');?>!</div><!--
        --><div class="block middle_block"><h1>Admin oldal</h1></div><!--
        --><div class="block right_block transit logout"><i class="fa fa-sign-out"></i>Kijelentkezés</div>
    </div>
    <div class="menu_sec">
        <div class="inner">
            <div id="users_point" class="menu_point transit <?php echo $url == "felhasznalok" ? "active" : ''; ?>">
                <a href="<?php echo site_url('felhasznalok'); ?>">Felhasználók</a>
            </div><!--
            --><div id="results_point" class="menu_point transit <?php echo $url == "eredmenyek" ? "active" : ''; ?>">
                <a href="<?php echo site_url('eredmenyek'); ?>">Eredmények</a>
            </div>
        </div>
    </div>
</div>
<?php } ?>
