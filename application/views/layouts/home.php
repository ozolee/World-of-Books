<!DOCTYPE html> 

<html>
	<head>
		<?php echo $output_data['head']; ?>
	</head>

	<body>

        <?php if($this->session->flashdata('success')) { ?>
                        <script>alertify.success('<?php echo $this->session->flashdata('success'); ?>')</script>
        <?php } ?>

        <?php if($this->session->flashdata('error')) { ?>
                        <script>alertify.error('<?php echo $this->session->flashdata('error'); ?>')</script>
        <?php } ?>

        <?php if(validation_errors()){ 
            $error  = str_replace(array("\r", "\n"), '', validation_errors()); ?>
            <script>alertify.error('<?php echo $error; ?>')</script>
        <?php } ?>
            
            <script>
            var csfrData = {};
                csfrData['<?php echo $this->security->get_csrf_token_name(); ?>']
                               = '<?php echo $this->security->get_csrf_hash(); ?>';
            </script>
			
            <div class="page">     
                <?php Module::run('admin_header'); ?>
                
                <?php echo empty($app_content)?'':$app_content; ?>
            </div>
            
	</body>
</html>