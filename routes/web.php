<?php

use App\Http\Controllers\AdminCategoryNewsController;
use App\Http\Controllers\AdminNewsApprovalController;
use App\Http\Controllers\AdminNewsArchivedController;
use App\Http\Controllers\AdminManageUsersController;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\DashboardPostController;
use App\Http\Controllers\ChangePasswordController;
use App\Models\Official;
use App\Models\Team;

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
    return view('home', [
        "title" => "Home",
        "posts" => Post::latest()->where('is_approved', 1)->paginate(3),
        "categories" => Category::get(),
        "teams" => Team::get(),
        "list_teams" => Team::get()
    ]);
});

Route::get('/about', [AboutController::class, 'index']);
Route::get('/load-data', [AboutController::class, 'loadData']);

Route::get('/news', [PostController::class, 'index']);
Route::get('/news/{post:slug}', [PostController::class, 'show']);

Route::get('/categories', function(){
    return view('categories', [
        'title' => 'Post Categories',
        'categories' => Category::get(),
        'list_teams' => Team::get()
    ]);
});

Route::get('/contact', function(){
    return view('contact',[
        'title' => 'Contact Us',
        'categories' => Category::get(),
        'list_teams' => Team::get()
    ]);
});

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

// Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
// Route::post('/register', [RegisterController::class, 'store']);

Route::get('/dashboard', function(){
    $user_id = auth()->user()->id;
    return view('dashboard.index',[
        'countUnapprovedPosts' => Post::where('is_approved', 0)->count(),
        'latestPosts' => Post::where('is_approved', 1)->latest()->take(4)->get(),
        'totalNews' => Post::where('is_approved', 1)->count(),
        'totalOfficials' => Official::count(),
        'totalClub' => Team::count(),
        'myNews' =>Post::where('user_id', $user_id)->latest()->take(4)->get(),
        'approvedNews' =>Post::where('user_id', $user_id)->where('is_approved', 1)->count(),
        'onreviewNews' =>Post::where('user_id', $user_id)->where('is_approved', 0)->count(),
        'archivedNews' =>Post::where('user_id', $user_id)->where('is_approved', 2)->count(),
    ]);
})->middleware('auth');

Route::post('/dashboard/change-password', [ChangePasswordController::class, 'update'])->name('password.update');

Route::resource('/dashboard/news', DashboardPostController::class)->middleware('auth');

Route::resource('/dashboard/manage-users', AdminManageUsersController::class)->middleware('is_admin');

Route::get('/dashboard/need-approval', [AdminNewsApprovalController::class, 'index'])->middleware('is_admin');
Route::put('/dashboard/need-approval/{id}', [AdminNewsApprovalController::class, 'approvePost'])->name('dashboard.need-approval.approve')->middleware('auth');
Route::patch('/dashboard/need-approval/{id}', [AdminNewsApprovalController::class, 'archivePost'])->name('dashboard.need-approval.archive')->middleware('auth');

Route::get('/dashboard/archived', [AdminNewsArchivedController::class, 'index'])->middleware('is_admin');

Route::resource('/dashboard/categories-news', AdminCategoryNewsController::class)->except('show')->middleware('is_admin');
Route::resource('/dashboard/teams', AdminTeamController::class)->middleware('is_admin');

Route::resource('/dashboard/teams/{team:slug}/players', AdminPlayerController::class)->middleware('is_admin');

Route::resource('/dashboard/coaches', AdminCoachController::class)->middleware('is_admin');

Route::get('/teams', [TeamController::class, 'index']);
Route::get('/teams/{team:slug}', [TeamController::class, 'show']);

Route::resource('/dashboard/officials', AdminOfficialController::class)->middleware('is_admin');