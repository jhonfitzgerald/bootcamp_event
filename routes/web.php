<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\OrganizerController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('organizer', [OrganizerController::class, 'index'])->name('organizer');
Route::post('getallorganizers', [OrganizerController::class, 'getAllOrganizers'])->name('getallorganizers');
Route::post('saveupdateorganizer', [OrganizerController::class, 'saveUpdateOrganizer'])->name('saveupdateorganizer');
Route::post('deleteorganizer', [OrganizerController::class, 'deleteOrganizer'])->name('deleteorganizer');
Route::get('category', [CategoryController::class, 'index'])->name('category');
Route::post('getallcategories', [CategoryController::class, 'getAllCategories'])->name('getallcategories');
Route::post('saveupdatecategory', [CategoryController::class, 'saveUpdateCategory'])->name('saveupdatecategory');
Route::post('deletecategory', [CategoryController::class, 'deleteCategory'])->name('deletecategory');
Route::get('event', [EventController::class, 'index'])->name('event');
Route::post('getallevents', [EventController::class, 'getAllNeedbox'])->name('getallevents');
Route::post('saveupdateevent', [EventController::class, 'saveUpdateEvent'])->name('saveupdateevent');
Route::post('deleteevent', [EventController::class, 'deleteEvent'])->name('deleteevent');
