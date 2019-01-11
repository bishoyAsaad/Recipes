<?php
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request;
use App\Recipe;
//Auth::logout();
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

Auth::routes();
Route::get('/', function () {
    return view('home');
})->name('home');


Route::get('product/{name}','productController@show');

Route::get('search','recipeController@search');

route::get('featured','recipeController@featured');
Route::get('recipe/products','recipeController@products');
Route::apiResource('recipe','recipeController');
Route::get('user','usercontroller@index');
Route::get('user/{name}','usercontroller@index')->name('user');
Route::get('user/{name}/recipes','usercontroller@recipes');
/*Route::get('/recipes/{title}',function($title){
    $products=App\Recipe::where('title', $title)->first()->products;
    foreach ($products as $product) {
        echo("<a href=".route('product', ['name' => $product->name]).">"
        .str_replace('-',' ',$product->name)."</a><br/>");
    }
})->name('recipe');*/
Route::get('/products/featured','productController@featured');

Route::get('/logout', function(){
    Auth::logout();
    return redirect()->route('home');
});

Route::get('/changePassword','usercontroller@change_pass');
Route::post('/changePassword','usercontroller@change_pass')->name('chang_pass');

Route::get('/changeName','usercontroller@change_name');
Route::post('/changeName','usercontroller@change_name')->name('chang_name');

Route::get('/getCurrentUser', function(){
    if(Auth::check())
    {
        $user=Auth::user();
        $array=[$user->name,$user->id];
        return $array;
    }
    else {return null;}
})->middleware('api');

Route::get('/test',function(Request $req){
    Recipe::findOrFail(15)->raters()->attach('c42f3279-c88c-3e63-a5a2-6f3d6f12f10e',
                    ['rating'=>2.5]);
});
