# Local Development

This repo is a collection of all class,functions
which are very helpful in my local development.

## WP Plugins
WordPress plugins that are bundled with it.
1. [Theme Inspector / By Melissa Cabral](https://wordpress.org/plugins/theme-inspector/#developers)
2. [Classic Editor / By WP & Team](https://wordpress.org/plugins/classic-editor/)
3. [Inspector / By eLightUp](https://wordpress.org/plugins/inspector/)
    ### Git Submodules
1. [Performance Improvements for WooCommerce](https://github.com/lukecav/performance-improvements-for-woocommerce)
2. [Query Monitor Extended](https://github.com/crstauf/query-monitor-extend)
3. [Woo Preview Emails](https://github.com/digamber89/woocommerce-preview-emails)
4. [User Switching](https://github.com/johnbillion/user-switching)

## Composer 
1. [digitalnature/php-ref](https://github.com/digitalnature/php-ref)
1. [joshtronic/php-loremipsum](https://github.com/joshtronic/php-loremipsum)


## Usage
This repo is download locally and `index.php` file gets included directly into **php.ini**

### Step 1
```text
composer install
```

### Step 2
```ini
; Automatically add files before PHP document.
; http://php.net/auto-prepend-file
auto_prepend_file = your-full-path/local-development/index.php
``` 