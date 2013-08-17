<?php
    $tbbaccount = get_option('tbb_account'); 
    $tbbcolour = get_option('tbb_colour');

    if($_POST['tbb_hidden'] == 'Y' && $_POST['tbb_account_valid'] == 'true') {  
        update_option('tbb_account', $_POST['tbb_account']);  
        update_option('tbb_colour', $_POST['tbb_colour']);
        $tbbaccount = get_option('tbb_account');
        $tbbcolour = get_option('tbb_colour');
        ?>        
        <div class="updated">
        <p><strong><?php _e('Options saved.' ); ?>
        </strong></p></div>    
    <?php
    } else {
        if ($_POST['tbb_account_valid'] == 'false') {
            $tbbaccount = $_POST['tbb_account'];
            ?>
            <div class="updated tbb-update-error">
            <p><strong><?php _e('Error with your account name options not updated' ); ?>
            </strong></p></div>            
        <?php            
        } 
    }     
    
?>  

<div class="wrap">
	<?php    echo "<h2>" . __( 'Timely Book Now Button Options' ) . "</h2>"; ?>
			
	<form name="oscimp_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
		<input type="hidden" name="tbb_hidden" value="Y">
        <input type="hidden" name="tbb_account_valid" value="N">
		<?php    echo "<h4>" . __( 'Account Name' ) . "</h4>"; ?>
		<p>            
            <p>This is the name of your mini website or private address that you chose when setting up your Timely account. If you are not sure what this should be click <a href="http://app.gettimely.com/promote/buttons#collapse-6" target="_blank">here</a> to login to your Timely account and check the value.</p>
            <input type="text" name="tbb_account" value="<?php echo $tbbaccount; ?>" size="20" class="tbb-account">            
            <span id="tbb-account-correct" class="tbb-account-status" style="display: none;">Valid account</span>
            <span id="tbb-account-wrong" class="tbb-account-status" style="display: none;">Invalid account</span>
        </p>        
        <?php    echo "<h4>" . __( 'Button Colour' ) . "</h4>"; ?>
        <p>
            <select name="tbb_colour" class="tbb-colour">
                <option value="light" <?php echo ($tbbcolour == 'light' ? 'selected' : ''); ?>>Light
                <option value="dark" <?php echo ($tbbcolour == 'dark' ? 'selected' : ''); ?>>Dark
            </select>
            <span class="tbb-colour-preview">
                <img src="" />
            </span>
        </p>
        <br />
		<hr />		
		<p class="submit">
		<input type="submit" name="Submit" value="<?php _e('Update Options') ?>" />
		</p>
	</form>
</div>

<script type="text/javascript" >
jQuery(document).ready(function($) {
    
   $('.tbb-account').live('input', function() {   
	    var data = {
		    action: 'tbb_account_check',
            tbb_account: $(this).val()		    
	    };

	    // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
	    $.post(ajaxurl, data, function(response) {
		    var input = $('.tbb-account');
            input.removeClass('tbb-account-correct tbb-account-wrong');
            if (response.indexOf('correct') > -1) {
                input.addClass('tbb-account-correct');
                $('span#tbb-account-correct').show();
                $('span#tbb-account-wrong').hide();
                $('input[name="tbb_account_valid"]').val('true');
            } else {
                input.addClass('tbb-account-wrong');
                $('span#tbb-account-correct').hide();
                $('span#tbb-account-wrong').show();
                $('input[name="tbb_account_valid"]').val('false');
            }            
	    });
    });
    
    $('.tbb-colour').change( function() {
        $('.tbb-colour-preview img').attr('src', 'http://book.gettimely.com/images/book-buttons/book-now-' + $(this).val() + '.png');    
    });
    
    jQuery('.tbb-account').trigger('input');
    jQuery('.tbb-colour').trigger('change');
});
</script>