<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BranchesController;
use App\Http\Controllers\ChangeLanguageController;
use App\Http\Controllers\CustomTableController;
use App\Http\Controllers\MyFlexTablesController;
use App\Http\Controllers\SystemLangController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\EditLanguageController;
use App\Http\Controllers\MainBranchController;
use App\Http\Controllers\DeleteCustomTableController;
use App\Http\Controllers\DeleteBranchController;

use App\Http\Controllers\DeleteLangController;
use App\Http\Controllers\AdminChangeLangController;

use App\Http\Middleware\IsLogin;
use App\Http\Middleware\Auth;

Route::controller(DeleteBranchController::class)->group(function (){
    Route::post('/deleteItembranch/{id?}', 'makeDeleteBranch')->name('branch.delete')->middleware(IsLogin::class.':delete');
    Route::post('/deleteItemFlexTable/{id?}', 'makeDeleteFlexTable')->name('flextable.delete')->middleware(IsLogin::class.':delete');
});


Route::controller(MyFlexTablesController::class)->group(function () {
    Route::get('/flextable/{id?}','index')->name('MyFlexTables')->middleware(IsLogin::class.':flex');
    Route::post('/createFlexTable/{id?}', 'makeAddEditFlexTable')->name('createFlexTable')->middleware(IsLogin::class.':flex');
    Route::post('/editFlexTable/{id?}', 'makeAddEditFlexTable')->name('editFlexTable')->middleware(IsLogin::class.':flex');
});

Route::controller(SystemLangController::class)->group(function () {
    Route::get('/system/language/{lang?}/{id?}' ,'index')->name('SystemLang')->middleware(IsLogin::class.':admin');
    Route::post('/edit/{lang}/{id}/{name}/{item?}', 'makeEditLanguage')->name('edit.editAllLanguage')->middleware(IsLogin::class.':admin');
});

Route::controller(AdminChangeLangController::class)->group(function (){
    Route::post('/changeLanguage', 'makeChangeMyLanguage')->name('language.change')->middleware(IsLogin::class.':admin');
});
Route::controller(DeleteLangController::class)->group(function (){
    Route::post('/deleteLanguage', 'makeDeleteMyLanguage')->name('language.delete')->middleware(IsLogin::class.':admin');
});


Route::controller(DeleteCustomTableController::class)->group(function (){
    Route::post('/deleteTable', 'makeDeleteTable')->name('deleteTable')->middleware(IsLogin::class.':admin');
});
Route::controller(LoginController::class)->group(function () {
    Route::get('/login/{id?}','index')->name('mylogin')->middleware(Auth::class);
    Route::post('/adminLogin','makeLogin')->name('makeLogin')->middleware(Auth::class);
});
Route::controller(RegisterController::class)->group(function () {
    Route::get('/register/{id?}','index')->middleware(Auth::class);
    Route::post('/adminRegister','makeRegister')->name('makeRegister')->middleware(Auth::class);
});
Route::controller(HomeController::class)->group(function () {
    Route::get('/home','index')->name('Home')->middleware(IsLogin::class.':admin');
});
Route::controller(BranchesController::class)->group(function () {
    Route::get('/branches','index')->name('Branches')->middleware(IsLogin::class.':admin');
    Route::post('/addBranchRays', 'makeAddBranch')->name('addBranchRays')->middleware(IsLogin::class.':admin');
    Route::post('/editBranchRays', 'makeEditBranch')->name('editBranchRays')->middleware(IsLogin::class.':admin');
});
Route::controller(ChangeLanguageController::class)->group(function () {
    Route::get('/changeLanguage','index')->name('ChangeLanguage')->middleware(IsLogin::class.':admin');
    Route::post('/newLanguage', 'makeAddLanguage')->name('lang.createLanguage')->middleware(IsLogin::class.':admin');
    Route::post('/copyLanguage', 'makeEditLanguage')->name('language.copy')->middleware(IsLogin::class.':admin');
});
Route::controller(CustomTableController::class)->group(function () {
    Route::get('/customTable','index')->name('CustomTable')->middleware(IsLogin::class.':admin');
    Route::post('/addTable', 'makeAddTable')->name('addTable')->middleware(IsLogin::class.':admin');
    Route::post('/editTable', 'makeEditTable')->name('editTable')->middleware(IsLogin::class.':admin');
});


Route::controller(EditLanguageController::class)->group(function () {
    Route::post('/editlanguage','makeChangeLanguage')->name('makeChangeLanguage')->middleware(Auth::class);
});
Route::controller(LogoutController::class)->group(function () {
    Route::get('/logout','logout')->name('logout')->middleware(IsLogin::class.':admin');
});
Route::controller(MainBranchController::class)->group(function (){
    Route::post('/branchMain', 'makeChangeBranch')->name('branchMain')->middleware(IsLogin::class.':admin');
});