Aoe_GridSearch
==============

Mysql REGEXP and Simple Search support for admin grid fields

Default: The default Magento text search - returns results that contain your search.

Simple:  Allows "*" and "|". Searching for "Br*a|Rob*son" will return Branca, Brita, Robinson, and Robertson results.

Regex:   Full Mysql <a href="http://dev.mysql.com/doc/refman/5.0/en/regexp.html#operator_regexp">REGEXP</a> support.
         Note - case sensitivity will not be supported unless your table collations are configured to support it.

TODO:

- Find a way to wrap the collection load in try/catch to catch regex syntax errors
- Add a "mixed" mode
	- full regex if search string starts and ends with "/"
	- simple components by default
	- default when string is wrapped in quotes.
