<?php
//Front end
/*Route điều hướng trong font end*/
Route::group(['prefix' => '/'], function(){
    Route::get('/', 'Frontend\FrontendController@login');
    Route::post('/', 'Frontend\FrontendController@postLogin');
    Route::get('/homepage', 'Frontend\FrontendController@index');
    //Lang
    Route::get('/lang/{lang}', 'Frontend\FrontendController@Lang');
    Route::get('/image', 'Frontend\FrontendController@image');
    Route::get('/img2', 'Frontend\FrontendController@img2');
    Route::get('/img3', 'Frontend\FrontendController@img3');
    Route::get('/list1', 'Frontend\FrontendController@list1');
    Route::get('/list2', 'Frontend\FrontendController@list2');
    Route::get('/list3', 'Frontend\FrontendController@list3');
    Route::get('/demo','Frontend\FrontendController@demo');
});

/*Route điều hướng trong backend*/
//Backend
Route::get('/login','Backend\BackendController@loginForm');
Route::post('/login','Backend\BackendController@login');
Route::get('/logout','Backend\BackendController@logout');
Route::group(['prefix' => '/admin','middleware' => 'AdminAuthencation'], function(){
    //login 
    
    // code
    Route::get('/', 'Backend\BackendController@index');
    Route::get('/add', 'Backend\CodeController@create');
    Route::get('/delete/{id}', 'Backend\CodeController@destroy');
    Route::post('/deleteall','Backend\CodeController@deleteall');
    /*Category*/
    Route::get('/category',['as' => 'quizs','uses'=> 'Backend\CategoryController@index']);
    Route::get('/category/add',['as' => 'addCategory','uses'=> 'Backend\CategoryController@createCategoryForm']);
    Route::post('/category/add','Backend\CategoryController@createCategory');
    Route::get('/category/edit/{id}', ['as' => 'editQuiz', 'uses' => 'Backend\CategoryController@editCategoryForm']);
    Route::post('/category/edit/{id}', 'Backend\CategoryController@updateCategory');
//    Route::get('/category/detail/{id}',['as' => 'detailQuiz', 'uses' => 'Backend\CategoryController@detailQuiz']);
//    Route::get('/category/delete/{id}','Backend\CategoryController@destroyQuiz');
//    Route::post('/category/deleteall','Backend\CategoryController@deleteall');
    /*End Category*/

    /*User*/
    Route::get('/users', 'Backend\UserController@users');
    //Route::p('/users', 'Backend\UserController@users');
    Route::get('/users/create','Backend\UserController@createUser');
    Route::post('/users/create','Backend\UserController@create');

    Route::get('/users/{id}', 'Backend\UserController@detail');

    Route::get('/users/detail/{id}','Backend\UserController@editForm');
    Route::post('/users/detail/{id}','Backend\UserController@updateUser');
    Route::get('/users/delete/{id}','Backend\UserController@destroyUser');
//    Route::post('/users/deleteall','Backend\UserController@deleteall');
    /*End User*/
    /*story item*/
    Route::get('/story_item', 'Backend\ItemStoryController@index');
   // Route::get('/story_item/des/{id}', 'Backend\ItemStoryController@index');
    Route::get('/story_item/create', 'Backend\ItemStoryController@create');
    Route::post('/story_item/create','Backend\ItemStoryController@postCreate');
    Route::get('/story_item/edit/{id}', 'Backend\ItemStoryController@update');
    Route::post('/story_item/edit/{id}','Backend\ItemStoryController@postUpdate');
    Route::post('/story_item/delete/{id}','Backend\ItemStoryController@delete');
    /*End story item*/

    //Content
     Route::get('/content',['as' => 'content','uses'=> 'Backend\ContentController@content']);
     Route::get('/content/add',['as' => 'addContent','uses'=> 'Backend\ContentController@createContentForm']);
     Route::post('/category/add','Backend\ContentController@create');
});
