<?php
Route::group([ 'prefix' => 'admin', 'as' => 'admin.', 'namespace'  => 'App\Http\Controllers\admin'], function () {
    Route::get('/', 'AdminController@login');
    Route::any('/login', 'AdminController@login')->name('admin.login');
    Route::post('/logout', 'AdminController@logout')->name('logout');
    Route::get('resetpassword', 'AdminController@resetpassword');
    Route::post('/forgot_password', 'AdminController@forgot_password' );
    Route::get('/reset_password/{token}', 'AdminController@reset_password');
    Route::post('/reset_password', 'AdminController@save_resetpassword');
    Route::group([ 'middleware' => 'auth.admin'], function () {
        Route::get('/vouchers/destroy/{id}', 'VouchersController@destroy')->name('vouchers.destroy');
        Route::resource('/vouchers', 'VouchersController');
        Route::get('/dashboard', 'AdminController@dashboard');
        //Admin servies module
        Route::get('/services', 'ServiceController@index');
        Route::get('/datatable/getAllServices', 'ServiceController@getAllServices')->name('datatable.getAllServices');
        Route::get('/payouts', 'PayoutController@index');
        Route::get('/payouts/list', 'PayoutController@list')->name('payouts.list');
        Route::get('/services/create', 'ServiceController@create')->name('services.create');
        Route::post('/services/store', 'ServiceController@store')->name('services.store');
        Route::get('/services/edit/{id}', 'ServiceController@edit')->name('services.edit');
        Route::post('/services/update', 'ServiceController@update')->name('services.update');
        Route::get('/services/destroy/{id}', 'ServiceController@destroy')->name('services.destroy');
        Route::post('/services/updateStatus', 'ServiceController@updateStatus')->name('services.updateStatus');
        Route::get('/services/servicesHistory', 'ServiceController@servicesHistory');
        Route::get('/datatable/servicesHistoryData', 'ServiceController@servicesHistoryData')->name('datatable.servicesHistoryData');
        Route::get('/services/servicesHistoryDetailAdmin', 'ServiceController@servicesHistoryDetailAdmin')->name('services.servicesHistoryDetailAdmin');
        Route::get('/services/revenue', 'ServiceController@revenue');
        Route::get('/datatable/revenueData', 'ServiceController@revenueData')->name('datatable.revenueData');
        Route::get('/services/revenueDetail', 'ServiceController@revenueDetail')->name('services.revenueDetail');
        //end
        //Admin faq module
        Route::get('/faqs', 'FaqController@index');
        Route::get('/datatable/getAllFaqs', 'FaqController@getAllFaqs')->name('datatable.getAllFaqs');

        Route::get('/faqs/create', 'FaqController@create')->name('faqs.create');
        Route::post('/faqs/store', 'FaqController@store')->name('faqs.store');


        Route::get('/faqs/edit/{id}', 'FaqController@edit')->name('faqs.edit');
        Route::post('/faqs/update', 'FaqController@update')->name('faqs.update');

        Route::get('/faqs/destroy/{id}', 'FaqController@destroy')->name('faqs.destroy');
        Route::post('/faqs/updateStatus', 'FaqController@updateStatus')->name('faqs.updateStatus');
        //end

        //Admin Experts module
        Route::get('/experts', 'ExpertController@index');
        Route::get('/experts/edit/{id}', 'ExpertController@edit')->name('experts.edit');
        Route::post('/experts/update', 'ExpertController@update')->name('experts.update');

        Route::get('/datatable/getAllExperts', 'ExpertController@getAllExperts')->name('datatable.getAllExperts');
        Route::post('/experts/updateStatus', 'ExpertController@updateStatus')->name('experts.updateStatus');
        Route::post('/experts/updatePayoutStatus', 'ExpertController@updatePayoutStatus')->name('experts.updatePayoutStatus');
        //end

        Route::post('/experts/confirmation', 'ExpertController@confirmation')->name('user.confirmation');
        Route::post('/experts/actionUndo', 'ExpertController@actionUndo')->name('user.actionUndo');

        //Admin Customers module
        Route::get('/customers', 'CustomerController@index');
        Route::get('/customers/edit/{id}', 'CustomerController@edit')->name('customersexperts.edit');
        Route::post('/customers/update', 'CustomerController@update')->name('customers.update');
        Route::get('/datatable/getAllCustomers', 'CustomerController@getAllCustomers')->name('datatable.getAllCustomers');
        Route::post('/customers/updateStatus', 'CustomerController@updateStatus')->name('customers.updateStatus');
        //end

        Route::get('changePassword', 'AdminController@changePassword')->name('changePassword');
        Route::post('updatePassword', 'AdminController@updatePassword')->name('updatePassword');

        Route::get('changeProfile', 'AdminController@changeProfile')->name('changeProfile');
        Route::post('updateProfile', 'AdminController@updateProfile')->name('updateProfile');

        //Job Dispatch
        Route::get('jobDispatch', 'AdminController@jobDispatch')->name('jobDispatch');
        Route::post('jobDispatchSave', 'AdminController@jobDispatchSave')->name('jobDispatchSave');
        Route::post('getServicesUser', 'AdminController@getServicesUser')->name('getServicesUser');

        Route::post('checkOldPassword', 'AdminController@checkOldPassword')->name('checkOldPassword');


        Route::get('changeCommission', 'AdminController@changeCommission')->name('changeCommission');
        Route::post('updateCommission', 'AdminController@updateCommission')->name('updateCommission');

        //Admin cms module
        Route::get('/cms', 'CmsController@index');
        Route::get('/datatable/getAllCms', 'CmsController@getAllCms')->name('datatable.getAllCms');

        Route::get('/cms/create', 'CmsController@create')->name('cms.create');
        Route::post('/cms/store', 'CmsController@store')->name('cms.store');


        Route::get('/cms/edit/{id}', 'CmsController@edit')->name('cms.edit');
        Route::post('/cms/update', 'CmsController@update')->name('cms.update');

        Route::get('/cms/destroy/{id}', 'CmsController@destroy')->name('cms.destroy');
        Route::post('/cms/updateStatus', 'CmsController@updateStatus')->name('cms.updateStatus');

        Route::get('/expert/language', 'ExpertController@language')->name('expert.language');
        Route::get('/expert/skills', 'ExpertController@skills')->name('expert.skills');

    });

});

Route::group([ 'middleware' => 'auth.admin'], function () {
    Route::post('/payout/cancel', 'App\Http\Controllers\StripeController@CancelPayout')->name('payout.cancel');

    //Meetings 
    Route::get("/admin/meetings", function(){
       return View::make("admins.meeting.index");
    });
    Route::get('/datatable/getMeetings', 'App\Http\Controllers\MeetingController@getMeetings')->name('datatable.getMeetings');
    Route::post('/participant/updateStatus', 'App\Http\Controllers\MeetingController@updateStatus')->name('participant.updateStatus');

});
