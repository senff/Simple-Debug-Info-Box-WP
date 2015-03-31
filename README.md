# Simple Debug Info Panel
* Contributors: senff
* Donate link: http://www.senff.com/donate
* Tags: simple, debug, panel, templates, info
* Plugin URI: http://www.senff.com/plugins/simple-debug-info-panel
* Requires at least: 3.6
* Tested up to: 4.1.1
* Stable tag: 1.0
* License: GPLv2 or later
* License URI: http://www.gnu.org/licenses/gpl-2.0.html

Simple Debug Info Panel shows a little box on your site with helpful debugging info for developers: post/page ID, which template is being used, etc.


## Description

### Summary

Simple Debug Info Panel for WordPress will enable you to instantly see some "under-the-hood" debugging info for your site. With one click (or none at all), you can see which template is being used, what the post/page ID is, the current screen/viewport size, any categories a post is assigned to, and some more.

Every item's visibility can be turned on or off, so you have complete control over what will be shown in the infobox.


### Features

* **Shows template information**: see which template is being used for any page you're looking at.
* **Shows post/page ID**: gives you the internal WordPress ID of the current post/page.
* **Categories/tags**: shows relevant categories and tags of the post/page (if they are not displayed on the page itself).
* **Screensize indicator**: shows the viewport size, updates in real time (so you can figure out why styles within a certain media query are applied or not).
* **Turn on/off which information you want to see**: you can choose whatever you want the infobox to show. 
* **Positioning of box**: choose placement of the box from 4 options (top left, top right, bottom left, bottom right)
* **Default shows or hides**: choose whether infobox should be open or closed/minimized by default
* **Admin Only-mode: make infobox only visible on the front end to users logged in with admin rights.


## Installation 

1. Upload the "simple-debug-info-panel" directory to your "wp-content/plugins" directory
2. In your WordPress admin, go to PLUGINS and activate "Simple Debug Info Panel"
3. Go to SETTINGS - SIMPLE DEBUG INFO PANEL
4. Select the items you want to see in the infobox on the site
5. Party!


## Frequently Asked Questions

### Some of my site pages don't seem to have an ID, why not?
Within the WordPress structure, only POSTS and PAGES have IDs (including Custom Post Types). Archive pages simply don't. Any page that lists more than one post/page (or excerpts of those) is considered an archive page. Examples are date archives, author archives, category archives, tag archives, search results, etc.

### The screen size dimensions don't seem right. What up?
It's possible that the dimensions shown in the info box are larger than the actual width/height of the page. However, keep in mind that the dimensions displayed are INCLUDING the scrollbar(s). So, if the page has a scrollbar on the right, and the contents are 700 pixels wide, the infobox will say it's 716 or so.

Why? Because media queries also take the scrollbar into consideration when calculating width. If there's a media query breakpoint set at (say) 700 pixels, this point will be met when the contents of the body are actually around 684 pixels, because the screen itself is 684 plus 16 for the scrollbar = 700. Since the scrollbar-included dimensions of the page are important when it comes to responsive design, the dimensions in the infobox also include the scrollbar -- very relevant to any media queries.

### Is it possible to open/close the infobox and then keep the same state when I navigate to another page (without having to change something in the plugin's settings)?
No, not in the current version. I'll check if that can be done easily in a future version.

### I'll need more help please!
The plugin's own page can be found [here](http://www.senff.com/plugins/simple-debug-info-panel). If that still doesn't help you solve your issue, please do NOT file a bug through the form on my website, but instead go to the plugin's [WordPress.org support forum](https://wordpress.org/support/plugin/simple-debug-info-panel).

### I've noticed that something doesn't work right, or I have an idea for improvement. How can I report this?
It's very possible, or even likely, that something's not right; I can only do so much testing and it's impossible to test the plugin with ALL themes out there, so there's a good chance that it will have some issues with themes that I haven't tested. Please report any bugs on the plugin's [WordPress.org support forum](https://wordpress.org/support/plugin/simple-debug-info-panel).



## Screenshots

1. Settings screen
2. Infobox


## Changelog

### 1.0 
* Initial release 


## Upgrade Notice 

### 1.0
* Initial release of the plugin