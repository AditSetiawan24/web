<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('about', 'About::f_about');
$routes->get('contact', 'Contact::f_contact');
$routes->get('feature', 'Feature::f_feature');
$routes->get('price', 'Price::f_price');
$routes->get('services', 'Services::f_services');
$routes->get('team', 'Team::f_team');
$routes->get('testimonial', 'Testimonial::f_testimonial');
$routes->get('login', 'Login::f_login');
$routes->get('admin/home', 'admin\Home::index');
$routes->post('login/auth', 'Login::authlogin');
$routes->get('logout', 'Login::logout');  

// User Management
$routes->get('admin/user', 'admin\UserController::index');
$routes->get('admin/user/create', 'admin\UserController::create');
$routes->post('admin/user/store', 'admin\UserController::store');
$routes->get('admin/user/edit/(:num)', 'admin\UserController::edit/$1');
$routes->post('admin/user/update/(:num)', 'admin\UserController::update/$1');
$routes->get('admin/user/delete/(:num)', 'admin\UserController::delete/$1');

// Customer Management
$routes->get('admin/customer', 'admin\CustomerController::index');
$routes->get('admin/customer/create', 'admin\CustomerController::create');
$routes->post('admin/customer/store', 'admin\CustomerController::store');
$routes->get('admin/customer/edit/(:num)', 'admin\CustomerController::edit/$1');
$routes->post('admin/customer/update/(:num)', 'admin\CustomerController::update/$1');
$routes->get('admin/customer/delete/(:num)', 'admin\CustomerController::delete/$1');

// Warehouse Management
$routes->get('admin/warehouse', 'admin\WarehouseController::index');
$routes->get('admin/warehouse/create', 'admin\WarehouseController::create');
$routes->post('admin/warehouse/store', 'admin\WarehouseController::store');
$routes->get('admin/warehouse/edit/(:num)', 'admin\WarehouseController::edit/$1');
$routes->post('admin/warehouse/update/(:num)', 'admin\WarehouseController::update/$1');
$routes->get('admin/warehouse/delete/(:num)', 'admin\WarehouseController::delete/$1');

// Team Management
$routes->get('admin/team', 'admin\TeamController::index');
$routes->get('admin/team/create', 'admin\TeamController::create');
$routes->post('admin/team/store', 'admin\TeamController::store');
$routes->get('admin/team/edit/(:num)', 'admin\TeamController::edit/$1');
$routes->post('admin/team/update/(:num)', 'admin\TeamController::update/$1');
$routes->get('admin/team/delete/(:num)', 'admin\TeamController::delete/$1');
$routes->get('admin/team/photo/(:any)', 'admin\TeamController::photo/$1');

// Shipping Management (Admin)
$routes->get('admin/shipping', 'admin\ShipmentController::index');
$routes->get('admin/shipping/detail/(:num)', 'admin\ShipmentController::detail/$1');
$routes->post('admin/shipping/update-status/(:num)', 'admin\ShipmentController::updateStatus/$1');

// Warehouse Storage Management (Admin)
$routes->get('admin/warehouse-storage', 'admin\WarehouseStorageController::index');
$routes->get('admin/warehouse-storage/detail/(:num)', 'admin\WarehouseStorageController::detail/$1');

// Profile/Account Settings
$routes->get('admin/profile', 'admin\ProfileController::index');
$routes->post('admin/profile/update', 'admin\ProfileController::update');
$routes->get('admin/profile/change-password', 'admin\ProfileController::changePassword');
$routes->post('admin/profile/update-password', 'admin\ProfileController::updatePassword');

// Shipment Management (Customer)
$routes->get('shipment/order/(:alpha)', 'ShipmentController::order/$1');
$routes->post('shipment/store', 'ShipmentController::store');
$routes->get('shipment/payment/(:num)', 'ShipmentController::payment/$1');
$routes->get('shipment/process-payment/(:num)', 'ShipmentController::processPayment/$1');
$routes->get('shipment/payment-success/(:num)', 'ShipmentController::paymentSuccess/$1');
$routes->get('shipment/success', 'ShipmentController::success');
$routes->get('shipment/my-orders', 'ShipmentController::myOrders');

// Warehouse Storage Management (Customer)
$routes->get('warehouse/order/(:alpha)', 'WarehouseStorageController::order/$1');
$routes->post('warehouse/store', 'WarehouseStorageController::store');
$routes->get('warehouse/payment/(:num)', 'WarehouseStorageController::payment/$1');
$routes->get('warehouse/process-payment/(:num)', 'WarehouseStorageController::processPayment/$1');
$routes->get('warehouse/payment-success/(:num)', 'WarehouseStorageController::paymentSuccess/$1');
$routes->get('warehouse/my-orders', 'WarehouseStorageController::myOrders');