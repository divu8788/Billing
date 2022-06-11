<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller']      = 'admin_check';
$route['admin_login']      = 'admin_check';
$route['login_check']             = 'admin_check/login_check';

$route['text_area']               = 'admin_area/admin_area/text_area';

$route['dashboard']               = 'admin_area/admin_area';

$route['category_list']             = 'admin_area/admin_area/category_list';
$route['category_list/(:any)']                 	= "admin_area/admin_area/category_list";
$route['add_category']             = 'admin_area/admin_area/add_category';
$route['category_insert']             = 'admin_area/admin_area/category_insert';
$route['edit_category/(:any)']        	= "admin_area/admin_area/edit_category/$1";

$route['attribute_list']             = 'admin_area/admin_area/attribute_list';
$route['attribute_list/(:any)']                 	= "admin_area/admin_area/attribute_list";
$route['add_attribute']             = 'admin_area/admin_area/add_attribute';
$route['attribute_insert']             = 'admin_area/admin_area/attribute_insert';
$route['edit_attribute/(:any)']        	= "admin_area/admin_area/edit_attribute/$1";
$route['update_attribute']             = 'admin_area/admin_area/update_attribute';

$route['group_list']             = 'admin_area/admin_area/group_list';
$route['group_list/(:any)']             = 'admin_area/admin_area/group_list';
$route['group_insert']             = 'admin_area/admin_area/group_insert';
$route['edit_group/(:any)']        	= "admin_area/admin_area/edit_group/$1";
$route['update_group']             = 'admin_area/admin_area/update_group';

$route['brand_list']             = 'admin_area/admin_area/brand_list';
$route['brand_list/(:any)']             = 'admin_area/admin_area/brand_list';
$route['brand_insert']             = 'admin_area/admin_area/brand_insert';
$route['edit_brand/(:any)']        	= "admin_area/admin_area/edit_brand/$1";
$route['update_brand']             = 'admin_area/admin_area/update_brand';

$route['add_product']             = 'admin_area/product_details/add_product';
$route['product_insert']             = 'admin_area/product_details/product_insert';
$route['product_update']             = 'admin_area/product_details/product_update';

$route['attributes_view']             = 'admin_area/product_details/attributes_view';
$route['attributes_views']             = 'admin_area/product_details/attributes_views';

$route['upload_photo']             = 'admin_area/product_details/upload_photo';
$route['upload_attr_photo']             = 'admin_area/product_details/upload_attr_photo';

$route['product_list']             = 'admin_area/product_details/product_list';
$route['product_list/(:any)']             = 'admin_area/product_details/product_list';
$route['edit_product/(:any)']        	= "admin_area/product_details/edit_product/$1";




$route['add_stock_price']        	= "admin_area/stock_details/add_stock_price";
$route['add_stock_price/(:any)']        	= "admin_area/stock_details/edit_stock_price/$1";
$route['get_product']        	= "admin_area/stock_details/get_product";
$route['get_attributes']        	= "admin_area/stock_details/get_attributes";
$route['get_batchcode']        	= "admin_area/stock_details/get_batchcode";
$route['price_insert']        	= "admin_area/stock_details/price_insert";
$route['price_update']        	= "admin_area/stock_details/price_update";
$route['get_details']        	= "admin_area/stock_details/get_details";
$route['stock_price_list']        	= "admin_area/stock_details/stock_price_list";
$route['stock_price_list/(:any)']        	= "admin_area/stock_details/stock_price_list";
$route['edit_stock_price/(:any)']        	= "admin_area/stock_details/edit_stock_price/$1";
$route['combo_products']        	= "admin_area/combo_products/combo_products";
$route['get_comboproduct']        	= "admin_area/combo_products/get_comboproduct";
$route['get_stockdetails']        	= "admin_area/combo_products/get_stockdetails";
$route['combo_product_insert']        	= "admin_area/combo_products/combo_product_insert";
$route['combo_product_list']        	= "admin_area/combo_products/combo_product_list";
$route['combo_product_list/(:any)']        	= "admin_area/combo_products/combo_product_list";
$route['edit_combo_product']        	= "admin_area/combo_products/edit_combo_product";


$route['pending_orders']        	= "admin_area/order_details/pending_orders";
$route['pending_order_view']        	= "admin_area/order_details/pending_order_view";
$route['update_order_status_view']        	= "admin_area/order_details/update_order_status_view";

$route['update_order_status']        	= "admin_area/order_details/update_order_status";
$route['update_order_cancel']        	= "admin_area/order_details/update_order_cancel";
$route['approved_orders']        	= "admin_area/order_details/approved_orders";
$route['approved_order_view']        	= "admin_area/order_details/approved_order_view";


$route['invoice_view/(:any)']        	= "admin_area/order_details/invoice_view/$1";
$route['invoice_all_details/(:any)']        	= "admin_area/invoice/invoice_all_details/$1";



$route['admin_logout']      = 'admin_area/logout';


$route['add_supplier']             = 'admin_area/Supplier/add_supplier';
$route['supplier_insert']          = 'admin_area/Supplier/supplier_insert';
$route['supplier_list']            = 'admin_area/Supplier/supplier_list';
$route['edit_supplier/(:any)']     = "admin_area/Supplier/edit_supplier/$1";
$route['update_supplier']          = "admin_area/Supplier/update_supplier";





$route['product_billing_public']            		= 'Productbillingpublic/product_billing_public';
$route['customer_details_public']              	= "Welcome/customer_details_public";
$route['billing_franchisee_product_list']   = "Welcome/billing_franchisee_product_list";
$route['billing_product_list']      		= "Welcome/billing_product_list";
$route['purchase_success/(:any)']            		= 'Productbillingpublic/purchase_success/$1';

$route['customer_billing_save_public']    = "Updation_controller/customer_billing_save_public";

$route['billing_report']            = "Report/billing_report";
$route['bill_report_list']          = "Report/bill_report_list";


$route['product_modal']        	= "Report/product_modal";

$route['change_password']        	= "admin_area/change_password/change_password";
$route['check_user']        	    = "admin_area/change_password/check_user";
$route['reform_password']        	= "admin_area/change_password/reform_password";



$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
