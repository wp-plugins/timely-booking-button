<?php
    $tbbaccount = trim(get_option('tbb_account')); 
    $tbbcolour = get_option('tbb_colour');
    $tbwwidth = get_option('tbw_width');
    $tbwheight = get_option('tbw_height');

    if (isset($_POST))
    {    
        if(array_key_exists('tbb_hidden', $_POST) && array_key_exists('tbb_account_valid', $_POST)  && $_POST['tbb_hidden'] == 'Y' && $_POST['tbb_account_valid'] == 'true') {  
            update_option('tbb_account', trim($_POST['tbb_account']));  
            update_option('tbb_colour', $_POST['tbb_colour']);
            update_option('tbw_width', $_POST['tbw_width']);
            update_option('tbw_height', $_POST['tbw_height']);
            $tbbaccount = get_option('tbb_account');
            $tbbcolour = get_option('tbb_colour');
            $tbwwidth = get_option('tbw_width');
            $tbwheight = get_option('tbw_height');
            ?>        
            <div class="updated">
            <p><strong><?php _e('Options saved.' ); ?>
            </strong></p></div>    
        <?php
        } else {
            if (array_key_exists('tbb_account_valid', $_POST) && $_POST['tbb_account_valid'] == 'false') {
                $tbbaccount = trim($_POST['tbb_account']);
                ?>
                <div class="updated tbb-update-error">
                <p><strong><?php _e('Error with your account name options not updated' ); ?>
                </strong></p></div>            
            <?php            
            } 
        }
    }
    
    if ($tbwwidth == '') $tbwwidth = "480";
    if ($tbwheight == '') $tbwheight = "600";    
    
?>  

<form name="oscimp_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
    <div class="wrap">
        <?php    echo "<h2>" . __( 'Timely Booking Widget Options' ) . "</h2>"; ?>
		<input type="hidden" name="tbb_hidden" value="Y">
        <input type="hidden" name="tbb_account_valid" value="N">
		<?php    echo "<h4>" . __( 'Account Name' ) . "</h4>"; ?>
		<p>            
            <p>This is the name of your mini website or private address that you chose when setting up your Timely account. If you are not sure what this should be click <a href="http://app.gettimely.com/promote/buttons#collapse-6" target="_blank">here</a> to login to your Timely account and check the value.</p>
            <input type="text" name="tbb_account" value="<?php echo $tbbaccount; ?>" size="20" class="tbb-account">            
            <span id="tbb-account-correct" class="tbb-account-status" style="display: none;">Valid account</span>
            <span id="tbb-account-wrong" class="tbb-account-status" style="display: none;">Invalid account</span>
        </p>  
        <br />
		<hr />	
    </div>

    <div class="wrap">
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
    </div>

    <div class="wrap">
		<?php    echo "<h4>" . __( 'Widget Size' ) . "</h4>"; ?>
        <label for="tbw_width">Width: </label>
        <input type="number" class="tbw-input-mini" step="10" value="<?php echo $tbwwidth; ?>" id="tbw_width" name="tbw_width" min="0">
        <label for="tbw_height">Height: </label>
        <input type="number" class="tbw-input-mini" step="10" value="<?php echo $tbwheight; ?>" id="tbw_height" name="tbw_height" min="0">
        <br />
        <?php    echo "<h4>" . __( 'Preview' ) . "</h4>"; ?>
        <div>
            <iframe src="http://<?php echo $tbbaccount; ?>.gettimely.com/book/embed" scrolling="no" id="timelyWidget" style="width: <?php echo $tbwwidth; ?>px; height: <?php echo $tbwheight; ?>px; border: 1px solid #4f606b;"></iframe>
        </div>
        <br />
		<hr />		
    </div>
    
    <p class="submit">
		<input type="submit" name="Submit" value="<?php _e('Update Options') ?>" />
		</p>	
</form>

<script type="text/javascript" >
jQuery(document).ready(function($) {
    
   $('.tbb-account').live('input', function() {   
	    var data = {
		    action: 'tbb_account_check',
            tbb_account: $(this).val().trim()		    
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
    
    $('.tbw-input-mini').change(function() {
        var style = $(this).attr('id') == 'tbw_width' ? 'width' : 'height';
        $('#timelyWidget').css(style, $(this).val());        
    });
    
    jQuery('.tbb-account').trigger('input');
    jQuery('.tbb-colour').trigger('change');
});
</script>