
<h2><?php esc_html_e('FAQ','simple-debug-info-panel'); ?>/<?php esc_html_e('Troubleshooting','simple-debug-info-panel'); ?></h2>

<p><strong><?php esc_html_e('Q: Some of my site pages don\'t seem to have an ID, why not?','simple-debug-info-panel'); ?></strong></p>
<p><?php esc_html_e('Within the WordPress structure, only POSTS and PAGES have IDs (including Custom Post Types). Archive pages simply don\'t. Any page that lists more than one post/page (or excerpts of those) is considered an archive page. Examples are date archives, author archives, category archives, tag archives, search results, etc.','simple-debug-info-panel'); ?></p>

<p><strong><?php esc_html_e('Q: The screen size dimensions don\'t seem right. What up?','simple-debug-info-panel'); ?></strong></p>
<p><?php esc_html_e('It\'s possible that the dimensions shown in the info box are larger than the actual width/height of the page. However, keep in mind that the dimensions displayed are INCLUDING the scrollbar(s). So, if the page has a scrollbar on the right, and the contents are 700 pixels wide, the infobox will say it\'s 716 or so.','simple-debug-info-panel'); ?></p>
<p><?php esc_html_e('Why? Because media queries also take the scrollbar into consideration when calculating width. If there\'s a media query breakpoint set at (say) 700 pixels, this point will be met when the contents of the body are actually around 684 pixels, because the screen itself is 684 plus 16 for the scrollbar = 700. Since the scrollbar-included dimensions of the page are important when it comes to responsive design, the dimensions in the infobox also include the scrollbar -- very relevant to any media queries.','simple-debug-info-panel'); ?></p>

<p><strong><?php esc_html_e('Q: Is it possible to open/close the infobox and then keep the same state when I navigate to another page (without having to change something in the plugin\'s settings)?','simple-debug-info-panel'); ?></strong></p>
<p><?php esc_html_e('No, not in the current version. I\'ll check if that can be done easily in a future version.','simple-debug-info-panel'); ?></p>

<p>
	<strong>
		<?php esc_html_e('Q: I\'ll need more help please!','simple-debug-info-panel'); ?>
	</strong>
</p>

<p class="faq-answer">
	<?php esc_html_e('If you\'re not sure how to use this, or you\'re running into any issues with it, post a message on the plugin\'s','simple-debug-info-panel'); ?>
	<a href="https://wordpress.org/support/plugin/simple-debug-info-panel" target="_blank"><?php esc_html_e('WordPress.org support forum','simple-debug-info-panel'); ?>.</a>
</p>

<p>
	<strong>
		<?php esc_html_e('Q: I\'ve noticed that something doesn\'t work right, or I have an idea for improvement. How can I report this?','simple-debug-info-panel'); ?>
	</strong>
</p>

<p class="faq-answer">
	<?php esc_html_e('Simple Debug Info Panel\'s','simple-debug-info-panel'); ?>
	<a href="https://wordpress.org/support/plugin/simple-debug-info-panel" target="_blank"><?php esc_html_e('community support forum','simple-debug-info-panel'); ?></a> 
	<?php esc_html_e('would a good place, though if you want to add all sorts of -technical- details, it\'s best to report it on the plugin\'s ','simple-debug-info-panel'); ?>
	<a href="https://github.com/senff/WordPress-simple-debug-info-panel/issues" target="_blank"><?php esc_html_e('Github page','simple-debug-info-panel'); ?></a>
	<?php esc_html_e('This is also where I consider code contributions.','simple-debug-info-panel'); ?>
</p>

<p>
	<strong>
		<?php esc_html_e('Q: My question isn\'t listed here?','simple-debug-info-panel'); ?>
	</strong>
</p>

<p class="faq-answer">
	<?php esc_html_e('Please go to the plugin\'s ','simple-debug-info-panel'); ?>
	<a href="https://wordpress.org/support/plugin/simple-debug-info-panel" target="_blank"><?php esc_html_e('community support forum','simple-debug-info-panel'); ?></a>
	<?php esc_html_e('and post a message. Note that support is provided on a voluntary basis and that it can be difficult to troubleshoot, as it may require access to your admin area. Needless to say,','simple-debug-info-panel'); ?>
	<span class="bold-text" style="color:#ff0000;">
		<?php esc_html_e('NEVER include any passwords of your site on a public forum!','simple-debug-info-panel'); ?>
	</span>
</p>
