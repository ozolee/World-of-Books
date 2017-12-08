<?php $this->home->add_script(site_url('js/welcome.js')); ?>

<div id="welcome">    
    <div class="inner">
        <div class="title">
            <h1>Belépés</h1>
        </div>
        <div class="login_form">
            <div class="m_col left_col">
                <div class="input_label">E-mail cím</div><!--
                --><input type="text" id="login_email" class="input transit">
            </div><!--
            --><div class="m_col right_col">
                <div class="input_label">Jelszó</div><!--
                --><input type="password" id="login_pass" class="input transit">
            </div>
            <div class="button_row">
                <div id="login_button" class="button transit">Bejelentkezés</div>
            </div>                
        </div>
    </div>
</div>
