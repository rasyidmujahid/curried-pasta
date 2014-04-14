=== WP Sentry ===
Contributors: sweigold
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=LMJM2TYZXWQQQ
Tags: posts, pages, users, security, restrict, restriction, groups, private
Requires at least: 2.5.0
Tested up to: 2.8.4
Stable tag: trunk

WP Sentry allows WordPress authors to grant access to individual private posts to users and groups of users. 

== Description ==

This is a simple plugin to allow for access-restricted posting, allowing bloggers to discuss sensitive subjects
without Google or the world finding the post.

After plugin activation, an administration panel is added to your "Users" and "Plugins" tabs, allowing you to create user groups 
and manage WP Sentry's other options. The creation of user groups is completely optional, although it does make things a little easier.

Also upon activation, a section is added to the post creation and editing screen. This section allows you to specify
which users or groups have access to the post. Setting any access restrictions here forces the post to be listed as 
"private" in WordPress, so you don't have to worry about forgetting to hide a sensitive post.

Users may be members of multiple groups. Multiple groups and multiple individual users may be allowed to view each
post. Overlaps are ignored -- if the user is a member of any group that is allowed to view the post, that user will
be able to view it.


== Installation ==

Installation is quick and simple:

1. Upload 'wp-sentry.php' to the '/wp-content/plugins/' directory
1. Activate the plugin through the 'Plugins' menu in WordPress

To upgrade the plugin manually, follow these steps:

1. Disable the plugin
1. Upload the new version to /wp-content/plugins/
1. Reactivate the plugin

== Frequently Asked Questions ==

= Is this plugin still supported?  =

> (20130223) Yes! The original author of this plugin: Pete Holiday has decided that he's no longer able
> to support this, but Steve Weigold (sweigold) has offered to take over support.  We're a little slow
> getting things up to date, but we are working on it!  The new plugin homepage can be found at:
> [WP Sentry Homepage](http://www.weigoldenterprises.com/products/wordpress-plugins/wp-sentry/). 

= What happens to my private posts if I disable WP Sentry? =

> Because all of the posts are still listed as Private, WP Sentry is fail safe. If you disable WP Sentry
> or it stops working for any other reasons, only site administrators will be unable to access your private
> posts.

= Where do I send feature requests or bug reports? =

> Take those on over to the [WP Sentry Homepage](http://www.weigoldenterprises.com/products/wordpress-plugins/wp-sentry/). I'd love to hear 
> either or both.

== Screenshots ==

For screenshots, visit the [WP Sentry Homepage](http://www.weigoldenterprises.com/products/wordpress-plugins/wp-sentry/).