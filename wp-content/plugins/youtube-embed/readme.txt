=== YouTube Embed ===
Contributors: codedart
Tags: download, embed, embedding, iframe, media, play, playlist, responsive, seo, video, widget, youtube
Requires at least: 3.9
Tested up to: 4.4.2
Stable tag: 4.3.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A simple to use method of embedding responsive YouTube videos into your posts and pages but with powerful features for those that need them.

== Description ==

**Version 4 removes a number of existing features. If you're upgrading from a previous version, please [click here](http://www.artiss.co.uk/youtube-embed-removed-features "Removed Features") for further details. If you were using the widget feature then please head to the FAQ before proceeding.**

YouTube Embed is an incredibly simple, yet powerful, method of embedding YouTube videos into your WordPress site. Options include:

* XHTML and HTML5 compliant - works with all the latest browsers
* Dynamic video sizing for responsive sites
* Build your own playlists and play them back however you want
* Automatically generate playlists based on user name or search text
* Create multiple profiles - use them for different videos to get the exact style that you want
* Google compatible metadata is added to the video output - great for SEO!
* Fully internationalized ready for translations. **If you would like to add a translation to his plugin then please [get in touch](http://www.artiss.co.uk/plugin-contact "Contact")**
* Support for Do Not Track
* Compatible with [Video SEO for WordPress](http://yoast.com/wordpress/video-seo/ "Video SEO for WordPress"), [a3 lazy load](https://wordpress.org/plugins/a3-lazy-load/ "a3 lazy load") and [WordPress Video Overlay Ads](https://wordpress.org/plugins/video-overlay-ads/ "WordPress Video Overlay Ads") and many more. In the case of Video SEO and WordPress Video Overlay Ads, their options will even appear under the YouTube Embed menu for total simplicity!
* Use [Turn Off The Lights](https://www.turnoffthelights.com/ "Turn Off The Lights")? This plugin works with it beautifully.
* [iFrame Resizer](https://github.com/davidjbradshaw/iframe-resizer "iFrame Resizer") and [FitVids.js](https://github.com/davatron5000/FitVids.js "FitVids.js") supported to improve content resizing
* Works "out of the box" with 4K, 60FPS and Chromecast - stream your embedded videos to your TV!
* And much, much more!

There are no premium features and no adverts - this is 100% complete and free! See the "Other Notes" tab for how to get started as well as the more advanced features. How easy is it to use? The fine people at [Webucator](https://www.webucator.com "Webucator") have put together an excellent video showing you how to get started with it..

https://www.youtube.com/watch?v=Wc7cvpQS-xQ

== Getting Started ==

To add a video to a post or page simply use the shortcode `[youtube]video[/youtube]`, where `video` is the ID or URL of the video. Alternatively, you can add one (or more) widgets to your sidebar.

Within the administration area, click on YouTube Embed and then General Settings to view and edit default generic settings for the plugin. Also under the `YouTube Embed` menu (see screenshot 1) you can click on the `Profiles` sub-menu to set the default options which define the output of your videos. Any videos you display (unless overridden by parameters - more on that later) will use the settings from the Profiles screen.

Although this document contains a lot of information more is available from a series of linked pages, plus as much information as possible is provided on the various administration pages. Whilst on the administration pages, click on the "Help" button in the top right for some useful tips and links. If anything isn't covered and you're unsure of what it does please ask [on the forum](https://wordpress.org/support/plugin/youtube-embed "WordPress Plugins Forum").

== Advanced embedding options ==

A basic shortcode will embed your video using your default profile settings. However, you may wish to override some of these options on a video-by-video basis - this is done via parameters added to the shortcode.

e.g. `[youtube width=300 height=200]Z_sCoHGIpU0[/youtube]`

Which options are available depends upon the embedding type you're using as well as the viewers set-up (for example, whether they have Flash installed or not). You can specify any of the parameters but they may be ignored. Please see the Profile screen in Administration for details of which parameters are supported by which embed method.

* **annotation** - yes or no, this determines if annotations are shown
* **autohide** - 0, 1 or 2, this parameter indicates whether the video controls will automatically hide after a video begins playing. The default behaviour, a value of 2, is for the video progress bar to fade out while the player controls (play button, volume control, etc.) remain visible. If this parameter is set to 0, the video progress bar and the video player controls will be visible throughout the video. If this parameter is set to 1, then the video progress bar and the player controls will slide out of view a couple of seconds after the video starts playing. They will only reappear if the user moves her mouse over the video player or presses a key on her keyboard.
* **autoplay** - yes or no, should the video automatically start playing?
* **cc** - yes or no, decided whether closed captions (subtitles) are displayed. If you don't specify anything then the user's default will be used.
* **color** - white or red, the colour of the progress bar (see the FAQ about having a white progress bar with the light theme)
* **controls** - 0, 1 or 2, this decides whether the controls should display and when the Flash will load. A value of 0 will not show the controls but 1 or 2 will. A value of 2 will load Flash once the user initiates playback - otherwise it's loaded straight away.
* **disablekb** - yes or no, disable keyboard controls
* **fullscreen** - yes or no, this will add the fullscreen button to the toolbar. This also works with EmbedPlus.
* **height** - the video height, in pixels
* **html5** - yes or no, whether to force HTML5 as the default player or not (if available). NB: This is an undocumented feature and, as such, may not work
* **info** - yes or no, show video information. If displaying a playlist this will show video thumbnails
* **list** - if you've specified your own list, use this to select the way the videos should be output. Should be `random` (display videos in a random order), `single` (show just one video, randomly picked from the list) or `order` (show each video in the original order - this is the default)
* **loop** - yes or no, whether to start the video again once it ends
* **modest** - reduce the branding on the video
* **playsinline** - whether videos play inline or fullscreen in an HTML5 player on iOS.
* **profile** - specify a different default profile (see section on Profiles for further details)
* **ratio** - allows you to define a window ratio - specify just a height or width and the ratio will calculate the missing dimension. Uses the format x:x, e.g. 4:3, 16:9
* **related** - yes or no, show related videos
* **responsive** - whether to use responsive output or not. When switched on the video will resize when your site does (i.e. responsive). If a video width is supplied this will be the maximum width, otherwise full width will be assumed. Height is ignored and will be worked out automatically.
* **search** - yes or no, create a playlist based on a search word. The search word should be specified instead of a video ID. See "Automatically Generate Playlists" option for more details
* **start** - a number of seconds from where to start the video playing
* **stop** - this stops the video at a specific time, given in seconds
* **style** - apply CSS elements directly to the video output
* **template** - specify a template (see section on Templates for further details)
* **theme** - dark or light, display player controls (like a 'play' button or volume control) within a dark or light control bar
* **user** - yes or no, create a playlist based on a user's uploads. The search word should be specified instead of a video ID. See "Automatically Generate Playlists" option for more details
* **width** - the video width, in pixels

== Alternative Shortcodes ==

Within administration, selecting `General Settings` from the `YouTube Embed` menu will provide a list of general options. One option is named `Alternative Shortcode` and allows you to specify another shortcode that will work exactly the same as the standard shortcode of `[youtube]`.

There are 2 reasons why you might want to do this...

1. If migrating from another plugin, it may use a different shortcode - more details can be found in the section named "Migration"
2. If another plugin uses the same shortcode (e.g. Jetpack) this will allow you to specify and use an alternative

The new shortcode can also have its own default profile assigned to it (see the Profiles section for more details on this).

== Widgets ==

Widgets can be easily added. In Administration simply click on the `Widgets` option under the `Appearance` menu. `YouTube Embed` will be one of the listed widgets. Drag it to the appropriate sidebar on the right hand side and then choose your video options - any that aren't specified are taken from your supplied profile.

If you wish to display an automatically generated playlist based on user name or search term, simply change the "ID Type" appropriately and then specify the name or search word(s) where the video ID would normally be entered.

And that's it! You can use unlimited widgets, so you can add different videos to different sidebars.

== Playlists ==

YouTube allows users to create their own playlists - collections of videos that can be played in sequence.

YouTube used to supply Playlist IDs as 16 digits and these can still be used...

e.g. `[youtube]095393D5B42B2266[/youtube]`

Alternatively, if you're using a newer, non-16 digit ID then append 'PL' to the beginning.

e.g. `[youtube]PLVTLbc6i-h_iuhdwUfuPDLFLXG2QQnz-x[/youtube]`

Playlists cannot be used along with the EmbedPlus embedding method.

A better alternative to playlists is the build-in lists function in YouTube Embed - see the Lists section for further details.

== Templates ==

Both in the profile and as a parameter you can specify a template. This allows you to define any CSS that you wish to "wrap" around the YouTube output.

The template consists simply of any HTML that you wish but with `%video%` where you wish the video to appear.

e.g. `<div align="center">%video%</div>`

Be wary that when adding template via a parameter that any HTML included may cause your video to have `<pre>` tags wrapped around it. The easiest way to check and fix this is to view any post in the HTML editor and remove any PRE tags that have been added.

== Profiles ==

You've probably already had a look at the default profile, accessible by selecting `Profiles` from the `YouTube Embed` administration menu option. Here you can specify the default option which will apply to any embedded video.

However, in the top right hand corner is a drop-down box and a button marked `Change profile`. Simply select an alternative profile and click the button and you can then edit the options for this alternative profile. You can even name it as well.

To use this profile, simply use the parameter `profile=` followed by the profile name or number. The options for this profile will then be used.

This could be useful, for instance, for having a separate profile for different parts of your site - posts, sidebar, etc - or for different video types (e.g. widescreen).

By default you have 5 extra profiles - if you wish to have more (or less) this number can be changed from the YouTube Embed settings screen.

== Lists ==

Although this plugin will play standard YouTube playlists their playback options are limited. Instead you can create your own video lists. Under the `YouTube Embed` administration menu is a sub-menu named `Lists`. Select this and you will be shown a screen where you can type in a list of video IDs (or URLS). You can also provide a name for the list.

When saving the list each video is validated.

As with profiles you can select the list from a drop down in the top right-hand corner. You can also change the number of lists from the `Options` sub-menu too.

To use a list, simply specify the list name or number instead of a video ID, as well as a parameter to specify how you wish the list to be played back.

e.g. `[youtube list='order']List 1[/youtube]`

The list parameter allows to to either play each in turn, play them randomly, or have just one played (but picked randomly).

An option within the general options screen allows you to change whether this parameter MUST be used. If switched on, you will gain a performance increase, otherwise the plugin has no way of knowing if you're asking for a playlist so must verify the ID you've specified against all your lists.

== Automatically Generated Playlists ==

YouTube includes options to automatically generate playlists based upon a user name or a search name.

To use, simply use the `user` or `search` parameter to switch the appropriate option on. Then, instead of a video ID or URL, you should specify either the user name or search word(s).

== Third Party Resizing Scripts ==

Within the YouTube Embed settings screen there is an option to set a third party resizing script - either [iFrame Resizer](https://github.com/davidjbradshaw/iframe-resizer "iFrame Resizer") or [FitVids.js](https://github.com/davatron5000/FitVids.js "FitVids.js"). These work alongside the existing IFRAME but try and improve the output, particularly with regard to how the output is sized.

There are no guarantees with these and no support of their specific functionality is provided. However, if the video output is wrong then it's worth trying these.

== Thumbnails ==

YouTube embed also has the ability to return a thumbnail of a video (sorry, this doesn't work with playlists). There are two methods you can use for this - a shortcode or a function call.

Use the function call `youtube_thumb_embed( 'id', 'paras', '', 'alt', 'nolink' )` to add a thumbnail to any part of your theme.

Like the video embed equivalent, the `id` is the video ID and `alt` is the alternative text for the thumbnail image (optional). `nolink`, if set to `true`, will output the thumbnail without a link to the YouTube video, allowing you to add your own.

The parameters are different, however, but, again, are separated by ampersand.

The parameters are as follows...

* **rel** - specify a REL override, e.g. rel="nofollow"
* **target** - specify a TARGET override, e.g. target="_blank"
* **width** - this specifies the width of the thumbnail image
* **height** - this specifies the height of the thumbnail image
* **version** - which version of the thumbnail to use. This can be `default`, `hq` (for a high quality version of the default image), `start`, `middle` or `end`. The latter 3 indicate where from the video the thumbnails are taken from

e.g. `youtube_thumb_embed( 'id', 'rel=nofollow&target=_blank', '', 'Demo Video' )`

To use the shortcode method, insert `[youtube_thumb]id[/youtube_thumb]` into a post or page to create a thumbnail of the relevant video ID which, once clicked, will open up the appropriate YouTube page.

Like the function call above, you can specify a number of parameters. They are the same as detailed above but with the addition of one further parameter...

* **alt** - specify some `ALT` text for the thumbnail image

e.g. `[youtube_thumb target="_blank" alt="Demo video"]id[/youtube_thumb]`

This overrides the `TARGET` and `ALT` elements of the thumbnail.

You can also use `nolink` as a parameter with the shortcode, which works in the same way as with the function call.

== Shortened URL ==

You may return a short URL for any YouTube video by way of either a function call or a shortcode.

For a function call add `youtube_short_url( 'id' )` to your code to return a URL (note that this is not written out, but returned as a value), where `id` is the video ID.

e.g. `<a href="<?php echo youtube_short_url( 'Z_sCoHGIpU0' ); ?>"Click here for video</a>`

This will create a link to a video using the short URL standard.

To use the shortcode method simply insert `[youtube_url id=xx]` anywhere within a post to return a shortened URL. `xx` is the ID of the video.

== Downloading Videos ==

If you wish your users to be able to download a YouTube video or playlist then you can do this automatically or manually via either a shortcode of PHP function call.

In the Profiles screen within administration there is an option to automatically show a download link. You can specify some text or HTML to display as well as CSS.

If you'd prefer to do this manually then the function call is named `get_video_download` and has one parameter - the video ID. It will return the download link URL.

e.g. `<a href="<?php echo get_video_download( 'Z_sCoHGIpU0' ); ?>">Download the video</a>`

Alternatively, you can use the shortcode `download_video`. The content to link is specified between the open and close shortcode tags and there are 3 parameters...

* **id** - The ID of the video or playlist. This is required.
* **target** - The target of the link (e.g. `_blank`). This is optional.
* **nofollow** - yes or no, use this to specify whether a `nofollow` tag should be added to the link. This is optional and by default it will be included.

e.g. `[download_video id="Z_sCoHGIpU0" target="_blank"]Download the video[/download_video]`

== Further Embedding Options ==

Under the `YouTube Embed` administration menu is a sub-menu named `General Settings`. Select this and find the section named `Embedding`. There are 2 options here...

1. Add Metadata - by default, RDFa metadata is added to video output. This can be switched on or off as required (see the FAQs for more information about metadata usage).
2. Feed - videos will not appear in feeds so use this option to decide whether you want them to be converted to links and/or thumbnails.

== Third Party Plugins ==

From the `YouTube Embed` administration menu there is a `3rd Party Plugins` sub-menu. This will list a number of WordPress plugins that can work alongside YouTube Embed to add extra functionality. From this screen you can view, install and see the status of each plugin.

In some cases activating these plugins will cause their settings screen to also appear under the `YouTube Embed` menu, for extra convenience.

**By listing these plugins, we provide no guarantees that they work correctly and we certainly don't provide any support for them.**

If you'd like your own plugin adding to this list then please [get in touch](http://www.artiss.co.uk/plugin-contact "Contact").

== Reviews & Mentions ==

[Your YouTube Plugin is fantastic-it just saved my life on this site. Thank you!](https://twitter.com/AaronWatters/status/237957701605404672?uid=16257815&iid=am-130280753913455685118891763&nid=4+248 "Twitter - Aaron Watters") - Sonic Clamp.

[New Technology Finds The Most Buzzed-About Parts Of Videos](http://www.socialtimes.com/2011/03/new-technology-finds-the-most-buzzed-about-parts-of-videos-interview/ "New Technology Finds The Most Buzzed-About Parts Of Videos") - SocialTimes.

[Andesch tips on WordPress plugins!](http://andershagstrom.se/andesch-tipsar-om-wordpress-plugins/ "Andesch tipsar om WordPress-plugins!") - Anders.

[Critical Mass](http://www.bikinginmemphis.com/2011/03/26/critical-mass/ "Critical Mass") - Biking in Memphis.

== Installation ==

YouTube Embed can be found and installed via the Plugin menu within WordPress administration. Alternatively, it can be downloaded and installed manually...

1. Upload the entire `youtube-embed` folder to your wp-content/plugins/ directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Now you can add the shortcode to your posts and pages!

== Frequently Asked Questions ==

= I've upgraded to version 4.0+ from an earlier version and I was using the widget feature to display videos =

I previously allowed some, although not all, parameters to be specified within the widget. However, as you can simply create your own profile for widgets I have removed this and, without leaving lots of redundant code behind, it was difficult to keep this backwards compatible.

Therefore, if you're upgrading you may find your widgets don't now display correctly. The best thing to do, beforehand if you can, is to create a profile just for the widgets and assign that to each. You'll probably find the video size is the bit most likely to cause issues. Apologies for this.

= How do I find the ID of a YouTube video? =

If you play a YouTube video, look at the URL - it will probably look something like this - `http://www.youtube.com/watch?v=L5Y4qzc_JTg`.

The video ID is the list of letters and numbers after `v=`, in this case `L5Y4qzc_JTg`.

= The video output is overlapping or stuttering =

If you go into the Profile screen in Administration there is a "Window Mode" option. This defines how Flash output interacts with any other around it. "Window" is the default and gives good performance but may cause overlapping. If overlapping is causing an issue try "Opaque".

= I'm getting an error saying that "an alternative plugin is using the [youtube] shortcode"  =

As this suggests another plugin that you have installed is using the same shortcode as YouTube Embed. That means that use of the `youtube` shortcode won't work. You have 2 possible actions to take...

1. Disable the conflicting plugin. If it's Jetpack then you can disable the Shortcode Embeds module.
2. Leave it as it is and use the option to use a second shortcode with this plugin. Head to the YouTube Embed settings screen and you can set up a secondary shortcode. You can also switch off the nag message too from here.

= The "autostart" feature is not working in iOS =

Unfortunately, this is a restriction that has been put in place by Apple.

= I can't get the video to play at a specific resolution by default =

There is no way to specify this - YouTube makes the decision on which version to play depending on a number of factors.

= There are black borders on top/underneath my video =

This is usually due to using a different ratio than the video was designed for. If you're not sure which ratio to use head to its page on YouTube, click on Share and then Embed and then Show More. A video size will be shown, which you can use to work out the correct ration for the video.

= The controls under the video don't display properly when using Firefox =

This is a bug in Firefox. Short term, switch on SSL in the Profiles screen and it will work. Longer term, I've [raised a bug report with Mozilla](https://bugzilla.mozilla.org/show_bug.cgi?id=1223515 "Bug 1223515 - Broken images in YouTube embedded player when not using SSL").

= The generated code does not cleanly validate =

No, by default it doesn't but it works absolutely fine as it. However, if you really must cleanly validate against HTML5 or transitional XHTML then head into the YouTube Embed settings screen and you'll find an option to "Improve Validation". Tick this and Save and it should validate.... UNLESS you have the metadata option switched on, in which case it won't validate still (sorry, I'm a slave to Google on this one!). Switch that off though and you're 100%.

One thing to note - by switching on "Improve Validation" you'll extend the length of the URL line that's passed to YouTube. Please see the next FAQ to understand this better.

= I'm getting the error "The maximum URL length has been exceeded" when trying to view a video =

When embedding a video a URL for YouTube is generated - this contains all the non-default parameters that you've specified and, if you've created a manual playlist, all of the video IDs. Unfortunately, URLs can only be 2000 characters in size. If this is exceeded you'll get the above error message when you try and view the video.

The solution is to reduce this down by reducing down your playlist or, if you have the "Improve Validation" settings switched on, switching that back off.

= I have another issue or a request =

Before reporting it please bear in mind that this plugin uses the standard YouTube API. Adding extra functionality to the player itself is not possible and there are [known issues](https://code.google.com/p/gdata-issues/issues/list?q=label:API-YouTube "YouTube API Known Issues") with it. I would also recommend performing a Google search for your issue too first, as this will often resolve a lot of queries.

== Screenshots ==

1. YouTube Embed in the administration menu
2. The main options screen
3. The profiles screen
4. The lists screen - videos have been added and validated. The drop-down help is also shown
5. The default widget options
6. The default visual editor options with the YouTube Embed button
7. The third party plugins menu

== Changelog ==

= 4.3.3 =
* Maintenance: One of the URLs in the README is being reported as being infected by malware. I have therefore removed this URL but have changed the release number, although no code has changed, to force the new version to download to existing users

= 4.3.2 =
* Bug: Correct validation of list field, which was preventing more than one video being specified
* Bug: Fixed the URL for the settings link in the plugin meta

= 4.3.1 =
* Bug: Had removed a function (by accident, you understand) that converted the old alternative shortcode settings to a new format. The result is that the conversion didn't take place and an array was passed as a shortcode name to WordPress Core, generating an error. The function has been added back in

= 4.3 =
* Enhancement: Added new "Third Party Plugins" screen, which lists third party plugins that work alongside YouTube Embed, adding extra functionality. You can view, install and see the status of these plugins from this screen
* Maintenance: Moved the settings back to the YouTube Embed menu
* Maintenance: Renamed menus to be more specific
* Maintenance: Updated the function names, which were still using the out-dated "vye" prefix

= 4.2.1 =
* Bug fix: Quotes were not being dealt with correctly in the template field. Now corrected.

= 4.2 =
* Enhancement: Re-written the core embedding code. Redundant code removed and, for the remaining code, re-imagined to improve performance
* Enhancement: Massively changed how the plugin retrieves saved options and, in particular, how I populate default values. The result? Even better performance
* Enhancement: Reviewed and reduced the calls to fetch the options
* Enhancement: Added a new general option to allow you to force a list type to be specified before a list can be used. The reason? By doing this the code doesn't have to check if the ID it a list name each time and it improves performance. For those upgrading this will be switched off by default to maintain backwards compatibility
* Enhancement: Admin bar options only appear if viewing the admin bar on the site (showing it whilst in the admin screens seemed rather pointless)
* Enhancement: If you use [WordPress Video Overlay Ads](https://wordpress.org/plugins/video-overlay-ads/ "WordPress Video Overlay Ads") or [Video SEO for WordPress](http://yoast.com/wordpress/video-seo/ "Video SEO for WordPress") then the settings menus will appear under the YouTube Embed menu
* Enhancement: SSL options removed as it's now used by default, including with thumbnails and schema.org links
* Enhancement: Improved the RSS feed output for search or user upload requests
* Maintenance: Removed some deprecated elements in the code
* Maintenance: Updated includes so that plugin folders were not hardcoded
* Maintenance: Updated which functions I was using to retrieve folder names so that they are fully SSL compatible
* Maintenance: Removed a load of redundant functions
* Maintenance: Replaced a function with a PHP command but this means that the plugin is no compatible with PHP versions below 5.1
* Maintenance: Tidied up the list screen further
* Maintenance: Replaced the 'dynamic' parameter with 'responsive' which, as a name, is far more accurate. 'dynamic' will still work, though.
* Maintenance: Improved admin screen validation and sanitisation

= 4.1.1 =
* Bug fix: Corrected settings URL in plugin meta.
* Bug fix: If plugin has never run before, ensure a default options array is generated.
* Maintenance: Removed donation options and updated branding.

= 4.1 =
* Enhancement: Added 'Plays inline' option for iOS devices.
* Enhancement: Added extra Closed Caption option to better reflect how YouTube works - either on, off, or user default.
* Enhancement: Added new option to force HTML5 playback (if available). This is an undocumented feature and, as such, may not actually work, depending on YouTube's current mood. If YouTube aren't going to support it then I'm certainly not going to so please don't shout if it doesn't work.
* Enhancement: Lovely new icons for the lists page.
* Enhancement: Improved the layout of the demo video on the profiles page.
* Enhancement: Added a count to the profiles and lists screen to indicate how many are set up. Also showed on drop-down which of the profiles/lists are not defined.
* Enhancement: Changes made to add compatibility with a3 lazy load.
* Enhancement: Removed the caching - it created the output up to 3 times quicker but when that's 0.005 seconds it's not worth the hassle that comes with it. I started making performance improvements to compensate then realised it was such a big change that it would be best spun off as it's own seperate update - version 4.2. Look out for it.
* Enhancement: Removed limitation of only being able to display up to 30 lists or profiles.
* Enhancement: When you can select a profile from another screen (e.g. defining a profile to an alternative shortcode) then only defined profiles will be listed.
* Enhancement: Added general option to specify the YouTube interface language as well as to suppress debug output in the resulting code.
* Enhancement: Fixed validation errors against thumbnails.
* Enhancement: Changed the "Frameborder" option to a more general "Improve Validation" which does, well, just that. It improves the generated markup so that it will validate better (if that's your bag).
* Enhancement: Added option to use a third party script to handle content resizing. Implemented [iFrame Resizer](https://github.com/davidjbradshaw/iframe-resizer "iFrame Resizer") v3.5.1 and [FitVids.js](https://github.com/davatron5000/FitVids.js "FitVids.js") 1.1.
* Enhancement: If another plugin is using the same shortcode as this I now output a prompt in the admin area. Also added a setting to turn off this prompt just in case you're using the secondary shortcode and are happy for this.
* Enhancement: Re-written code for help screens, including adding more information and additional tabs.
* Maintenance: Moved the settings page to, well, the Settings menu option. It makes sense.
* Maintenence: Removed the enable of the JS API, which is now deprecated.
* Maintenance: Improved the admin screen output code - had made it more WordPress standard in version 4 but got some of the code wrong.

= 4.0.2 =
* Maintenance: Not really a bug, but in some circumstances I wasn't initialising a variable used when generating the embed code. It worked fine but wasn't best practise so fixed. Sloppy.
* Maintenance: Modified the default parameters so new user videos should appear with the same options as on YouTube itself. Consistent.
* Maintenance: I ABSOLUTELY refuse to call this a bug. But I was calling get_the_excerpt() to build some of the video meta data. For some reason, still unknown to me, other plugins were crashing as a result of it. I've removed it for now but am investigating the cause. Frustrating.
* Enhancement: WMODE is now only added to the embed URL if it's anything other than the default. Shrinkage.

= 4.0.1 =
* Maintenance: Left some debug code in by mistake. Doh. Sometimes I'd forget my own head if it wasn't screwed on.... Apologies to those affected.

= 4.0 =
* Maintenance: Removed a number of redundant/broken features. [Learn more](http://www.artiss.co.uk/youtube-embed-removed-features "Removed Features").
* Maintenance: Updated download link to use KeepVid.
* Maintenance: Re-written admin screen to use WordPress standard method of displaying settings. Oh, and the widget settings too.
* Maintenance: ...speaking of which, revised the options available to widgets.
* Maintenance: Merged many of the files where there wasn't a huge amount of content.
* Maintenance: Renamed menu slugs as they were too generic and may cause clashes with other plugins or themes that are silly enough to do the same thing.
* Enhancement: Revised profile screen to make it clearer, via the art of the icon, which parameters are compatible with which embed type.
* Enhancement: If you go a bit "ape" with the parameters and manual playlists, it's possible to exceed the URL size limit. I've now put a check in place to report this, if it occurs.
* Enhancement: Added modest branding as a parameter (before was only selectable via the profile screen).
* Enhancement: Improved the meta data.
* Bugs: Many of them. Fixed. Hoorah.

= 3.3.5 =
* Maintenance: Added missing text domain, ready for automatic translation.

= 3.3.4 =
* Maintenance: Updated admin screen headings for compatibility with 4.3.
* Maintenance: Updated demo video on profile page. Just because.
* Bug: Fixed (I hope) the problem with the editor button not appearing for some users. Thanks to Mark Aarhus for getting to the bottom of this for me.
* Enhancement: Added donation link to plugin meta. Because I'm worth it.

= 3.3.3 =
* Maintenance: Now working with newer playlist IDs (README instructions chaneged to reflect how to do this)
* Maintenance: Resolved widget issues with version 4.3 of WordPress
* Maintenance: Eliminated XSS problem in admin profile screen

= 3.3.2 =
* Bug: One of the files was corrupt in the previous release - this is now fixed. Sorry :(

= 3.3.1 =
* Maintenance: Remove reference to Google API, as videos are now not displaying as a result of v2 being retired. Will update the plugin more fully in future release

= 3.3 =
* Maintenance: Ding, dong Applian has gone. Removed Vixy branding, updated README and language files to match
* Maintenance: Removed those Vixy download links and restored the old method - will enhance this in a future release
* Maintenance: Plugin had too much baggage so it could support old versions of WordPress. Why? Updated it to only support more recent versions but have removed lots of un-needed guff as well. The result - this version is 15% slimmer than the previous version. Win!
* Maintenance: Spruced up the admin screens to match the new WordPress styling
* Bug: Resolved a number of bugs as reported by users and spotted by myself. Thanks all! More fixes to come

= 3.2.1 =
* Bug: Fixed issue where playlist was appearing for single videos
* Maintenance: Improved Metadata standard

= 3.2 =
* Bug: Prevented download bar SPAN from appearing even when switched off
* Bug: Fixed issue that caused playlists to not appear
* Enhancement: Added new shortcode for displaying video comments
* Enhancement: IFRAME output now includes metadata
* Enhancement: Editor button will now work with MCE4 editor (WP 3.9+)
* Enhancement: SVG icon used in admin menu for WP 3.8+

= 3.1 =
* Enhancement: Allow user to specify video resolution required (experimental)
* Enhancement: Different languages can be specified for transcripts, other than the English default
* Enhancement: API enabled on scripts by default, allowing for third-party modification
* Enhancement: Can now add a link to YouTube under a video
* Maintenance: Removed adverts from administration screen
* Maintenance: Changed download bar default to be opt-in and re-worded option text

= 3.0.1 =
* Bug: Fixed menu options shown in admin bar
* Maintenance: Updated links to point to instructions on Vixy.net website
* Enhancement: Validate download bar code to ensure it's secure
* Enhancement: Passing blog language to language bar for i18n

= 3.0 =
* Maintenance: Changed name, updated adverts, removed donation and sponsorship requests
* Maintenance: Renamed function to match new name and also removed prefix from files, which were not required
* Maintenance: Checked and updated all help URLs
* Maintenance: Removed about and instruction pages which were felt were no longer needed
* Maintenance: Updated icons
* Enhancement: Updated download links to use code from Vixy. This is now switched on by default
* Enhancement: Added option to provide an affiliate ID for use with the download bar - blog owners can make 30% from sales generated
* Enhancement: Simplified the menu access rules which has resulted in resolving a number of existing issues
* Bug: Fixed PHP error when allowing shortcodes in widgets

= 2.7 =
* Maintenance: Using new website for video download link
* Maintenance: README updated with new compatibility details and modified FAQs
* Bug: Fixed a bug where some option screen text was not displaying
* Bug: Fixed the feature pointer, which was no longer working
* Enhancement: Added profile options to allow you to switch on video download link, as well as style the output

= 2.6.2 =
* Bug: Fixed bug in uninstall routine
* Enhancement: Replaced user of print_r in cache key generator with serialize, as this can cause problems with some hosting configurations

= 2.6.1 =
* Bug: Fixed minimised script that adds editor button
* Bug: Updated broken advert links
* Bug: Fixed link in admin bar when using WP 3.1 - 3.3
* Bug: Removed un-necessary cookie update that was causing errors in some situations
* Maintenance: Updated WP 3.3+ admin bar options to correctly reflect permissions, naming and ordering of equivalent admin menu

= 2.6 =
* Bug: Fixed a bug that means videos have zero width on new installations until the default profile is updated (thanks to Aidan from [Noise Republic](http://www.noiserepublic.co.uk "Noise Republic") for reporting that)
* Bug: Corrected URLs pointing to help screens
* Bug: Resolved issue where translated IDs were not corrected if included in a URL (thanks to kchayka for reporting that)
* Bug: Fixed problem where video ID is not found in full URL if not specified first (thanks to christopherw for reporting that)
* Bug: Modest branding profile switch wasn't doing anything - the option was hard-coded on. Now corrected
* Bug: User defined error message now decodes correctly (thanks to kchayka for reporting that)
* Bug: No longer caches the video output if a random playlist has been selected
* Maintenance: Updated advertisement engine code
* Maintenance: Renamed README menu to Instructions
* Maintenance: Assorted on-screen wording improvements
* Maintenance: Removed title option as it's un-supported
* Maintenance: Updated the uninstall routine
* Maintenance: Cleaned code and updated translation files
* Enhancement: Added Do Not Track compatibility. Once active, if user has Do Not Track in use then cookies will not be stored
* Enhancement: New option to specify the shortcode that the editor button uses. A cookie is used to store this
* Enhancement: New option to switch on shortcodes in widgets. This will allow all shortcodes in widgets, though, not just those for this plugin
* Enhancement: Reviewed and updated access right to admin screen. Added option to choose what level has access to profiles and/or lists screen
* Enhancement: Many functions were only activated if user was not in Administration screens. However, using AJAX on your site triggers the administration flag and, hence, the functions would not work. Changed this
* Enhancement: Added option to modify access to Profile and Lists screen
* Enhancement: Improved the cache clearing option and statistics
* Enhancement: Reflected on profile screen that modest branding now works with HTML5 player
* Enhancement: Added option to thumbnail output to suppress the link, so that you can add your own
* Enhancement: Updated "Controls" option to support new third parameter and update definitions. Ensured backwards compatibility with old parameter options

= 2.5.6 =
* Maintenance: Restricted access to Options and Profiles screen to administrators
* Bug: Fixed bug which caused errors to be generated on new installations of plugin
* Enhancement: Set a default width if the `content_width` global variable is set to zero

= 2.5.5 =
* Maintenance: Updated sponsorship - now includes option to switch off if user has donated
* Maintenance: Updated options screen to reflect the fact that the `related` and `color` parameters are now supported by the HTML5 player
* Maintenance: Updated options screen to show that the `info` parameter, if used alongside a playlist will show thumbnails of the videos
* Maintenance: Removed redundant GA code, which was never used
* Maintenance: Combined scripts
* Bug: Fixed internationalisation
* Bug: Fixed output of video information on the Lists option screen
* Bug: Modified cache key so that length does not exceed MySQL field maximum
* Bug: Added close anchor for media meta - causes unclosed anchor under IE9 (thanks to Marcel Bootsman for identifying this)
* Bug: Responsive video was not working on a demonstration video in Profile screen

= 2.5.4 =
* Bug: Fixed bug that prevented some fields in options screens to not save

= 2.5.3 =
* Bug: Fixed further issues with the widget code (thanks to Rose-Anne Constantineau for reporting it and helping me test the result)
* Maintenance: Improved some of the internationalisation texts
* Maintenance: Neatened up some of the code output

= 2.5.2 =
* Bug: Fixed a bug where widgets weren't showing single videos (thanks to Josh Callaghan for reporting this)

= 2.5.1 =
* Bug: Fixed a bug with Admin Bar when using WP 3.1 - 3.3 (thanks to Carl D'Halluin for finding this)

= 2.5 =
* Maintenance: Updated code to work with new playlist options
* Maintenance: Removed embedded URL option due to issues with existing code (see FAQ for details)
* Maintenance: Added further FAQs based on common forum queries
* Maintenance: Wording on options screens changed to better identify differences between players
* Maintenance: Added advertisement to profile screen
* Maintenance: Modified demonstration video and made sponsorship request more visible
* Maintenance: Changes the YouTube admin screen icon
* Enhancement: Download link now uses deturl.com
* Enhancement: Admin Bar link improved in WP 3.3 onwards
* Enhancement: New user upload and search features added
* Enhancement: Now supports ability to specify the time to stop video playback
* Enhancement: Default windowing mode changed to improve performance
* Enhancement: FRAMEBORDER is switchable for the purpose of HTML5 compatibility
* Enhancement: Added internationalisation
* Enhancement: README in admin menu now shows the corresponding README for the version of the plugin you have installed, rather than the latest one
* Enhancement: Added option to admin screen to clear video cache (see FAQ for details)
* Enhancement: Allow recursive shortcodes - that is, shortcodes within the YouTube shortcode
* Bug: Fixed bug in retrieving the video title
* Bug: Resolved various debug messages
* Bug: Fixed bug in MCE button JavaScript

= 2.4.1 =
* Maintenance: Removed dashboard widget

= 2.4 =
* Maintenance: Re-sequenced the changelog in the README
* Maintenance: Removed drop shadow option
* Maintenance: Re-design of widgets, reducing number of parameters down to make it easier to use - use profiles to modify missing parameters
* Maintenance: Updated YouTube icons
* Enhancement: Added frameborder="0" to IFRAME code
* Enhancement: Added Privacy-Enhanced mode. Doesn't work with Chromeless player.
* Enhancement: Added `title` option, so you can name the video
* Enhancement: Added `ssl` option, allowing you to override whether HTTP or HTTPS is used for the video
* Enhancement: Added `dynamic` option (and matching Profile switch) to allow users to request dynamically resizing video (responsive). Additional option to allow specified width to be maximum
* Enhancement: Made `modestbranding` a switchable option (switchable in profile options but not on video-by-video basis) due to issues with Apple devices
* Enhancement: Improved matching of URL embedded into post
* Enhancement: If you have the [README Parser plugin](http://wordpress.org/extend/plugins/wp-readme-parser/ "README Parser") installed then a new sub-menu will display the README instructions
* Enhancement: Use WP 3.3 Feature Pointer to highlight new menu when plugin is activated
* Bug: Ensure `showinfo` parameter is set correctly
* Bug: If width or height is missing from Profile screen then fill it in based on widescreen format. Otherwise, causes video to break
* Bug: Video information was being fetched from caching even if option selected to switch it off. Fixed!

= 2.3.1 =
* Maintenance: Removed the sponsorship

= 2.3 =
* Enhancement: Editor button will add text between shortcodes if no URL or ID is specified
* Enhancement: Square brackets are stripped from alternative shortcodes on option screen - text added to warn against this too
* Enhancement: Added Chromeless player option
* Enhancement: Increased maximum output length of profile and list names to 30 characters
* Bug: Fixed incorrect listing of long profile or list names
* Bug: Fixed INCLUDE bug in widgets.php

= 2.2 =
* Maintenance: Updated dashboard widget to latest version
* Maintenance: Added advertising banners to options screen - these can be turned off if you donate
* Enhancement: Replace WP_PLUGIN_URL with plugins_url()
* Enhancement: Added H and W as alternative shortcode parameters to HEIGHT and WIDTH
* Enhancement: Editor button should appear for anyone from editor role upwards
* Enhancement: Removed maximum length from profile and list names. However, only first 20 characters will appear in lists

= 2.1 =
* Enhancement: New option to switch API options (where HTTP or HTTPS, display messages or not or even switch off)
* Enhancement: Output video playback errors as XHTML comments. Output to post a generic message which can be changed in the options
* Enhancement: Video information is shown in lists screen when first entering (no need to press Save button to display)
* Enhancement: Added new `color` parameter, which allows you to specify the color of the progress bar
* Enhancement: Added new `theme` parameter, allowing you to specify if the player is dark or light skinned
* Enhancement: Added new `https` parameter, allowing you to use HTTPS instead of HTTP for the video display
* Enhancement: Added new `version` parameter to thumbnails, allowing different versions (including a high resolution one) to be displayed
* Enhancement: Added new administration option to allow the thumbnail used in RSS feeds to be specified
* Enhancement: Log the current plugin version into the database. This may be of use in future upgrades to detect which version the user is upgrading from
* Bug: Fixed video title no longer being fetched since 2.0.3 (because of using v2 of API)
* Bug: Fixed some error output - due to changes made in an earlier release some errors would not display

= 2.0.4 =
* Enhancement: Removed HTTPS access to gdata API - will add a switchable option for this in a later release

= 2.0.3 =
* Enhancement: Decode any passed `template` parameters, as WP may have encoded the content first
* Enhancement: Improved file handling
* Enhancement: Now using HTTPS and version 2 of YouTube gdata API
* Enhancement: New general option to switch off reporting of API errors - will simply accept ID and work out type
* Maintenance: Added details to the README to cover issues with `style` backwards compatibility and YouTube API

= 2.0.2 =
* Enhancement: Strip tags from video ID, in case any have crept in
* Enhancement: Tidied some of the widget controls
* Enhancement: You can now specify YouTube short URLs as video IDs
* Bug: Removed reference to jscolor.js script, which isn't used
* Bug: Video IDs beginning with numbers are being confused with list numbers
* Bug: Corrected problem with random single videos being picked from a list
* Bug: Fixed problem with list where one video was being ignored and another repeated
* Bug: Modified widget code to allow for all states to be allowable. Defaults updated
* Bug: YouTube documentation states that if you don't specify the fullscreen parameter it will default to off. It doesn't. Corrected in the code

= 2.0.1 =
* Enhancement: Changed cache key encoding so that it was compatible with PHP 4
* Enhancement: Added autoplay option to EmbedPlus
* Enhancement: Re-instated `style` option, allowing you to apply a direct set of CSS elements to the output - a requirement if you wish to add a border to the video, for instance
* Maintenance: Updated screens and documentation to show the `start` parameter works with EmbedPlus
* Bug: Fixed incorrect caching of options - was only changing if override parameters were modified
* Bug: Video Information Cache will no longer reset to zero if the Embed cache is greater
* Bug: Added random ID to EmbedPlus output to resolve a bug that can affect IE users

= 2.0 =
* Maintenance: Renamed to Artiss YouTube Embed from YouTube Embed
* Maintenance: Major re-write, using new coding standards
* Maintenance: AS3 player is now used, AS2 has been retired
* Maintenance: Compliancy and browser checked - XHTML and HTML5 compliant and works in all the latest browsers
* Maintenance: README completely re-written, contextual help added to admin screens and links to further information
* Enhancement: New administration screens, introducing multiple profiles and playlists
* Enhancement: Both OBJECT and IFRAME versions can be selected
* Enhancement: Migration options added, allowing compatibility with other similar plugins
* Enhancement: Can now specify full video URL as well as video ID
* Enhancement: No need to use separate shortcode for playlists, as they are automatically detected. Video IDs are also now validated
* Enhancement: Options to allow YouTube URLs not within shortcodes to be accepted, as well as in comments
* Enhancement: RDFa metadata added to code output
* Enhancement: Caching of code and ID checking to improve performance
* Enhancement: Templating system replaces CSS specification
* Enhancement: Improved editor button and link added to admin bar
* Enhancement: Many, many more changes - too many to list!

= 1.5 =
* Enhancement: Added clone of 'youtube' shortcode, called 'youtube_video'
* Enhancement: Editor now has YouTube button, which inserts the YouTube shortcode (this can be switched off in the options screen)
* Enhancement: Added new option to disable keyboard controls
* Enhancement: Added option to supply a ratio, in case height or width are not supplied - the missing parameter will then be calculated
* Enhancement: Option to create a download link (for video and playlist) using function call or shortcode
* Enhancement: You can now change on the options screen which set of parameters the demonstration video uses (i.e. "normal" or EmbedPlus). This allows you to try your options on a different video type without switching to it.

= 1.4.2 =
* Enhancement: Added keyboard disable option
* Bug: Fixed bug which meant that people upgrading from previous versions may not be able to display video until they've been to the options screen and re-saved their default options

= 1.4.1 =
* Enhancement: HD option is available with EmbedPlus - updated the admin and widget screen to reflect this

= 1.4 =
* Maintenance: Tidied up code
* Enhancement: Now supports multiple widgets - widget code completely re-written
* Enhancement: Support for EmbedPlus added
* Enhancement: Added option to suppress links back to YouTube
* Enhancement: Added functions and shortcodes for returning and outputting available transcripts

= 1.3.1 =
* Enhancement: New widget option to specify title

= 1.3 =
* Enhancement: Added transparency option so that videos won't cover up layers

= 1.2 =
* Enhancement: Minor changes to the XHTML code to prevent warnings from certain validators

= 1.1 =
* Maintenance: Updated test video on options screen, as previous one had been removed
* Maintenance: Confirmed WP 3.0 compatibility
* Enhancement: Resulting XHTML code is better formatted, with comments identifying code location

= 1.0 =
* Initial release

== Upgrade Notice ==

= 4.3.3 =
* Update to remove a malware-reported URL from the README

= 4.3.2 =
* Upgrade to fix a bug with manual lists being saved

= 4.3.1 =
* Upgrade to fix an urgent issue that can generate WordPress errors

= 4.3 =
* Upgrade to add a new third party plugin screen

= 4.2.1 =
* Important update to fix a bug with the template field

= 4.2 =
* Who needs caching when the code works this fast? It's now 365% quicker than version 4.1. Completely re-written core code for rip-roaring speed

= 4.1 =
* Loads and loads of new features. Because I love you all.

= 4.0.2 =
* Minor bug fixes

= 4.0.1 =
* Upgrade to remove some debug code

= 4.0 =
* Fixed, squeezed and reduced. Make sure you read the changelog before upgrading!

= 3.3.5 =
* Update with text domain, ready for automatic translation

= 3.3.4 =
* Assorted fixes and enhancements inc. (I hope) a fix to the editor button not working

= 3.3.3 =
* Fix to resolve multiple urgent issues

= 3.3.2 =
* An urgent fix to the urgent fix, due to a corrupt file

= 3.3.1 =
* Urgent fix to get videos displaying. Alternatively, switch off API in Options screen

= 3.3 =
* Update to fix assorted bugs and to remove the redundant Vixy branding

= 3.2.1 =
* Update to bring metadata up to latest standards and to fix playlist issue

= 3.2 =
* Update to add new features, including the ability to show a video's comments

= 3.1 =
* Update to add new features including video quality option

= 3.0.1 =
* Update to fix admin bar links and add some further security improvements

= 3.0 =
* Update for bug fixes and enhancements including a new video download option with affiliate scheme

= 2.7 =
* Update to fix some bugs and add minor new features

= 2.6.2 =
* Update to fix an uninstaller bug and a problem that may affect some hosts

= 2.6.1 =
* Update to fix some bugs introduced in 2.6

= 2.6 =
* Upgrade to implement numerous bug fixes and enhancements

= 2.5.6 =
* Upgrade to fix critical bug for new installations

= 2.5.5 =
* Upgrade for various bug fixes and maintenance updates

= 2.5.4 =
* Upgrade to fix an issue with options not updating

= 2.5.3 =
* Upgrade to fix issues with widgets

= 2.5.2 =
* Upgrade if you use widgets to display videos

= 2.5.1 =
* Upgrade if you are using a WordPress version before 3.3

= 2.5 =
* Upgrade to add a number of new features (including automatic generation of playlists based on user name or search term) and fix some bugs

= 2.4.1 =
* Upgrade to remove the dashboard widget

= 2.4 =
* Numerous improvements, including new option for responsive video output

= 2.3.1 =
* Upgrade to remove the sponsorship

= 2.3 =
* Assorted bug fixes and minor improvements. Also added Chromeless player.

= 2.2 =
* Assorted minor improvements

= 2.1 =
* New options to change player colors, chose your thumbnails and control API usage

= 2.0.4 =
* Fixed SSL bug by removing HTTPS access to API

= 2.0.3 =
* Removed secure API access as this was causing some users issues

= 2.0.2 =
* Further update to fix a few minor bugs found in 2.0. A few small enhancements have also been made

= 2.0.1 =
* Update to fix a few minor bugs found in 2.0 and add a couple of small enhancements

= 2.0 =
* Upgrade to take advantage of many new features. Code completely re-written

= 1.5 =
* Upgrade to add a number of new options including video size ratios, disabling keyboard controls, an editor button and different demonstration video options on the admin screen

= 1.4.2 =
* Upgrade is you upgraded to version 1.4 or 1.4.1 from a previous version, to fix an important bug

= 1.4.1 =
* Upgrade to make a small correction to the parameter lists

= 1.4 =
* Update to add EmbedPlus, multi-widgets and transcript output capabilities

= 1.3.1 =
* Update if you wish to change the widget heading

= 1.3 =
* Update if you find that the videos are covering up layers

= 1.2 =
* Update to ensure no warnings are reported by XHTML validators

= 1.1 =
* Update to get the test video on the options screen working again!

= 1.0 =
* Initial release