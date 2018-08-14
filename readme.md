# Functions plugin for Craft CMS 3.x

Craft CMS plugin to provide some useful tools

## Requirements

This plugin requires Craft CMS 3.0.0 or later.

## Installation

To install the plugin, follow these instructions.

1. Open your terminal and go to your Craft project:

        cd /path/to/project

2. Then tell Composer to load the plugin:

        composer require supercool/functions

3. In the Control Panel, go to Settings → Plugins and click the “Install” button for Functions.

## Utilities

Utilities are collection of buttons in Craft CMS control panel in Utilities section. Our clients have access to them and can perform some basic actions as follows:

- **Clear Queues**
- **Clear Cache** (This clears template caches. When CacheMonster cache is cleared it also clears any static cache like Nginx static cache)

## Hidden Things

There are some hidden things that are not visible in Craft CMS CP which this plugin does or offers.

### Controller actions

#### clearCaches

This is a controller action which can be accessed using a browser. Lets say we have this plugin installed on a example project with url `https://example.com` we can access this as follows

- `https://example.com/actions/functions/utilities/clear-caches`


**clearCaches** (This clears all template cache including FastCGI static cache if the path is defined in config)


#### warmCaches

This is a controller action which can be accessed using a browser. Lets say we have this plugin installed on a example project with url `https://example.com` we can access this as follows

- `https://example.com/actions/functions/utilities/warm-caches`

**warmCache** (This simple visits all urls in sitemap.xml file using Guzzle client)


### Zendesk Widget

This plugin also adds a nav link called `Support` to the sidebar of Craft's navigation which opens up a Zendesk widget that can be used by clients to submit support tickets to Zendesk.

We are adding the link in plugins main file using Craft's hook called `modifyCpNav` and widget's logic is defined in `functions.js` file.


Brought to you by [Supercool Ltd](http://www.supercooldesign.co.uk/)
