<?php

Route::redirect('/', '/login');

//changed here
Route::redirect('/home', 'admin/bookings/index');
Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Services
    Route::delete('services/destroy', 'ServicesController@massDestroy')->name('services.massDestroy');
    Route::resource('services', 'ServicesController');

    // Employees
    Route::delete('employees/destroy', 'EmployeesController@massDestroy')->name('employees.massDestroy');
    Route::post('employees/media', 'EmployeesController@storeMedia')->name('employees.storeMedia');
    Route::resource('employees', 'EmployeesController');

    // Clients
    Route::delete('clients/destroy', 'ClientsController@massDestroy')->name('clients.massDestroy');
    Route::resource('clients', 'ClientsController');

    // Appointments
    Route::delete('appointments/destroy', 'AppointmentsController@massDestroy')->name('appointments.massDestroy');
   // Route::resource('bookings', 'AppointmentsController', ['as' => 'appointments']);
  Route::resource('appointments', 'AppointmentsController');

 //  Route::get('appointments/{appointment}', 'AppointmentsController@show')->name('admin.appointment.show');
 //  Route::post('/admin/bookings', [AppointmentsController::class, 'store'])->name('admin.bookings.store');
   //Route::get('appointments/{appointment}', 'AppointmentsController@show')->name('admin.appointment.show');

//   Route::get('bookings/create', 'AppointmentsController@create')->name('bookings.create'); // Add this line for creating a new booking
//   Route::post('bookings', 'AppointmentsController@store')->name('bookings.store'); // Add this line for storing a new booking

    Route::get('system-calendar', 'SystemCalendarController@index')->name('systemCalendar');
});
