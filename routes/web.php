<?php
//Front end
/*Route điều hướng trong front end*/
Route::get('/', 'Frontend\FrontendController@login');
Route::post('/', 'Frontend\FrontendController@postLogin');
Route::group(['prefix' => '/','middleware' => 'UserAuthencation'], function(){

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
    Route::get('/', 'Backend\BackendController@index');
    // code  
    Route::get('/code', 'Backend\CodeController@index');
    Route::get('/code/create', 'Backend\CodeController@create');
    Route::post('/code/deleteall','Backend\CodeController@deleteall');
    /*Category*/
    Route::get('/category','Backend\CategoryController@index');
    Route::get('/category/add','Backend\CategoryController@createCategoryForm');
    Route::post('/category/add','Backend\CategoryController@createCategory');
    Route::get('/category/edit/{id}', 'Backend\CategoryController@editCategoryForm');
    Route::post('/category/edit/{id}', 'Backend\CategoryController@updateCategory');
//    Route::get('/category/detail/{id}',['as' => 'detailQuiz', 'uses' => 'Backend\CategoryController@detailQuiz']);
//    Route::get('/category/delete/{id}','Backend\CategoryController@destroyQuiz');
//    Route::post('/category/deleteall','Backend\CategoryController@deleteall');
    /*End Category*/

    /*User*/
    Route::get('/users', 'Backend\UserController@users');
    Route::get('/users/create','Backend\UserController@createUser');
    Route::post('/users/create','Backend\UserController@create');
    Route::get('/users/{id}', 'Backend\UserController@detail');
    Route::get('/users/detail/{id}','Backend\UserController@editForm');
    Route::post('/users/detail/{id}','Backend\UserController@updateUser');
    Route::get('/users/delete/{id}','Backend\UserController@destroyUser');
    /*End User*/
    /*story item*/
    Route::get('/story_item', 'Backend\ItemStoryController@index');
    Route::get('/story_item/des/{id}', 'Backend\ItemStoryController@detail');
    Route::get('/story_item/create', 'Backend\ItemStoryController@create');
    Route::post('/story_item/create','Backend\ItemStoryController@postCreate');
    Route::get('/story_item/edit/{id}', 'Backend\ItemStoryController@update');
    Route::post('/story_item/edit/{id}','Backend\ItemStoryController@postUpdate');
    Route::get('/story_item/delete/{id}','Backend\ItemStoryController@delete');
    /*End story item*/

    //Content
     Route::get('/content', 'Backend\ContentController@content');
     Route::get('/content/add', 'Backend\ContentController@createContentForm');
     Route::post('/content/add','Backend\ContentController@create');
});
