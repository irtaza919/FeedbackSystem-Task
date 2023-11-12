<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProductController;






Route::prefix("dashboard")->group(function(){
        Route::get("/",[DashboardController::class, "index"])->name("dashboard");
});


#############Biding###########################
Route::prefix("location")->group(function(){
        Route::get("/",[LocationController::class, "index"])->name("location");
        Route::get("/read",[LocationController::class, "read"])->name("location.read");
        Route::get("/store",[LocationController::class, "store"])->name("location.store");
        Route::get("/readbyid/{id?}",[LocationController::class, "readById"])->name("location.readbyid");
});
Route::prefix("feedback")->group(function(){
    Route::post("/",[FeedbackController::class, "index"])->name("feedback.index");
    Route::post("/read",[FeedbackController::class, "read"])->name("feedback.read");
    Route::post("/store",[FeedbackController::class, "store"])->name("feedback.store");
    Route::get("/readbyid/{id?}",[FeedbackController::class, "readById"])->name("feedback.readbyid");
});

Route::prefix("comment")->group(function(){
    Route::post("/",[CommentController::class, "index"])->name("comment.index");
    Route::post("/read",[CommentController::class, "read"])->name("comment.read");
    Route::post("/store",[CommentController::class, "store"])->name("comment.store");
    Route::get("/readbyid/{id?}",[CommentController::class, "readById"])->name("comment.readbyid");
});

Route::prefix("product")->group(function(){
    Route::post("/",[ProductController::class, "index"])->name("product.index");
    Route::post("/read",[ProductController::class, "read"])->name("product.read");
    Route::post("/store",[ProductController::class, "store"])->name("product.store");
    Route::get("/readbyid/{id?}",[ProductController::class, "readById"])->name("product.readbyid");
});


Route::get('/', function () {return view('auth.login');});

Route::group(['middleware' => ['auth']], function() {
        Route::get("/home",[DashboardController::class, "home"])->name("home");
        Route::post("/read_comments",[DashboardController::class, "read_comments"])->name("read_comments");
        Route::post("/store_comments",[DashboardController::class, "store_comments"])->name("store_comments");
        Route::get("/getUsers",[DashboardController::class, "getUsers"])->name("getUsers");
        Route::get('/comments/{id?}', [DashboardController::class, "reply"])->name('comments');
        Route::get('/feedbacks/{id}', [DashboardController::class, "feedbacks"])->name('feedbacks');
        Route::post("/store_feedback",[DashboardController::class, "store_feedback"])->name("store_feedback");
        Route::post("/read_feedbacks",[DashboardController::class, "read_feedbacks"])->name("read_feedbacks");
        Route::post("/give_vote_feedbacks",[DashboardController::class, "give_vote_feedbacks"])->name("give_vote_feedbacks");


        

########################################Roles###############################################

     Route::prefix("roles")->group(function(){
        Route::get("/",[RolesController::class, "index"])->name("roles.index");
        Route::get("/read",[RolesController::class, "read"])->name("roles/read");
        Route::get("/store",[RolesController::class, "store"])->name("roles/store");
        Route::get("/readbyid/{id?}",[RolesController::class, "readById"])->name("roles/readbyid");
        Route::get("/readbycondition",[RolesController::class, "ReadByCondition"])->name("roles/readbycondition");
});

########################################Users###############################################

Route::prefix("user")->group(function(){
        Route::get("/",[UserController::class, "index"])->name("user.index");
        Route::get("/read",[UserController::class, "getAll"])->name("user.read");
        Route::post("/store",[UserController::class, "store"])->name("user.store");
        Route::get("/update",[UserController::class, "update"])->name("user.update");
        Route::get("/readById/{id?}",[UserController::class, "readById"])->name("user.readbyid");
        Route::post('/delete/{id}', [UserController::class, 'delete'])->name('user.delete');
});


Route::get('/perfil', [UserController::class, 'profile'])->name('user.profile');
Route::post('/profile', [UserController::class, 'postProfile'])->name('user.postProfile');
Route::get('/password/cambiar-contrasen', [UserController::class, 'getPassword'])->name('userGetPassword');
Route::post('/password/change', [UserController::class, 'postPassword'])->name('userPostPassword');



});
Route::prefix("feedback")->group(function(){
        Route::get("/",[FeedbackController::class, "index"])->name("feedback.index");
        Route::get("/read",[FeedbackController::class, "read"])->name("feedback.read");
        Route::post("/store",[FeedbackController::class, "store"])->name("feedback.store");
        Route::get("/update",[FeedbackController::class, "update"])->name("feedback.update");
        Route::get("/readById/{id?}",[FeedbackController::class, "readById"])->name("feedback.readbyid");
        Route::post('/delete/{id}', [FeedbackController::class, 'delete'])->name('feedback.delete');
});

Route::prefix("product")->group(function(){
        Route::get("/",[ProductController::class, "index"])->name("product");
});
Route::prefix("comment")->group(function(){
        Route::get("/",[CommentController::class, "index"])->name("comment");
});











require __DIR__.'/auth.php';

