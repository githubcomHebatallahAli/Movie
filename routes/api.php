<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\MovieController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\RolesAndPermissionsController;
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
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);

    Route::post('customer/createProfile', [CustomerController::class, 'createProfile']);
    Route::patch('customer/updatePassword/{id}', [CustomerController::class, 'updatePassword']);
    Route::post('customer/updateProfile/{id}', [CustomerController::class, 'updateProfile']);
    Route::post('customer/updateProfilePhoto/{id}', [CustomerController::class, 'updateProfilePhoto']);
    Route::post('customer/checkHistoryMovie/{id}', [CustomerController::class, 'checkHistoryMovie']);
    Route::post('customer/clearHistoryMovie/{id}', [CustomerController::class, 'clearHistoryMovie']);
    Route::post('customer/deleteSingleHistoryMovie/{id}/{movie_id}', [CustomerController::class, 'deleteSingleHistoryMovie']);
    Route::get('customer/showAllCategories', [CustomerController::class, 'showAllCategories']);
    Route::get('customer/searchAMovieByCategoryId/{id}', [CustomerController::class, 'searchAMovieByCategoryId']);
    Route::get('customer/searchAMoviePaidOrFree', [CustomerController::class, 'searchAMoviePaidOrFree']);
    Route::post('customer/addReviewForMovie/{id}', [CustomerController::class, 'addReviewForMovie']);
    Route::get('customer/editReview/{id}', [CustomerController::class, 'editReview']);
    Route::delete('customer/deleteReview/{id}', [CustomerController::class, 'deleteReview']);
    Route::get('customer/showMovieDetail/{id}', [CustomerController::class, 'showMovieDetail']);
    Route::get('customer/watchOnlyFree', [CustomerController::class, 'watchOnlyFree']);
});

Route::group([
    'middleware' => 'admin',
    'prefix' => 'admin'
], function ($router) {
    Route::post('admin/create/admin', [AdminController::class, 'createAdmin']);
    Route::post('admin/sendEmail/to/admin', [AdminController::class, 'sendEmail']);
    Route::get('admin/edit/admin/{id}', [AdminController::class, 'editAdmin']);
    Route::put('admin/update/admin/{id}', [AdminController::class, 'updateAdmin']);
    Route::delete('admin/softDelete/admin/{id}', [AdminController::class, 'destroyAdmin']);
    Route::get('admin/showDeleted/admin', [AdminController::class, 'showDeletedAdmin']);
    Route::get('admin/restore/admin/{id}', [AdminController::class, 'restoreAdmin']);
    Route::delete('admin/forceDelete/admin/{id}', [AdminController::class, 'forceDeleteAdmin']);
    //ROLE&PERMISSION
    Route::post('admin/create/role', [RolesAndPermissionsController::class, 'createRole']);
    Route::get('admin/edit/role/{id}', [RolesAndPermissionsController::class, 'editRole']);
    Route::put('admin/update/role/{id}', [RolesAndPermissionsController::class, 'updateRole']);
    Route::delete('admin/delete/role/{id}', [RolesAndPermissionsController::class, 'deleteRole']);
    Route::post('admin/create/permission', [RolesAndPermissionsController::class, 'createPermission']);
    Route::get('admin/edit/permission/{id}', [RolesAndPermissionsController::class, 'editPermission']);
    Route::put('admin/update/permission/{id}', [RolesAndPermissionsController::class, 'updatePermission']);
    Route::delete('admin/delete/permission/{id}', [RolesAndPermissionsController::class, 'deletePermission']);
    Route::get('admin/showAll/permissions', [RolesAndPermissionsController::class, 'showAllPermissions']);
    Route::post('admin/assign/role/{roleId}/to/permission/{permissionId}', [RolesAndPermissionsController::class, 'assignRoleToPermission']);
    Route::delete('admin/revoke/role/{roleId}/from/permission/{permissionId}', [RolesAndPermissionsController::class, 'unassignRoleToPermission']);
    Route::get('admin/showAll/rolesWithPermissions', [RolesAndPermissionsController::class, 'showAll']);
    Route::post('admin/assign/role/{roleId}/to/user/{userId}', [RolesAndPermissionsController::class, 'assignRoleToUser']);
    Route::delete('admin/revoke/role/{roleId}/from/user/{userId}', [RolesAndPermissionsController::class, 'revokeRoleFromUser']);
    Route::post('admin/assign/permission/{permissionId}/to/user/{userId}', [RolesAndPermissionsController::class, 'assignPermissionToUser']);
    Route::delete('admin/revoke/permission/{permissionId}/from/user/{userId}', [RolesAndPermissionsController::class, 'revokePermissionFromUser']);

    //CATEGORY
    Route::post('admin/create/category', [CategoryController::class, 'createCategory']);
    Route::get('admin/edit/category/{id}', [CategoryController::class, 'editCategory']);
    Route::put('admin/update/category/{id}', [CategoryController::class, 'updateCategory']);
    Route::delete('admin/softDelete/category/{id}', [CategoryController::class, 'destroyCategory']);
    Route::get('admin/showDeleted/category', [CategoryController::class, 'showDeletedCategory']);
    Route::get('admin/restore/category/{id}', [CategoryController::class, 'restoreCategory']);
    Route::delete('admin/forceDelete/category/{id}', [CategoryController::class, 'forceDeleteCategory']);
    Route::get('admin/showAll/categories', [CategoryController::class, 'showAllCategories']);

    // MOVIE

    Route::get('admin/edit/movie/{id}', [MovieController::class, 'editMovie']);
    Route::put('admin/update/movie/{id}', [MovieController::class, 'updateMovie']);
    Route::delete('admin/softDelete/movie/{id}', [MovieController::class, 'destroyMovie']);
    Route::get('admin/showDeleted/movie', [MovieController::class, 'showDeletedMovie']);
    Route::get('admin/restore/movie/{id}', [MovieController::class, 'restoreMovie']);
    Route::delete('admin/forceDelete/movie/{id}', [MovieController::class, 'forceDeleteMovie']);
    Route::get('admin/showAll/movies', [MovieController::class, 'showAllMovies']);
    Route::get('admin/show/movieByCategory/{id}', [MovieController::class, 'showMovieByCategoryId']);
    Route::get('admin/show/movie/paidOrFree/{id}', [MovieController::class, 'showMoviePaidOrFree']);

    //REVIEW
    Route::post('admin/create/review', [ReviewController::class, 'createReview']);
    Route::get('admin/edit/review/{id}', [ReviewController::class, 'editReview']);
    Route::put('admin/update/review/{id}', [ReviewController::class, 'updateReview']);
    Route::delete('admin/delete/review/{id}', [ReviewController::class, 'destroyReview']);
    Route::get('admin/showAll/reviews', [ReviewController::class, 'showAllReviews']);
    Route::patch('admin/hide/unhide/comment/{id}', [ReviewController::class, 'hideReview']);
});
Route::post('admin/create/movie', [MovieController::class, 'createMovie']);
