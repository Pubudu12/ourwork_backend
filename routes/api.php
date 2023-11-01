<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\jobTypesController;
use App\Http\Controllers\API\CareerController;
use App\Http\Controllers\API\APIOurWorks;
use App\Http\Controllers\API\APIBlogController;
use GuzzleHttp\Client;
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
    'namespace'=> 'App\Http\Controllers',
    'prefix' => 'auth',
], function($router){
    Route::post('login',[AuthController::class,'login']);
    Route::post('register',[AuthController::class,'register']);
    Route::post('logout',[AuthController::class,'logout']);
    Route::get('profile',[AuthController::class,'profile']);
    Route::post('refresh',[AuthController::class,'refresh']);
});


Route::group([
    'middleware' => 'api',
    'namespace'=> 'App\Http\Controllers',
], function($router){
    // Route::resource('todos', [TodoController::class,'index']);

    //job types api
    Route::get('/jobList',[jobTypesController::class,'showJobs']);
    Route::get('jobList/{id}',[jobTypesController::class,'showData']);

    //career api
    Route::get('/careerList',[CareerController::class,'viewCareers']);
    Route::get('/filter/{category_id}/{type_id?}',[CareerController::class,'filterCareers']);
    Route::get('careerSingle/{id}',[CareerController::class,'singleCareer']);

/*
|--------------------------------------------------------------------------
| API Routes for our works
|--------------------------------------------------------------------------
|*/
    //our work api
    Route::get('/filterWorks/{category_id}',[APIOurWorks::class,'filterByCategory']);
    Route::get('singleWork/{id}',[APIOurWorks::class,'singleWork']);
    Route::get('workCategories',[APIOurWorks::class,'fetchWorkCategories']);
    Route::get('enabledWorks/{category_code}/{limit?}',[APIOurWorks::class,'filterEnabledWorks']);

/*
|--------------------------------------------------------------------------
| API Routes for Blog
|--------------------------------------------------------------------------
|*/
    //All Categories
    Route::get('/blog/categories',[APIBlogController::class,'blogCategories']);
    
    //All Tags
    Route::get('/blog/tags',[APIBlogController::class,'blogTags']); 

    //All Posts
    Route::get('/blog/posts/{limit}',[APIBlogController::class,'blogPostsAll']);

    //Single Posts
    Route::get('blog/{post_url_slug}',[APIBlogController::class,'blogSingle']);

    //Search Posts
    Route::get('/blog/search/{keyword}/{limit}',[APIBlogController::class,'searchPost']);

    //Blog Posts by Category
    Route::get('/blog/category/posts/{category_code}/{limit}',[APIBlogController::class,'blogPostsByCategory']);
    // Route::get('/blog/category/posts/{category_name}/{limit?}',[APIBlogController::class,'blogPostsByCategory']);
    
    //Blog Posts by Tag
    Route::get('/blog/tags/posts/{tag_code}/{limit}', [APIBlogController::class, 'blogPostsByTags']);
    // Route::get('/blog/tags/{tag_code}/{limit?}',[APIBlogController::class,'blogPostsByTags']);
    
    //Related Posts
    Route::get('/blog/related/{current_post_slug}',[APIBlogController::class,'relatedPosts']);

    //Recent Posts
    Route::get('/blog/recent/{limit}',[APIBlogController::class,'recentPosts']);

    //Popular Posts
    Route::get('/blog/popular/{limit}',[APIBlogController::class,'popularPosts']);

});