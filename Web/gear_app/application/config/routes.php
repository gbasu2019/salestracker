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
$route['default_controller'] = 'Login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['checklogin'] = "Login/checklogin";

$route['getDealerList'] = "Order/getDealerList";
$route['getDealerListnew/(:any)/(:any)/(:any)/(:any)'] = "Order/getDealerListnew/$1/$2/$3/$4";
$route['getProductList'] = "Product/getProductList";
$route['saveOrderDetails'] = "Order/saveOrderDetails";

$route['saveGrnDetails'] = "Order/saveGrnDetails";

$route['getBrandList'] = "Brand/getBrandList";

$route['getCategoryList'] = "Category/getCategoryList";

$route['getSubCategoryList'] = "SubCategory/getSubCategoryList";


$route['testresult'] = "Test/testresult";
$route['testresult1/(:any)'] = "Test/testresult1/$1";

$route['testresult3'] = "Test/testresult3";

$route['saveVisitEntry'] = "Visit/saveVisitEntry";

$route['saveVisitEntryt'] = "Test/saveVisitEntry";


$route['collectionEntry'] = "Collection/collectionEntry";

$route['brand'] = "Brand/index";


$route['location'] = "Location/index";

$route['getOrderCategoryDropdownList'] = "Order/getOrderCategoryDropdownList";
$route['getOrderCategoryDropdownListNew'] = "Order/getOrderCategoryDropdownListNew";
$route['getGrnCategoryDropdownList'] = "Order/getGrnCategoryDropdownList";
$route['getGrnCategoryDropdownListNew'] = "Order/getGrnCategoryDropdownListNew";
$route['getOrderSubCategoryDropdownList'] = "Order/getOrderSubCategoryDropdownList";
$route['getGrnSubCategoryDropdownList'] = "Order/getGrnSubCategoryDropdownList";

$route['getItemList/(:num)'] = "Order/getItemList/$1";

$route['getOrderList'] = "Order/getOrderList";


$route['getOrderedItems'] = "Order/getOrderedItems";
$route['getGrnItems'] = "Order/getGrnItems";
$route['getGrnList'] = "Order/getGrnList";
$route['getVisitList'] = "Visit/getVisitList";

$route['getStatusDropDown'] = "Order/getStatusDropDown";

/*added priyanjali*/
$route['getBankLists'] = "Collection/getBankLists";
$route['getLedgerlist'] = "Collection/getLedgerlist";
$route['getCollectionList'] = "Collection/collectionlist";
$route['updateVisit'] = "Visit/updateVisit";

/************************** web part **************************/

$route['check_login'] = "Login/check_login";
$route['getOrderListItems'] = "Order/getOrderListItems";
$route['saveOrderedItems'] = "Order/saveOrderedItems";
$route['saveOrderStatus']= "Order/saveOrderStatus";
$route['saveGrnStatus']= "Order/saveGrnStatus";
$route['viewOrderList'] = "Order/viewOrderList";
$route['logout'] = "Login/logout";

/*added priyanjali*/
$route['getVisitListItems'] = "Visit/getVisitListItems";
$route['updateVisitStatus'] = "Visit/updateVisitStatus";
$route['updateVisitStatus'] = "Visit/updateVisitStatus";
$route['getGrnListItems'] = "Order/getGrnListItems";
$route['getCollectionItems'] = "Collection/getCollectionItems";
$route['getCollections'] = "Collection/getCollections";
$route['getUserListItems'] = "Login/getUserListItems";
$route['getUsers'] = "Login/getUsers";
$route['updateUserItems'] = "Login/updateUserItems";
$route['dashboard'] = "Login/dashboard";
$route['category'] = "Category/category";
$route['subcategory'] = "Category/subcategory";
$route['item'] = "Category/item";

$route['getDealerVisit'] = "Login/getDealerVisit";
$route['getTotalOrder'] = "Login/getTotalOrder";
$route['getTotalGRN'] = "Login/getTotalGRN";
$route['getTodayCollection'] = "Login/getTodayCollection";
$route['getMonthlyCollections'] = "Login/getMonthlyCollections";

$route['getWeeklyTotalOrder'] = "Order/getWeeklyTotalOrder";
$route['getWeeklyApprovedOrder'] = "Order/getWeeklyApprovedOrder";
$route['getWeeklyRejectedOrder'] = "Order/getWeeklyRejectedOrder";
$route['getWeeklyOpenOrder'] = "Order/getWeeklyOpenOrder";
$route['getWeekPartiallyOrder'] = "Order/getWeekPartiallyOrder";
$route['addUsers'] = "Login/addUsers";
$route['addUserItems'] = "Login/addUserItems";


$route['salesmanager']="Tbl_master_manager_salesexecutive/index";
$route['sales_manager_add']="Tbl_master_manager_salesexecutive/add";
$route['remove/(:any)']="Tbl_master_manager_salesexecutive/remove/$1";


/** excel upload *****/

$route['ledgerupload'] = "Ledger/ledgerupload";
$route['uploadexcel'] = "Ledger/uploadexcel";

/**Report**/
$route['getReportOrderAnalysis'] = "Report/getReportOrderAnalysis";
$route['updateVisitStatusBulk'] = "Visit/updateVisitStatusBulk";

$route['VisitAnalysisReport'] = "Report/visitreport";
$route['reportexcel'] = "Report/reportexcel";

$route['visitArray'] = "Visit/visitArray";
$route['visitArrayApproved'] = "Visit/visitArrayApproved";
$route['visitArrayRejected'] = "Visit/visitArrayRejected";
$route['lastVisitDate'] = "Visit/lastVisitDate";



$route['dealers'] = "Tbl_master_dealerinformation/index";
