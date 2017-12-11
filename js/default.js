
    $(document).ready(function(){

	    $(function() {
            $.ajaxSetup({
               data: csfrData
            });
        });

        $('.date').datepicker({
          dateFormat: "yy-mm-dd"
        });

        $('.popup_open').click(function(){

            var popup_name = $(this).attr('data-name');

            $('#'+popup_name).bPopup({
                transition: 'slideDown',
                closeClass: 'close-popup'
            });
        });

        $(document).on("input", ".numeric", function() {
            this.value = this.value.replace(/[^\d\.\-]/g,'');
        });

        $('.logout').click(function(){
           window.location = site_url+'/welcome/kijelentkezes';
        });



    });
