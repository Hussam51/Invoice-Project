<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\InvoiceDetailsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SectionController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

//use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Auth::routes();
Auth::routes();
Route::get('/', function () {
    return view('welcome');
});


Route::group(['middleware' => ['auth'],'prefix' => LaravelLocalization::setLocale()], function () {



    ////////////    reports        ////////////

    Route::get('report_invoices', [ReportController::class, 'index_invoice'])->name('report.invoices');

    Route::get('report_costumer', [ReportController::class, 'index_customer'])->name('report.customers');
    Route::post('search_invoice', [ReportController::class, 'search_invoice'])->name('search.invoices');

    Route::post('search_customer', [ReportController::class, 'search_customer'])->name('search.customers');


    ////////////         sections           /////////////


    Route::get('sections', [SectionController::class, 'index'])->name('sections.index');
    Route::post('sections/store', [SectionController::class, 'store'])->name('sections.store');

    Route::put('sections/update', [SectionController::class, 'update'])->name('sections.update');

    Route::put('sections/destroy', [SectionController::class, 'destroy'])->name('sections.destroy');
    Route::get('section/{id}', [InvoiceController::class, 'getproducts']);
    Route::get('/home', [HomeController::class, 'index'])->name('home');


    ////////////          User         /////////////////
    Route::resource('users', UserController::class);



    ///////////              Role       ///////////////////
    Route::resource('roles', RoleController::class);


    ///////////      invoices         ///////////////

    Route::resource('invoices', 'InvoiceController');


    /////////////      products           ///////////////
    Route::get('products', [ProductController::class, 'index'])->name('products.index');

    Route::post('products/store', [ProductController::class, 'store'])->name('products.store');

    Route::put('products/update', [ProductController::class, 'update'])->name('products.update');

    Route::put('products/destroy', [ProductController::class, 'destroy'])->name('products.destroy');

    Route::get('/{page}', [AdminController::class, 'index']);

    ///////////              Role       ///////////////////
    Route::resource('roles', RoleController::class);

    ////////////          User         /////////////////
    Route::resource('users', UserController::class);



    Route::get('invoice/{id}/details', [InvoiceController::class, 'details'])->name('invoice.details');
    //   invoice payment  //

    Route::get('show-status/{id}', [InvoiceController::class, 'showstatus'])->name('show.status.payment');
    Route::post('update-status/{id}', [InvoiceController::class, 'update_status'])->name('update.status.payment');
    Route::get('invoicespay/unpaid', [InvoiceController::class, 'unpaid'])->name('invoices.unpaid');
    Route::get('invoicespay/partially_paid', [InvoiceController::class, 'partially_paid'])->name('invoices.partially_paid');
    Route::get('invoicespay/paid', [InvoiceController::class, 'paid'])->name('invoices.paid');
    /////////     notifications          //////////////

    Route::get('make_all_read', [InvoiceController::class, 'make_all_read'])->name('notifications.make.read');

/////////////////

    Route::get('View/{number}/{name}', [ReportController::class, 'view_file'])->name('view_file');

    Route::get('Download/{number}/{name}', [ReportController::class, 'download_file']);

    Route::delete('attach/destroy', [InvoiceController::class, 'destroy'])->name('attach.destroy');
    Route::post('attach/insert', [InvoiceController::class, 'attachinsert'])->name('invoice.attachments');

    Route::get('invoicesarch/archivment', [ReportController::class, 'archivment'])->name('invoices.archivment');
    Route::delete('invoicesarch/archive_invoice', [ReportController::class, 'archive_invoice'])->name('invoice.archive');
    Route::get('invoice/print/{id}', [ReportController::class, 'invoice_print'])->name('invoice.print');
    Route::get('all_invoice/export', [ReportController::class, 'export'])->name('invoice.export');
    Route::put('invoicesarch/archive_transfer', [ReportController::class, 'archive_transfer'])->name('archive.transfer');

    Route::delete('invoicesarch/archive_destroy', [ReportController::class, 'archive_destroy'])->name('archive.destroy');
});






