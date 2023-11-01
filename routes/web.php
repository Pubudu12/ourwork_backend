<?php

use Illuminate\Support\Facades\Route;

use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\handlers\jobTypesController;
use App\Http\Controllers\careers\careersController;
use App\Http\Controllers\handlers\categoriesController;
use App\Http\Controllers\detailSectionsController;
use App\Http\Controllers\ourwork\OurWorkController;
use App\Http\Controllers\ourwork\ourWorkCategoriesController;
use App\Http\Controllers\users\AuthController;
use App\Http\Controllers\Blog\BlogController;
use App\Http\Controllers\handlers\DashboardController;
use App\Http\Controllers\Gallery\GalleryController;

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

/*
|--------------------------------------------------------------------------
| Laravel Welcome Page
|--------------------------------------------------------------------------*/

Route::get('/', function () {
    return view('account/login');
});


/*
|--------------------------------------------------------------------------
| Login
|--------------------------------------------------------------------------*/

Route::get('/login', function () {
    return view('account/login');
});

Route::post('login',[AuthController::class,'login']);



Route::group(['middleware' => AdminMiddleware::class], function() {

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------*/
    
    Route::get('/dashboard', [DashboardController::class,'counts']);    
   
    Route::get('createUser', function () {
        return view('admin/createUser');
    });
    
    Route::post('createUser',[AuthController::class,'register']);
    
    Route::get('/logout', [AuthController::class,'logoutAdmin']);

    Route::get('/username', [AuthController::class,'CurrentUser']);


    /*
    |--------------------------------------------------------------------------
    | Users
    |--------------------------------------------------------------------------*/

    // --- View Users ---
    Route::get('users',[AuthController::class,'showUsers']);


    // --- Delete Users ---
    Route::get('delete_user/{id}',[AuthController::class,'deleteUsers']);

    // --- Update Detail Section ---
    Route::get('updatePassword/{id}',[AuthController::class,'showData']);
    Route::post('updatePassword/{id}',[AuthController::class,'updatePassword']);


    /*
    |--------------------------------------------------------------------------
    | Gallery
    |--------------------------------------------------------------------------*/

    Route::get('gallery',[GalleryController::class,'getImages']);

    Route::get('gallery/create', function () {
        return view('gallery/createGalleryItem');
    });

    Route::post('createGalleryItem', [GalleryController::class, 'createGalleryItem']);

    Route::get('gallery/delete/{id}', [GalleryController::class, 'deleteGalleryItem']);

    Route::get('gallery/update/{id}', [GalleryController::class, 'fetchGalleryDetails']);

    Route::post('gallery/update', [GalleryController::class, 'updateGalleryItem']);
    
    /*
    |--------------------------------------------------------------------------
    | Blog Category
    |--------------------------------------------------------------------------*/

    Route::get('blog/categories', [BlogController::class, 'getCategories']);

    Route::get('blog/createCategories', function(){
        return view('blog/blogCategories/createCategories');
    });
    
    Route::post('blog/createCategories', [BlogController::class, 'createBlogCategories']);

    Route::get('blog/updateCategory/{categoryId}', [BlogController::class, 'getBlogCategoryById']);

    Route::post('blog/updateCategory', [BlogController::class, 'updateBlogCategories']);

    Route::get('blog/deleteCategory/{categoryId}', [BlogController::class, 'deleteBlogCategories']);

    
    /*
    |--------------------------------------------------------------------------
    | Tags
    |--------------------------------------------------------------------------*/

    Route::get('blog/tags', [BlogController::class, 'getTags']);

    Route::get('blog/createTag', function(){
        return view('blog/blogTag/createTag');
    });

    Route::post('blog/createTag', [BlogController::class, 'createBlogTag']);

    Route::get('blog/updateTag/{tagId}', [BlogController::class, 'getBlogTagById']);

    Route::post('blog/updateTag', [BlogController::class, 'updateBlogTag']);

    Route::get('blog/deleteTag/{tagId}', [BlogController::class, 'deleteBlogtag']);

    
    /*
    |--------------------------------------------------------------------------
    | Blogs
    |--------------------------------------------------------------------------*/

    //List
    Route::get('blog', [BlogController::class, 'getBlogs']);

    //Create
    Route::get('blog/create', [BlogController::class, 'getBlogCreate']);
    Route::post('blog/create', [BlogController::class, 'createBlog']);

    //Update
    Route::get('blog/update/{postId}', [BlogController::class, 'getBlogPostById']);
    Route::post('updateBlog', [BlogController::class, 'updateBlog']);
    
    Route::get('blog/content/{postId}', [BlogController::class, 'Blogcontent']);
    Route::POST('blog/content/update', [BlogController::class, 'UpdateBlogcontent']);

    Route::post('changeBlogStatus',[BlogController::class,'changeStatus']);
    Route::post('changePopularStatus',[BlogController::class,'changePopularStatus']);
    Route::post('changeHighlightStatus',[BlogController::class,'changeHighlightStatus']);

    //Delete
    Route::get('blog/delete/{postId}', [BlogController::class, 'deleteBlog']);

    Route::get('addBlogImage/{id}', [BlogController::class, 'addBlogImage']);
    Route::post('addBlogImage/{id}', [BlogController::class, 'saveImage']);

    /*
    |--------------------------------------------------------------------------
    | Careers
    |--------------------------------------------------------------------------*/

    // --- Create Careers ---

    Route::get('addCareer',[careersController::class,'displayPage']);
    Route::post('addCareer',[careersController::class,'addCareer']);


    // --- View Careers ---  
    Route::get('careerList',[careersController::class,'showCareers']);


    // --- Update Careers ---
    Route::get('update_career/{id}',[careersController::class,'fetchCareerData']);
    Route::post('update_career',[careersController::class,'updateCareer']);

    // --- Delete Careers ---
    Route::get('delete_career/{id}',[careersController::class,'deleteCareer']);

    Route::get('viewCareer/{id}',[careersController::class,'viewCareer']);
    /*
    |--------------------------------------------------------------------------
    | Career Image
    |--------------------------------------------------------------------------*/

    // -------------------------- Insert and Update ------------------------- //

    Route::get('addCareerImage/{id}', [careersController::class, 'addCareerImage']);
    Route::post('addCareerImage/{id}', [careersController::class, 'saveImage']);


    /*
    |--------------------------------------------------------------------------
    | Career Details
    |--------------------------------------------------------------------------*/

    // --- Insert and Update Career Details ---
    Route::get('updateCareerDetails/{id}',[careersController::class,'fetchSectionDetails']);
    Route::post('updateCareerDetails',[careersController::class,'updateCareerDetails']);


    /*
    |--------------------------------------------------------------------------
    | Job Types
    |--------------------------------------------------------------------------*/

    // --- Create Job Types ---
    Route::get('createJob', function () {
        return view('job_types/createJob');
    });

    Route::post('createJob',[jobTypesController::class,'createJob']);

    // --- Retrieve Job Types ---
    Route::get('jobList',[jobTypesController::class,'showJobs']);


    // --- Update Job Types ---
    Route::get('update_job_type/{id}',[jobTypesController::class,'showData']);
    Route::post('update_job_type/{id}',[jobTypesController::class,'updateJobType']);


    // --- Delete Job Types ---
    Route::get('delete_job_type/{id}',[jobTypesController::class,'deleteJobType']);


    /*
    |--------------------------------------------------------------------------
    | Career Categories
    |--------------------------------------------------------------------------*/

    // --- Create Categories ---
    Route::get('createCategory', function () {
        return view('categories/createCategory');
    });
    Route::post('createCategory',[categoriesController::class,'createCategory']);


    // --- Retrieve Categories ---
    Route::get('categoryList',[categoriesController::class,'showCategories']);


    // --- Update Categories ---
    Route::get('update_category/{id}',[categoriesController::class,'showData']);
    Route::post('update_category/{id}',[categoriesController::class,'updateCategory']);


    // --- Delete Job Categories ---
    Route::get('delete_category/{id}',[categoriesController::class,'deleteCategory']);


    /*
    |--------------------------------------------------------------------------
    | Our Work Categories
    |--------------------------------------------------------------------------*/

    // --- Create Our Work Categories ---
    Route::get('createOurWorkCategory',[ourWorkCategoriesController::class,'desgnTypeList']);
    Route::post('createOurWorkCategory',[ourWorkCategoriesController::class,'createOurWorkCategory']);


    // --- Retrieve Our Work Categories ---
    Route::get('ourWorkCategoryList',[ourWorkCategoriesController::class,'showOurWorkCategories']);


    // --- Update Our Work Categories ---
    Route::get('updateOurworkCategory/{id}',[ourWorkCategoriesController::class,'showData']);
    Route::post('updateOurworkCategory/{id}',[ourWorkCategoriesController::class,'updateOurWorkCategory']);


    // --- Delete Categories ---
    Route::get('deleteOurworkCategory/{id}',[ourWorkCategoriesController::class,'deleteOurWorkCategory']);

    /*
    |--------------------------------------------------------------------------
    | Our Work 
    |--------------------------------------------------------------------------*/
    // Case study
    Route::get('caseStudy', function () {
        return view('ourWork/works/workCaseStudy');
    });

    Route::post('caseStudy', [OurWorkController::class, 'storeCaseStudy']);
    Route::get('updateCaseStudy/{id}', [OurWorkController::class, 'getCaseStudy']);
    Route::post('updateCaseStudy', [OurWorkController::class, 'updateCaseStudy']);

    //work Category Order 
    Route::get('categoryOrder', [ourWorkCategoriesController::class, 'categoryOrder']);
    Route::post('updatecategoryOrder', [ourWorkCategoriesController::class, 'updatecategoryOrder']);

    // Our Work Order
    Route::get('workOrder', [OurWorkController::class, 'workList']);
    Route::post('updateWorkOrder', [OurWorkController::class, 'updateWorkOrder']);

    // --- Create Our Work Image ---

    Route::get('addOurWorkImage/{id}', [OurWorkController::class, 'addOurWorkImage']);
    Route::post('uploadWorkImage', [OurWorkController::class, 'saveImage']);

    /*
    |--------------------------------------------------------------------------
    | Detail Section
    |--------------------------------------------------------------------------*/

    // --- Create Detail Section ---
    Route::get('addDetailSection', function () {
        return view('detail_section/addDetailSection');
    });
    Route::post('addDetailSection',[detailSectionsController::class,'addDetailSection']);

    // --- Retrieve Detail Section ---
    Route::get('detailSectionList',[detailSectionsController::class,'showDetailSections']);

    // --- Update Detail Section ---
    Route::get('update_detail_section/{id}',[detailSectionsController::class,'showData']);
    // Route::post('update_detail_section/{id}',[detailSectionsController::class,'updateDetailSection']);

    // --- Delete Detail Section ---
    Route::get('delete_detail_section/{id}',[detailSectionsController::class,'deleteDetailSection']);

    Route::get('career_details', function () {
        return view('careers/careerDetails');
    });


    Route::get('updateJob', function () {
        return view('job_types/updateJob');
    });

    Route::post('updateJob/{id}',[createJobController::class,'updateJob']);

    Route::get('jobImage', function () {
        return view('job_types/jobImage');
    });
    Route::get('jobDetails', function () {
        return view('job_types/jobDetails');
    });

    
    /*
    |--------------------------------------------------------------------------
    | Our Work
    |--------------------------------------------------------------------------*/

    // --- Create Our Work ---
    Route::get('createOurWork',[OurWorkController::class,'showOurWork']);
    Route::post('createOurWork',[OurWorkController::class,'createOurWork']);


    // --- View Our Work ---
    Route::get('ourWorkList',[OurWorkController::class,'ourWorkList']);

    //update show home page view
    Route::post('changeHomepageStatus',[OurWorkController::class,'changeHomepageStatus']);
    Route::post('updateOurWorkOrder',[OurWorkController::class,'updateOurWorkOrder']);
    Route::post('changeStatus',[OurWorkController::class,'changeStatus']);

    Route::get('updateOurwork/{id}',[OurWorkController::class,'showData']);
    Route::post('updateOurwork',[OurWorkController::class,'updateOurwork']);

    // --- Delete Our Work ---
    Route::get('deleteOurwork/{id}',[OurWorkController::class,'deleteWork']);


    // DoGood
        /*
    |--------------------------------------------------------------------------
    | DoGood Category
    |--------------------------------------------------------------------------*/

    Route::get('dogood/categories', [DoGoodCategoryController::class, 'getCategories']);

    Route::get('dogood/category/create', function(){
        return view('dogood/category/create');
    });
    
    Route::post('dogood/category/create', [DoGoodCategoryController::class, 'createBlogCategories']);

    Route::get('dogood/category/update/{categoryId}', [DoGoodCategoryController::class, 'getBlogCategoryById']);

    Route::post('dogood/category/update', [DoGoodCategoryController::class, 'updateBlogCategories']);

    Route::get('dogood/category/delete/{categoryId}', [DoGoodCategoryController::class, 'deleteBlogCategories']);

    });
