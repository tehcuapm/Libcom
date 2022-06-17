<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PanierController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;


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

Route::get('/', function () {
    return view('home');
})->name('home');

Route::group(['middleware' => ['role:admin']], function () {
    Route::get('/admin', [AdminController::class, 'showAdmin'])->name('admin');
    Route::get('/admin-create', [AdminController::class, 'showAdminCreate'])->name('admin.createArticle');
    Route::get('/admin-delete', [AdminController::class, 'showAdminDelete'])->name('admin.deleteArticle');
    Route::get('/admin-addimg', [AdminController::class, 'showAdminAddImg'])->name('admin.addImg');
    Route::post('/admin-addimg', [AdminController::class, 'addImages'])->name('add.image');
    Route::post('/admin', [AdminController::class, 'addArticles'])->name('new.article');
    Route::get('/adminreset', [AdminController::class, 'resetPage']);
    Route::put('catalog/product/{article}', [ArticleController::class, 'update'])->name('update.article');
    Route::delete('/admin-addimage', [AdminController::class, 'delImages'])->name('delete.image');
    Route::delete('/admin-delete', [AdminController::class, 'deleteArticle'])->name('delete.article');
    Route::get("/admin/users", [AdminController::class, "showUsers"])->name("admin.users");
    Route::get("/users/all", [AdminController::class, "getUsers"])->name("admin.users.get");
});

Route::middleware(["auth"])->group(function () {
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware(["auth", "no-verified"])->group(function () {

    Route::get('/verify', [EmailVerificationController::class, 'show'])->name('verification.notice');
    Route::post('/verify', [EmailVerificationController::class, 'send'])->name('verification.send');
    Route::get('/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])->name('verification.verify')->middleware("signed");
});
Route::middleware(['auth', 'verify'])->group(function () {
    Route::resource("article", ArticleController::class)->parameters([
        "article" => "id"
    ]);

    Route::get("sort", [SearchController::class, "getSortCatalog"])->name('sort.catalog');
    Route::resource("order", OrderController::class);

    Route::get('panier', [PanierController::class, "getPanierView"])->name("panier.show");
    Route::get("panier/all", [PanierController::class, "getPanierData"])->name("panier.data");
    Route::get("panier/quantity", [PanierController::class, "getPanierQuantity"])->name("panier.quantity");
    Route::get("panier/price", [PanierController::class, "getPanierPrice"])->name("panier.price");

    Route::post('panier/add', [PanierController::class, "addArticle"])->name("panier.add")->middleware("panier-check");
    Route::post('panier/update/{id}', [PanierController::class, "updateArticle"])->name("panier.update")->middleware("panier-check");
    Route::get('panier/remove/{id}', [PanierController::class, "removeArticle"])->name("panier.remove");
    Route::get('panier/clear', [PanierController::class, "clearPanier"])->name("panier.clear");
    Route::post('/search', [SearchController::class, "searchArticle"]);
    Route::post('searchimage', [SearchController::class, "searchImage"]);
});
Route::middleware(["auth", "user-edition"])->group(function () {
    Route::get("/profile/edit/{user}", [ProfileController::class, "editForm"])->name("profile.editor");
    Route::post("/profile/edit/{user}", [ProfileController::class, "edit"])->name("profile.edit");
    Route::post("/avatar/add/{user}", [ProfileController::class, "addAvatar"])->name("avatar.add");
});
Route::middleware(["auth", "address-edition"])->group(function () {
    Route::get("/addresses/{user}", [AddressController::class, "index"])->name("addresses.index");
    Route::get("/addresses/new/{user}", [AddressController::class, "new"])->name("addresses.new");

    Route::get("/address/edit/{address}", [AddressController::class, "editForm"])->name("address.form");
    Route::put("/address/edit/{address}", [AddressController::class, "update"])->name("address.edit");
    Route::get("/address/delete/{address}", [AddressController::class, "destroy"])->name("address.delete");
    Route::get("/addresses/clear/{user}", [AddressController::class, "clear"])->name("addresses.clear");
    Route::get("/addresses/orders/{address}", [AddressController::class, "showOrders"])->name("address.orders");
});
Route::middleware('guest')->group(function () {

    Route::get('/login', [AuthController::class, 'getLoginForm'])->name('login.form');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/register', [AuthController::class, 'getRegisterForm'])->name('register.form');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::get('/forgot', [PasswordResetController::class, 'forgotForm'])->name('password.forgot');
    Route::post('/forgot', [PasswordResetController::class, 'sendEmail'])->name('password.email');
    Route::get('/reset/{token}/{email}', [PasswordResetController::class, 'resetForm'])->name("password.reset")->middleware("reset-check");
    Route::post('/reset', [PasswordResetController::class, 'changePassword'])->name("password.update");
});
Route::get("/profile/{id}", [ProfileController::class, "show"])->name("profile.show")->middleware("public-profile");
