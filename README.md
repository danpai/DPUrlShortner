DP URL Shortner
===============

D(ifferent)P(lace) URL Shortner is a WordPress Plugin designed to use the most popular URL shortening services.

Versions
--------
###Rel. 0.1
This version is released only for testing purposes. It can be used as long as you know what you are doing.

Known Issues
------------
###Rel. 0.1
* At this moment the only supported services are Bitly.com and Google URL Shortner

Prerequisites
-------------
* WordPress 3.3 or higher

Installation
------------
Copy the folder DPUrlShortner and its content into <your blog>/wp-content/plugins

Usage
-----
There are 3 ways to generate a shortlink:

1. When you publish a post or a page
2. When you update a published post or page
3. When you view a post or a page that use this code

	<?php echo wp_get_shortlink(); ?>