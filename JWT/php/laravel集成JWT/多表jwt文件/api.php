<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['namespace'=>'api'],function(){

    Route::post('/users-register','UsersController@usersRegister');
    Route::post('/user-login','UsersController@userLogin');
    Route::post('/login','AuthController@login');
    Route::post('/create','AuthController@create');
    Route::post('/bureau-user-login','BureauUserController@userLogin');
    Route::post('/bureau-user-register','BureauUserController@userRegister');
    Route::post('/planner-user-login','PlannerUserController@userLogin');
    Route::post('/planner-user-register','PlannerUserController@userRegister');
//    Route::post('/act-attribute-list','ActivityAttributeController@actAttributeList');

});
    Route::group(['namespace'=>'api','prefix'=>'users','middleware'=>['jwt_refresh_token:users','jwt.auth:api']],function(){
        Route::post('/users-check','UsersController@usersCheck');
        Route::post('/users-sel','UsersController@usersSel');
        Route::post('/login-out','UsersController@loginOut');
        Route::post('/role-add','RoleController@roleAdd');
        Route::post('/role-update','RoleController@roleUpdate');
        Route::post('/role-sel','RoleController@roleSel');
        Route::post('/rolesel-nopage','RoleController@roleSelNoPage');

        Route::post('/permission-add','PermissionController@permissionAdd');
        Route::post('/permission-update','PermissionController@permissionUpdate');
        Route::post('/permission-role-sel','PermissionController@permissionRoleSel');
        Route::post('/permission-sel-all','PermissionController@permissionSelAll');
        Route::post('/role-sel-power','PermissionController@roleSelPower');
        Route::post('/distribute-permission','PermissionController@distributePermission');
        Route::post('/unbind-permission','PermissionController@unbindPermission');
        Route::post('/permission-length','PermissionController@permissionLength');

        Route::post('/bureau-add','BureauController@bureauAdd');
        Route::post('/bureau-update','BureauController@bureauUpdate');
        Route::post('/bureau-delete','BureauController@bureauDelete');
        Route::post('/bureau-list','BureauController@bureauList');
        Route::post('/bureau-sel','BureauController@bureauSel');

        Route::post('/bureau-user-add','BureauUserController@userAdd');
        Route::post('/bureau-user-check','BureauUserController@userCheck');

        Route::post('/planner-add','PlannerController@plannerAdd');
        Route::post('/planner-update','PlannerController@plannerUpdate');
        Route::post('/planner-del','PlannerController@plannerDel');
        Route::post('/planner-list','PlannerController@plannerList');

        Route::post('/planner-user-add','PlannerUserController@userAdd');
        Route::post('/planner-user-check','PlannerUserController@userCheck');

        Route::post('/project-add','ProjectController@projectAdd');
        Route::post('/project-distribute','ProjectController@projectDistribute');
        Route::post('/project-update','ProjectController@projectUpdate');
        Route::post('/project-delete','ProjectController@projectDelete');
        Route::post('/project-list','ProjectController@projectList');

        Route::post('/template-add','TempalteController@templateAdd');
        Route::post('/template-exist-add','TempalteController@templateExistAdd');
        Route::post('/template-update','TempalteController@templateUpate');
        Route::post('/template-list','TempalteController@templateList');
        Route::post('/template-del','TempalteController@templateDel');

        Route::post('/attribute-add','TemAttributeController@attributeAdd');
        Route::post('/attribute-update','TemAttributeController@attriburteUpdate');
        Route::post('/attribute-del','TemAttributeController@attributeDel');
        Route::post('/attribute-list','TemAttributeController@attributeList');

        Route::post('/value-add','TemValueController@valueAdd');

        Route::post('/type-add','ActivityTypeController@typeAdd');
        Route::post('/type-update','ActivityTypeController@typeUpdate');
        Route::post('/type-del','ActivityTypeController@typeDel');
        Route::post('/type-list','ActivityTypeController@typeList');
        Route::post('/type-sel','ActivityTypeController@typeSel');


        Route::post('/act-attribute-add','ActivityAttributeController@actAttributeAdd');
        Route::post('/act-attribute-list','ActivityAttributeController@actAttributeList');
    });

Route::group(['namespace'=>'api','prefix'=>'bureau','middleware'=>['jwt_refresh_token:bureau','jwt.auth:bureau']],function(){
    Route::post('/act-attribute-list','ActivityAttributeController@actAttributeList');
});

Route::group(['namespace'=>'api','prefix'=>'planner','middleware'=>['jwt_refresh_token:planner','jwt.auth:planner']],function(){
    Route::post('/act-attribute-list','ActivityAttributeController@actAttributeList');
});