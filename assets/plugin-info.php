<h3>Plugin info</h3>

<?php 
	$options = get_option('simple_debug_options');
	$version = $options['sd_version'];
?>

<div class="inner">

	<ul>
		<li><strong><?php _e('Author:','Simple Debug plugin'); ?></strong> <a href="http://www.senff.com" target="_blank">Mark Senff</a></li>
		<li><strong><?php _e('Version:','Simple Debug plugin'); ?></strong> <?php echo $version; ?></li>
		<li><strong><?php _e('Detailed Documentation:','Simple Debug plugin'); ?></strong> <a href="http://www.senff.com/plugins/simple-debug-info-panel" target="_blank">Senff.com</a></li>
		<li><strong><?php _e('Support Forum','Simple Debug plugin'); ?></strong>: <a href="https://wordpress.org/support/plugin/simple-debug-info-panel" target="_blank">WordPress.org</a></li>
		<li><strong><?php _e('Donate:','Simple Debug plugin'); ?></strong> <a href="http://www.senff.com/donate" target="_blank">Paypal</a></li>
		<li><strong><?php _e('Twitter:','Simple Debug plugin'); ?></strong> <a href="http://www.twitter.com/senff" target="_blank">@Senff</a></li>
	</ul>

</div>

<p><a href="https://wordpress.org/support/plugin/simple-debug-info-panel" target="_blank"><strong><?php _e('Please Report Bugs','Simple Debug plugin'); ?></strong></a></p>
