<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\JudgeController;
use App\Http\Controllers\ContestController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CriteriaController;
use App\Http\Controllers\JudgementController;
use App\Http\Controllers\ContestantController;
use App\Http\Controllers\SubContestController;
use App\Http\Controllers\SubCriteriaController;

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


//all routes to user
Route::middleware(['auth'])->group(function () {
    
        
    //Route name prefixes
    Route::name('user.')->group(function(){
        //Incorporated in a Controller
        Route::controller(UserController::class)->group(function(){
            Route::get('/','dashboard')->name('home'); //Route assigned name "user.dashboard"
            Route::get('/dashboard','dashboard')->name('dashboard'); //Route assigned name "user.dashboard" 
            Route::get('/contest/awards/{contest_id}','awards');

        });

    });
});

//Admin Routes
Route::middleware(['auth','role:admin'])->group(function(){





    Route::prefix('admin')->group(function(){
        Route::name('admin.')->group(function(){
            Route::get('/dashboard',[AdminController::class, 'dashboard'])->name('dashboard');

            
            //Route::get('/showData',[AdminController::class,'showData'])->name('showData');
            Route::get('/contest',[AdminController::class, 'contest'])->name('contest');
            //contest search
            Route::post('/contest',[ContestController::class,'search'])->name('search');


            Route::get('/subcontest',[AdminController::class, 'subcontest'])->name('subcontest');
            Route::get('/contestants',[AdminController::class, 'contestants'])->name('contestants');
            Route::get('/judges',[AdminController::class, 'judges'])->name('judges');
            Route::get('/criterias',[AdminController::class,'criterias'])->name('criterias');
            Route::get('/subcriterias/{criteria_id}',[AdminController::class,'subcriterias'])->name('subcriterias');
            Route::get('/judgements',[AdminController::class,'judgement'])->name('judgement');
            Route::get('/awards',[AdminController::class,'awards'])->name('awards');

            
            //Contest Admin Routes
            Route::prefix('contest')->group(function(){
                Route::name('contest.')->group(function(){
                    Route::get('/read/{id}',[ContestController::class,'index'])->name('index');
                    Route::post('/create',[ContestController::class,'create'])->name('create');
                    Route::post('/update/{id}',[ContestController::class,'update'])->name('update');
                    Route::post('/delete/{id}',[ContestController::class,'delete'])->name('delete');
                    Route::get('/awards/{contest_id}',[ContestController::class,'awards'])->name('awards');
                    Route::post('/contest_award_store',[ContestController::class,'contest_award_store'])->name('awards.store');
                    Route::post('/sub_contest_award_store',[ContestController::class,'sub_contest_award_store'])->name('sub_awards.store');

                });
            });



            //SubContest Admin Routes
            Route::prefix('subcontest')->group(function(){
                Route::name('subcontest.')->group(function(){
                    Route::post('/create',[SubContestController::class,'create'])->name('create');
                    Route::post('/update/{id}',[SubContestController::class,'update'])->name('update');
                    Route::post('delete/{id}',[SubContestController::class,'delete'])->name('delete');
                });
            });


            //Contestant Admin Routes
            Route::prefix('contestant')->group(function(){
                Route::name('contestant.')->group(function(){
                    Route::post('/create',[ContestantController::class,'create'])->name('create');
                    Route::post('/update/{id}',[ContestantController::class,'update'])->name('update');
                    Route::post('/delete/{id}',[ContestantController::class,'delete'])->name('delete');
                });
            });


            //Judge Admin Routes
            Route::prefix('judge')->group(function(){
                Route::name('judge.')->group(function(){
                    Route::post('/create',[JudgeController::class,'create'])->name('create');
                    Route::post('/update/{id}',[JudgeController::class,'update'])->name('update');
                    Route::post('/delete/{id}',[JudgeController::class,'delete'])->name('delete');
                });
            });



            //Criteria Admin Routes
            Route::prefix('criteria')->group(function(){
                Route::name('criteria.')->group(function(){
                    Route::post('/create',[CriteriaController::class,'create'])->name('create');
                    Route::post('/update/{id}',[CriteriaController::class,'update'])->name('update');
                    Route::post('/delete/{id}',[CriteriaController::class,'delete'])->name('delete');

                    
                    Route::post('/subcriteria/create',[SubCriteriaController::class,'create']);
                    Route::post('/subcriteria/update',[SubCriteriaController::class,'update']);
                    Route::post('/subcriteria/delete',[SubCriteriaController::class,'delete']);
                    
                });
            });



            //Judgement Admin Routes
            Route::prefix('judgement')->group(function(){
                Route::name('judgement.')->group(function(){
                    Route::get('/index/{contest_id}/{judge_id}',[JudgementController::class,'index'])->name('index');
                    Route::post('/create/{contest_id}/{judge_id}/{contestant_id}',[JudgementController::class,'create'])->name('create');
                    Route::get('/delete/{contest_id}/{judge_id}/{contestant_id}',[JudgementController::class,'delete'])->name('delete');

                    Route::get('/subcriteria_judgement/{criteria_id}/{judge_id}/{contestant_id}/{contest_id}',[JudgementController::class,'subcriteria_index']);
                    Route::post('/subcriteria_judgement/create',[JudgementController::class,'subcriteria_create']);
                    Route::post('/subcriteria_judgement/delete',[JudgementController::class,'subcriteria_delete']);


                });
            });


        });
    });
});

//Contestant Routes
Route::middleware(['auth','role:contestant'])->group(function(){
    Route::prefix('contestant')->group(function(){
        Route::name('contestant.')->group(function(){
            //Route::get('/','dashboard')->name('home'); //Route assigned name "user.dashboard"
            Route::get('/dashboard',[ContestantController::class, 'dashboard']);
        });
    });
});

//Judge Routes
Route::middleware(['auth','role:judge'])->group(function(){
    Route::prefix('judge')->group(function(){
        Route::name('judge.')->group(function(){
            Route::get('/judgements/{judge_id}',[JudgeController::class,'judgements']);
            Route::get('/dashboard',[JudgeController::class, 'dashboard']);
        });


        //Judgement Judge Routes
        Route::prefix('judgement')->group(function(){
            Route::name('judgement.')->group(function(){
                Route::get('/index/{contest_id}/{judge_id}',[JudgeController::class,'index'])->name('index');
                Route::post('/create/{contest_id}/{judge_id}/{contestant_id}',[JudgementController::class,'create'])->name('create');
                Route::get('/delete/{contest_id}/{judge_id}/{contestant_id}',[JudgementController::class,'delete'])->name('delete');


                Route::get('/subcriteria_judgement/{criteria_id}/{judge_id}/{contestant_id}/{contest_id}',[JudgementController::class,'subcriteria_index']);
                Route::post('/subcriteria_judgement/create',[JudgementController::class,'subcriteria_create']);
                Route::post('/subcriteria_judgement/delete',[JudgementController::class,'subcriteria_delete']);
            });
        });


    });


    

});
    

require __DIR__.'/auth.php';

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
/*
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


*/
