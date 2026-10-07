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
|	https://codeigniter.com/userguide3/general/routing.html
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
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['home'] = 'welcome/home';
$route['about'] = 'welcome/about';
$route['product'] = 'welcome/product';
$route['product/(:any)'] = 'welcome/product/$1';
$route['productdetail'] = 'welcome/productdetail';
$route['productdetail/(:any)'] = 'welcome/productdetail/$1';
$route['casestudy'] = 'welcome/casestudy';
$route['casestudy/(:any)'] = 'welcome/casestudydetail/$1';
$route['casestudydetail'] = 'welcome/casestudydetail';
$route['casestudydetail/(:any)'] = 'welcome/casestudydetail/$1';
$route['blog'] = 'welcome/blog';
$route['blog/(:any)'] = 'welcome/blogdetail/$1';
$route['blogdetail'] = 'welcome/blogdetail';
$route['blogdetail/(:any)'] = 'welcome/blogdetail/$1';
$route['contact'] = 'welcome/contact';
$route['login'] = 'welcome/login';
$route['register'] = 'welcome/register';
$route['forgetpassword'] = 'welcome/forgetpassword';
$route['forgot-password'] = 'welcome/forgetpassword';
$route['resetpassword'] = 'welcome/resetpassword';
$route['resetpassword/(:any)'] = 'welcome/resetpassword/$1';
$route['reset-password'] = 'welcome/resetpassword';
$route['reset-password/(:any)'] = 'welcome/resetpassword/$1';
$route['profile'] = 'welcome/profile';
$route['orderhistory'] = 'welcome/orderhistory';
$route['enquirydetail'] = 'welcome/enquirydetail';
$route['update-profile'] = 'welcome/update_profile';
$route['logout'] = 'welcome/logout';
$route['products'] = 'welcome/product';
$route['blogs'] = 'welcome/blog';
$route['contact-us'] = 'welcome/contact';
$route['orderhistorydetail'] = 'welcome/orderhistory';
$route['change-password'] = 'welcome/profile';
$route['terms-conditions'] = 'welcome/about';
$route['privacy-policy'] = 'welcome/about';

// Customer Wishlist Routes (Database Persistence)
$route['wishlist/get'] = 'welcome/wishlist_get';
$route['wishlist/add'] = 'welcome/wishlist_add';
$route['wishlist/remove'] = 'welcome/wishlist_remove';
$route['wishlist/clear'] = 'welcome/wishlist_clear';
$route['wishlist/sync'] = 'welcome/wishlist_sync';

// Admin Authentication Routes
$route['admin/login'] = 'admin/login';
$route['admin/logout'] = 'admin/logout';

// Admin Routes (Teknolite Theme)
$route['admin'] = 'admin/dashboard';
$route['admin/productlist'] = 'admin/productlist';
$route['admin/products'] = 'admin/productlist';
$route['admin/productadd'] = 'admin/productadd';
$route['admin/productedit'] = 'admin/productedit';
$route['admin/productedit/(:any)'] = 'admin/productedit/$1';
$route['admin/productdelete/(:any)'] = 'admin/productdelete/$1';
$route['admin/productstatus/(:any)'] = 'admin/productstatus/$1';
$route['admin/productlistdetail'] = 'admin/productlistdetail';
$route['admin/productlistdetail/(:any)'] = 'admin/productlistdetail/$1';
$route['admin/categorie'] = 'admin/categorie';
$route['admin/categories'] = 'admin/categorie';
$route['admin/category'] = 'admin/categorie';
$route['admin/categorieedit'] = 'admin/categorieedit';
$route['admin/categorieedit/(:any)'] = 'admin/categorieedit/$1';
$route['admin/categoryedit'] = 'admin/categorieedit';
$route['admin/categoryedit/(:any)'] = 'admin/categorieedit/$1';
$route['admin/categoriesadd'] = 'admin/categoriesadd';
$route['admin/categoryadd'] = 'admin/categoriesadd';
$route['admin/categorieadd'] = 'admin/categoriesadd';
$route['admin/categoriedelete/(:any)'] = 'admin/categoriedelete/$1';
$route['admin/categorystatus/(:any)'] = 'admin/categorystatus/$1';
$route['admin/subcategories'] = 'admin/subcategories';
$route['admin/subcategoryadd'] = 'admin/subcategoryadd';
$route['admin/subcategoryedit'] = 'admin/subcategoryedit';
$route['admin/subcategoryedit/(:any)'] = 'admin/subcategoryedit/$1';
$route['admin/subcategorydelete/(:any)'] = 'admin/subcategorydelete/$1';
$route['admin/subcategorystatus/(:any)'] = 'admin/subcategorystatus/$1';
$route['admin/dashboard'] = 'admin/dashboard';

