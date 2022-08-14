<?php

Route::group(['prefix' => 'api'], function ($router) {
    /**
     * CMS Web Content and BLog Route
     */
    Route::group(['prefix' => 'notify'], function () {

        // Notify\App\Controllers\Mails\MailController
        Route::post('/create/{target}', 'Notify\App\Controllers\Mails\MailController@store');
        Route::post('/update/{target}', 'Notify\App\Controllers\Mails\MailController@update');
        Route::get('/fetch/{target}', 'Notify\App\Controllers\Mails\MailController@all');
        Route::get('/get/{target}', 'Notify\App\Controllers\Mails\MailController@get');
        Route::post('/search/{target}', 'Notify\App\Controllers\Mails\MailController@find');
        Route::get('/delete/{target}/{identifier}', 'Notify\App\Controllers\Mails\MailController@delete');

    });
});