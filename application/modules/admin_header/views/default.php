<?php if(($url != "") && ($url != "welcome")){?>
<div id="welcome">
    <div class="top">
        <div class="left_block block">Üdvözlet, <?php echo $this->session->userdata('user_name');?>!</div><!--
        --><div class="block middle_block"><h1>Admin oldal</h1></div><!--
        --><div class="block right_block transit logout"><i class="fa fa-sign-out"></i>Kijelentkezés</div>   
    </div>
    <div class="menu_sec">
        <div class="inner">
            <div id="felhasznalok" class="menu_point transit <?php echo $url == "adminok" ? "active" : ''; ?>">
                <a href="<?php echo site_url('adminok'); ?>">Adminok</a>
            </div><!--
            --><div id="termekek" class="menu_point transit <?php echo $url == "kategoriak" ? "active" : ''; ?>">
                <a href="<?php echo site_url('kategoriak'); ?>">Kategóriák</a>
            </div><!--
            --><div id="osszetevok" class="menu_point transit <?php echo $url == "jatekok" ? "active" : ''; ?>">
                <a href="<?php echo site_url('jatekok'); ?>">Játékok</a>
            </div>
        </div>
    </div>
</div>
<?php } ?>