### Magento module for logging products downloads.

It works for downloadable product type and will log:

* IP
* Country, Region, City
* User-Agent
* File name and title
* Product SKU
* Date

#### Installation instructions

Install with [modgit](https://github.com/jreinke/modgit):

    $ cd /path/to/magento
    $ modgit init
    $ modgit clone log-downloads https://github.com/jreinke/magento-log-downloads.git

Install with [modman](https://github.com/colinmollenhour/modman):

    $ cd /path/to/magento
    $ modman init
    $ modman clone https://github.com/jreinke/magento-log-downloads.git

or download package manually [here](https://github.com/jreinke/magento-log-downloads/archive/master.zip) and unzip in Magento root folder.

Finally:

* Clear cache
* Logout from admin then login again to access module configuration

Extension is also available at [http://shop.bubblecode.net/magento-log-downloads.html](http://shop.bubblecode.net/magento-log-downloads.html)