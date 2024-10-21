<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
$route['default_controller'] = 'index';
$route['getOTP'] = 'index/getOTP';
$route['signup'] = 'index/signup';
$route['login'] = 'index/login';
$route['logout'] = 'index/logout';
$route['search-properties/(:any)'] = 'frontend/booking/search/$1';
$route['property-details'] = 'index/propertyDetails';
$route['search-gymnasium-facilities'] = 'index/searchGymnasiumFacilities';
$route['my-profile'] = 'frontend/profile/myProfile';
$route['my-booking'] = 'frontend/profile/myBooking';
$route['my-booking/(:any)'] = 'frontend/profile/myBooking/$1';
$route['booking-list'] = 'frontend/profile/bookingList';
$route['view-invoice/(:any)'] = 'frontend/profile/viewInvoice/$1';
$route['cms/(:any)'] = 'frontend/cms/cmsPage/$1';
$route['download-invoice/(:any)'] = 'frontend/profile/downloadInvoice/$1';
$route['update-profile'] = 'frontend/profile/updateProfile';
$route['view/(:num)'] = 'frontend/facilities/viewDetails/$1';
$route['view-gymnasium/(:num)'] = 'frontend/facilities/viewGymnasiumDetails/$1';
$route['check-available-rate/(:num)'] = 'frontend/facilities/checkAvailableRate/$1';
$route['reserve-facility/(:num)'] = 'frontend/facilities/reserveFacility/$1';
$route['booking-facility'] = 'frontend/facilities/bookingFacility';
$route['my-bookings'] = 'frontend/facilities/myBookings';
$route['generate-txnid'] = 'frontend/facilities/generateTxnid';
$route['payment-reconcile'] = 'reconcile/payment';

$route['search-availability'] = 'frontend/safari_booking/searchAvailability';
$route['safari-search-process'] = 'frontend/safari_booking/searchAvailabilityProcess';
$route['initiate-booking'] = 'frontend/safari_booking/init_booking';
$route['safari-booking-information-entry/(:any)'] = 'frontend/safari_booking/safari_booking_information_entry/$1';
$route['safari-booking-payment-success'] = 'frontend/safari_booking/paymentSuccess';
$route['safari-booking-payment-failure'] = 'frontend/safari_booking/paymentFailure';
$route['safari-booking-html'] = 'frontend/profile/getSafariBookingHtml';
$route['view-safari-booking-invoice/(:any)'] = 'frontend/profile/viewSafariInvoice/$1';
$route['download-safari-booking-invoice/(:any)'] = 'frontend/profile/downloadSafariInvoice/$1';
$route['cancel-safari-booking'] = 'frontend/profile/cancelSafariBooking';

#----------------------------------------------

//$route['cancellation-register/?(:num)'] = 'admin/reports/cancellation_register/$1';

#----------------------------------------------

$route['booking-payment-verify-cron'] = 'index/bookingPaymentVerify';
$route['vendor-payment-response-cron'] = 'index/saveVendorPaymentResponse';
$route['vendor-pay-file-generation-cron'] = 'index/generateVendorPayfile';
#----------------------------------------------

$route['proceed-to-payment'] = 'frontend/gymnasium/proceedPayment';
$route['gymnasium-success'] = 'index/paymentSuccess';
$route['gymnasium-failure'] = 'index/paymentFailure';
$route['gymnasium-subscription-success'] = 'index/paymentSubscriptionSuccess';
$route['gymnasium-subscription-failure'] = 'index/paymentSubscriptionFailure';
$route['booking-facility-success'] = 'index/paymentBookingSuccess';
$route['booking-facility-failure'] = 'index/paymentBookingFailure';

#----------------------------------------------

$route['about-us'] = 'frontend/pages/aboutUs';
$route['board-of-directors'] = 'frontend/pages/boardOfDirectors';
$route['key-managerial-personnel'] = 'frontend/pages/keyManagerialPersonnel';
$route['history'] = 'frontend/pages/history';
$route['our-objective'] = 'frontend/pages/ourObjective';
$route['annual-reports'] = 'frontend/pages/annualReports';
$route['activity-chart'] = 'frontend/pages/activityChart';
$route['privacy-policy'] = 'frontend/pages/privacyPolicy';
$route['terms-condition-guest-house-booking'] = 'frontend/pages/termsConditionGuestHouseBooking';
$route['general-terms-condition'] = 'frontend/pages/generalTermsCondition';
$route['deposit-work-project'] = 'frontend/pages/depositWorkProject';
$route['fishery-projects'] = 'frontend/pages/fisheryProjects';
$route['learn-about-pisciculture'] = 'frontend/pages/learnAboutPisciculture';
$route['fish-sale-wholesale-retail'] = 'frontend/pages/fishSaleWholesaleRetail';
$route['brief-reports-culture'] = 'frontend/pages/briefReportsCulture';
$route['glimpse-major-work'] = 'frontend/pages/glimpseMajorWork';
$route['departments'] = 'frontend/pages/departments';
$route['office-orders'] = 'frontend/pages/officeOrders';
$route['organisation-chart'] = 'frontend/pages/organisationChart';
$route['recruitments'] = 'frontend/pages/recruitments';
$route['head-office-contact'] = 'frontend/pages/headOfficeContact';
$route['guest-house-contact'] = 'frontend/pages/guestHouseContact';
$route['photo-gallery'] = 'frontend/pages/photoGallery';
$route['video-gallery'] = 'frontend/pages/videoGallery';
$route['press-release'] = 'frontend/pages/pressRelease';
$route['tenders'] = 'frontend/pages/tenders';

#----------------------------------------------


$route['admin'] = 'admin/dashboard';
$route['checkRoomNoAvailability'] = 'admin/accommodation/checkRoomNo';
$route['getRoomHtml'] = 'admin/accommodation/get_add_row_html';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/*For ApI*/
$route['app-login'] = 'api/parking/login';
$route['app-parking-type'] = 'api/parking/getParkingType';
$route['app-vehicle-type-rate'] = 'api/parking/getVehicleTypeAndRate';
$route['app-parking-data-save'] = 'api/parking/calculateParkingFees';
/**/
