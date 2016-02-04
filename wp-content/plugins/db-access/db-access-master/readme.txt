=== db-access ===
Contributors: jimbob1953
Donate link: http://jimsward.com/db-access
Tags: database, mysql, search, replace, admin, security
Requires at least: 3.8
Tested up to:4.0
Stable tag: 0.8.7
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A tool for viewing, sorting, searching, exporting,
printing, manipulating the contents of HTML tables derived  
from tables found in your database.

== Description ==

The plugin gets a list of all the tables in your database - the standard tables created by WordPress and any other 
tables present - and creates a dropdown list. The user chooses one of the tables. A sortable HTML table is created. 
You can filter the rows using regular expressions, change the contents of individual cells, choose which columns 
to display, and print the resulting table and/or export it to a csv file to contemplate in a spreadsheet. 
Pagination is possible - or not. All these features are optional and can be turned off/on in the settings page.
Most of the features are on by default. The feature that can change individual cells in the database is off
by default due to the possible consequences of most any kind of change to the database. 
There is a feature that hightlights the row and column of a cell when you mouseover the cell.



== Installation ==

1. Upload the plugin to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress


== Frequently Asked Questions ==

= Is there a search function?

You can filter any column by entering a regular expression in the box at the top of that column.

= Can I make changes to the database?

You can edit the contents of nearly any cell and it will be saved to the database. The first column in
each row is not editable as it is the index field. This feature is turned off by default.
Use the settings page to turn it on or to turn off any features you don't want/need.
With the feature turned off, you can still make changes onscreen. But, they won't be saved to the database.
If you are going to make any changes, be sure to have a current backup of your database available.
You do regularly backup your database, don't you?



== Screenshots ==

The table as it is typically displayed with captions describing various functions.

== Changelog ==

= 0.8.6 ==
Moved all the AJAX handlers to db-access.php
Sanitized contents of $_POST

= 0.8.5 ==
Minor housekeeping

= 0.8.4 ==
Again with the dialog box

= 0.8.3 ==
Fixed dialog box height
Readme

= 0.8.2 ==
Fixed headers problem

= 0.8.1 ==
Plugin doesn't need to know name of containing folder.

= 0.8.0 =
* Added feature to change cells in the database.
* Added Crosshair, a jQuery plugin to highlight a cell's column and row on mouseover.

== Upgrade Notice ==




