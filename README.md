# woocommerce-auto-refresh-order
A little plugin for WooCommerce on Wordpress platform. Permit to automatically refresh the admin order page.

## Install
1. Download the woocommerce-auto-refresh-order.zip
2. Upload the plugin to the '/wp-content/plugins/' directory or install via 'Add new Plugin' page
3. Activate the plugin through the 'Plugins' menu in WordPress

## How to use
To use this plugin, go to WooCommerce setting.

![Screenshot](screenshot/wc_sub_menu.png)


Simply enter the number of seconds you wish the page to refresh after in the box and enable it.

![Screenshot](screenshot/wc_auto_refresh_settings.png)

The admin order page will automatically refresh!

## Translating into your language

If you want to translate the plugin into your language you can use ['PoEdit'](https://poedit.net/).
1. Download PoEdit
2. Open the translation [template](https://github.com/gabriserra/WoocommerceAutoRefreshOrder/blob/master/woocommerce-auto-refresh-order/languages/woocommerce-auto-refresh-order.pot) (you can find it under `languages/`).
3. Using PoEdit translate it into your language and compile it
4. Place both .po (useful if you want to modify the translation) and .mo
5. **KEEP ATTENTION**, the file must be named `woocommerce-auto-refresh-order-` followed by your locale (eg. `it_IT`)