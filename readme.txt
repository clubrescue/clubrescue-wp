=== Club.Rescue-WP ===
Contributors: borghoutsr
Donate link: https://ruudborghouts.nl/
Tags: comments, spam
Requires at least: 5.4.1
Tested up to: 5.4
Stable tag: 0.0.3
Requires PHP: 7.3.16
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Adds features and shortcodes for integrating Club.Rescue tables in WordPress. Some settings can (i.d.t.) also be configured in the admin dashboard.

== Description ==

Club.Rescue-WP is a plugin to include the My Club.Rescue module from [Club.Rescue](https://github.com/clubrescue/ 
"Go to the Club.Rescue project repositories on GitHub") into your WordPress site. Club.Rescue is an application 
that enables associations with their custom IT requirements and GDPR compliance.

This plugin includes the following sections of My Club.Rescue:

*   Personal data, provides members with their personal data registered by the association.
*   Activities, overview of all activities that the members has or will be participating in.
*   Internal certifications, internal certifications that the members has achieved.
*   Federation certifications, external certifications from the federation the association is a member of.
*   Federation functions, functions the member preforms on behalf of the federation the association is a member of.
*   Internal documents, (planned for a future release) will contain internal documents that are relevant for members.
*   Actions, all actions a member can perform like updating their address etc.
*   Declarations, all declarations the member has declared and it's status.

    Note that Club.Rescue must be installed prior to activating this plugin in the `/clubredders` directory inside the WordPress root directory.

    After activation all available shortcodes can be seen in the plugin configuration pages under Settings->C.R-WP.

== Installation ==

This section describes how to install the plugin and get it working for the first time. Afterwards updates can be performed through the 'Plugins' screen in WordPress directly.

e.g.

1. Upload the plugin files to the `/wp-content/plugins/clubrescue-wp` directory.
1. Activate the plugin through the 'Plugins' screen in WordPress.
1. Use the Settings->C.R-WP screen to configure the plugin.
1. Setup your My page and add the desired shortcodes.


== Frequently Asked Questions ==

= Why should I use this plugin? =

You should only use this plugin if you are using Club.Rescue. This plugin will integrate the My Club.Rescue into your WordPress website.

= What about foo bar? =

We believe this is a large misunderstanding. The term should have been bar foo!

== Screenshots ==

1. This is a sample screen shot description.
2. This is another sample screen shot description.

== Changelog ==

= 0.0.3 =
* Added MyCR Document section.

= 0.0.2 =
* Added automatic update notifications and one-click upgrades from GitHub.
* Added plugin details view in the WordPress Plugins page.

= 0.0.1 =
* Initial plugin release with basic functionality for My Club.Rescue.

== Upgrade Notice ==

= 0.0.2 =
Last manual upgrade. Future update notifications are pushed to the WordPress dashboard. Enabling one-click upgrades.

= 0.0.1 =
This plugin integrates the My Club.Rescue pages into your WordPress site. Enabling white labeling Club.Rescue.

== Arbitrary section ==

You may provide arbitrary sections, in the same format as the ones above.  This may be of use for extremely complicated
plugins where more information needs to be conveyed that doesn't fit into the categories of "description" or
"installation."  Arbitrary sections will be shown below the built-in sections outlined above.

== A brief Markdown Example ==

Ordered list:

1. Some feature
1. Another feature
1. Something else about the plugin

Unordered list:

* something
* something else
* third thing

Here's a link to [WordPress](https://wordpress.org/ "Your favorite software") and one to [Markdown's Syntax Documentation][markdown syntax].
Titles are optional, naturally.

[markdown syntax]: https://daringfireball.net/projects/markdown/syntax
            "Markdown is what the parser uses to process much of the readme file"

Markdown uses email style notation for blockquotes and I've been told:
> Asterisks for *emphasis*. Double it up  for **strong**.

`<?php code(); // goes in backticks ?>`