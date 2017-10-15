<?php
use App\Lecture;
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
    return view('welcome');
});
Route::get('/addcontent', function () {
    return view('addcontent');
});
Route::get('/addclass', function () {
    return view('addclass');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
/*
|--------------------------------------------------------------------------
| ELOQUENT
|--------------------------------------------------------------------------
*/
//Route::get('/addcontent', function () {
    //find through id
//    $lecture = Lecture::find(1);
//    return $lecture->id;
    //find and return all of the instances
//    $lectures = Lecture::all();
//    foreach($lectures as $lecture){
//        return $lecture->lecturename;
//    }
    //get all data from a instance
//    $lectures = Lecture::where('id',1)->orderBy('id','desc')->take(1)->get();
//    return $lectures;
    //find or fail method
//    $lecture = Lecture::findOrFail(2);
//    return $lecture;
    //insert data
//    $lecture = new Lecture;
//    $lecture->lecturename = 'new';
//    $lecture->save();
    //update date
//    $lecture = Lecture::find(2);
//    $lecture->lecturename = 'newrefresh';
//    $lecture->save();
    //create date
    //Lecture::create(['lecturename'=>'lecturename']);
    //delete data
//    $lecture = Lecture::find(2);
//    $lecture->delete();
    //soft delete
//    Lecture::find(4)->delete();
    //retrieve deleted data
//    $lecture = Lecture::withTrashed()->where('id',4)->get();
//    return $lecture;
    //    $lecture = Lecture::onlyTrashed()->where('id',4)->get();
    //restore deleted data
//    $lecture =Lecture::find(4)->get();
//    return $lecture;
    //force delete
    //Lecture::withTrashed()->where('id',4)->forceDelete();
//});
//one to many
Route::get('/topics',function(){
   $lecture = Lecture::find(1);
   foreach($lecture->topics as $topic){
       echo $topic->topicname."<br>";
   }
});
Route::resource('/home','ClassController');
