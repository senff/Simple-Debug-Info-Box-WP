
<h2><?php _e('FAQ','Simple Debug plugin'); ?>/<?php _e('Troubleshooting','Simple Debug plugin'); ?></h2>

<p><strong><?php _e('Q: Some of my site pages don\'t seem to have an ID, why not?','Simple Debug plugin'); ?></strong>
<?php _e('Within the WordPress structure, only POSTS and PAGES have IDs (including Custom Post Types). Archive pages simply don\'t. Any page that lists more than one post/page (or excerpts of those) is considered an archive page. Examples are date archives, author archives, category archives, tag archives, search results, etc.','Simple Debug plugin'); ?></p>

<p><strong><?php _e('Q: The screen size dimensions don\'t seem right. What up?','Simple Debug plugin'); ?></strong>
<?php _e('It\'s possible that the dimensions shown in the info box are larger than the actual width/height of the page. However, keep in mind that the dimensions displayed are INCLUDING the scrollbar(s). So, if the page has a scrollbar on the right, and the contents are 700 pixels wide, the infobox will say it\'s 716 or so.','Simple Debug plugin'); ?></p>
<p><?php _e('Why? Because media queries also take the scrollbar into consideration when calculating width. If there\'s a media query breakpoint set at (say) 700 pixels, this point will be met when the contents of the body are actually around 684 pixels, because the screen itself is 684 plus 16 for the scrollbar = 700. Since the scrollbar-included dimensions of the page are important when it comes to responsive design, the dimensions in the infobox also include the scrollbar -- very relevant to any media queries.','Simple Debug plugin'); ?></p>

<p><strong><?php _e('Q: Is it possible to open/close the infobox and then keep the same state when I navigate to another page (without having to change something in the plugin\'s settings)?','Simple Debug plugin'); ?></strong>
<?php _e('No, not in the current version. I\'ll check if that can be done easily in a future version.','Simple Debug plugin'); ?></p>

<p><strong><?php _e('Q: I\'ll need more help please!','Simple Debug plugin'); ?></strong>
<?php _e('The plugin\'s own page can be found at <a href="http://www.senff.com/plugins/simple-debug-info-panel" target="_blank">http://www.senff.com/plugins/simple-debug-info-panel</a>. If that still doesn\'t help you solve your issue, please do NOT file a bug through the form on my website, but instead go to the plugin\'s support forum on <a href="https://wordpress.org/support/plugin/simple-debug-info-panel" target="_blank">WordPress.org</a> and post a message there.','Simple Debug plugin'); ?></p>

<p><strong><?php _e('Q: I\'ve noticed that something doesn\'t work right, or I have an idea for improvement. How can I report this?','Simple Debug plugin'); ?></strong>
<?php _e('It\'s very possible, or even likely, that something\'s not right; I can only do so much testing and it\'s impossible to test the plugin with ALL themes out there, so there\'s a good chance that it will have some issues with themes that I haven\'t tested. Please report any bugs on the plugin\'s support forum on <a href="https://wordpress.org/support/plugin/simple-debug-info-panel" target="_blank">WordPress.org</a>.','Simple Debug plugin'); ?></p>