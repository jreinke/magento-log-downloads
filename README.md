### Magento module to log products downloads

It works for downloadable product type and will log:

* IP
* Country, Region, City
* User-Agent
* File name and title
* Product SKU
* Customer Id
* Date

#### Installation on Magento CE 1.9.x

Install with [modgit](https://github.com/jreinke/modgit):

    $ cd /path/to/magento
    $ modgit init
    $ modgit clone log-downloads https://github.com/jreinke/magento-log-downloads.git

or download package manually [here](https://github.com/jreinke/magento-log-downloads/archive/master.zip) and unzip in Magento root folder.

Finally:

* Clear cache
* Logout from admin then login again to access module configuration

Extension is also available at [https://www.bubbleshop.net/magento-log-downloads.html](https://www.bubbleshop.net/magento-log-downloads.html)