// Enquiry & Order Management Routes
$route['admin/enquiries'] = 'admin/enquiries';
$route['admin/enquiry'] = 'admin/enquiries';
$route['admin/enquirydetail'] = 'admin/enquirydetail';
$route['admin/enquirydetail/(:any)'] = 'admin/enquirydetail/$1';
$route['admin/enquiryupdatestatus'] = 'admin/enquiryupdatestatus';
$route['admin/enquiryupdatestatus/(:any)'] = 'admin/enquiryupdatestatus/$1';
$route['admin/enquirydelete/(:any)'] = 'admin/enquirydelete/$1';

// Teknolite Orders Aliases
$route['admin/orders'] = 'admin/orders';
$route['admin/orderlist'] = 'admin/orders';
$route['admin/orderdetails'] = 'admin/orderdetails';
$route['admin/orderdetails/(:any)'] = 'admin/orderdetails/$1';

// Customer Management Routes
$route['admin/customers'] = 'admin/customers';
$route['admin/customerprofile'] = 'admin/customerprofile';
$route['admin/customerprofile/(:any)'] = 'admin/customerprofile/$1';
$route['admin/customerdetail'] = 'admin/customerprofile';
$route['admin/customerdetail/(:any)'] = 'admin/customerprofile/$1';
$route['admin/customerstatus'] = 'admin/customerstatus';
$route['admin/customerstatus/(:any)'] = 'admin/customerstatus/$1';
$route['admin/customerupdate'] = 'admin/customerupdate';
$route['admin/customerupdate/(:any)'] = 'admin/customerupdate/$1';
$route['admin/customerdelete/(:any)'] = 'admin/customerdelete/$1';

// Store Settings Routes
$route['admin/settings'] = 'admin/settings';
$route['admin/savesettings'] = 'admin/savesettings';

// Case Studies CMS Routes
$route['admin/casestudies'] = 'admin/casestudies';
$route['admin/casestudy'] = 'admin/casestudies';
$route['admin/casestudyadd'] = 'admin/casestudyadd';
$route['admin/casestudyedit'] = 'admin/casestudyedit';
$route['admin/casestudyedit/(:any)'] = 'admin/casestudyedit/$1';
$route['admin/casestudydelete/(:any)'] = 'admin/casestudydelete/$1';
$route['admin/casestudystatus/(:any)'] = 'admin/casestudystatus/$1';

// Blog CMS Routes
$route['admin/blogs'] = 'admin/blogs';
$route['admin/blog'] = 'admin/blogs';
$route['admin/blogadd'] = 'admin/blogadd';
$route['admin/blogedit'] = 'admin/blogedit';
$route['admin/blogedit/(:any)'] = 'admin/blogedit/$1';
$route['admin/blogview'] = 'admin/blogview';
$route['admin/blogview/(:any)'] = 'admin/blogview/$1';
$route['admin/blogdelete/(:any)'] = 'admin/blogdelete/$1';
$route['admin/blogstatus/(:any)'] = 'admin/blogstatus/$1';
