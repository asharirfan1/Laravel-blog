<?php

use App\Http\Controllers\allController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;


Route::get('/greeting/{locale}', function (string $locale) {
    if (! in_array($locale, ['en', 'es', 'fr'])) {
        abort(400);
    }

    App::setLocale($locale);

    // ...
});

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});





Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::resource('post', PostController::class);
Route::resource('all', allController::class);
Route::resource('Comment', CommentController::class);

Route::post('comment/{comment}',[CommentController::class,'store'])->name('comment');
Route::get('comment/{comment}/edit',[CommentController::class,'edit']);
Route::put('comment/{comment}', [CommentController::class, 'update'])->name('comment.update');
Route::delete('/comment/{comment}', [CommentController::class, 'destroy'])->name('Comment.d');





            // tags routes

                    Route::get('/tags', [TagController::class, 'index'])->name('tag.index');

                    Route::get('/tags/create', [TagController::class, 'create'])->name('tag.create');

                    Route::post('/tags', [TagController::class, 'store'])->name('tag.store');

                    Route::get('/tags/{tag}', [TagController::class, 'show'])->name('tag.show');

                    Route::post('/tags/{tag}/edit', [TagController::class, 'edit'])->name('tag.edit');

                    Route::put('/tags/{tag}', [TagController::class, 'update'])->name('tag.update');

                    Route::delete('/tags/{tag}', [TagController::class, 'destroy'])->name('tag.destroy');



    //routing for emial


     Route::get('/email' , function (){
        return new \App\Mail\CommentMail();
       });



                    //Cetegory routes

                    Route::get('categories' , [CategoryController::class, 'index'])->name('category.index');

                    Route::get('categories/create' , [CategoryController::class, 'create'])->name('category.create');


                    Route::Post('categories/store' , [CategoryController::class, 'store'])->name('category.store');

                    Route::get('/categories/show/{category}', [CategoryController::class, 'show'])->name('category.show');



                    Route::get('categories/edit/{category}/edit' , [CategoryController::class, 'edit'])->name('category.edit');

                    Route::put('categories/update/{category}' , [CategoryController::class, 'update'])->name('category.update');


                    Route::Delete('categories/delete/{category}' , [CategoryController::class, 'destroy'])->name('category.destroy');

                    Route::get('/filter', [CategoryController::class,'filter'])->name('filter.fil');

                    Route::post('category-import',[CategoryController::class , 'import'])->name('category.import');



