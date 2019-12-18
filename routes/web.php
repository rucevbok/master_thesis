<?php

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
//if(strcmp(Auth::user()->role,'admin')==0)

//Route::get('/', 'HomeController@index');

Route::get('/', function () {
    if(Auth::check())
    {   

        if(strcmp(Auth::user()->role,'admin')==0)
        {
         return redirect('vytvorit_uzivatele');   
        }
    }
	if(Auth::check())
	{	

		$proj_clen = collect(DB::select('select p.idproj, p.nazev, pc.role, pc.login FROM projekty_a_clenove as pc JOIN projekt as p on pc.idproj=p.idproj'))->where('role',auth()->user()->role)->where('login', auth()->user()->email)->values();
    	return view('welcome',compact($proj_clen));
	}
    else
    {
    	return view('welcome');
    }
})->name('index');


Route::get('/vytvorit_uzivatele','userController@index')->name('vytvorit_uz');
Route::patch('/smazat','userTeamController@destroy');
Route::patch('/uloz_uzivatele','userController@save');
Route::get('/odebrat_clena/{project}/{user}','userController@destroy');
Route::post('/pridat_clena_save','userTeamController@insert_one');
Route::post('/pridat_clena_save_2','userTeamController@insert_two');
Route::get('smazat_uz_proj/{project}/{user}', 'userTeamController@delete');
Route::post('/upravit_manag', 'userTeamController@update_manager');


Route::get('/neopr_pristup','neopravnenyPristup@index');

Route::get('/riskowner/{user}','rizikaController@index');
Route::get('/riskowner/{user}/{project}','rizikaController@show_detail');

Route::get('/swot', 'swotController@index');
Route::get('/swot_uprava/{project}', 'swotController@show')->name('uprava_swotu');
Route::post('/swot_uprava/{project}/save', 'swotController@update');


Route::get('/smazat_projekt/{project}','projektController@destroy');
Route::get('/uzivatel_tym', 'userTeamController@index')->name('uzivatel_tym');
Route::get('/detail_projektu/{project}','userTeamController@show');
Route::get('/pridat_clena_tymu/{project}','userTeamController@insert');


Route::get('/smazat_atribut/{project}/{atribut}', 'polozkySablonyController@destroy');
Route::patch('/pridat_projekt', 'projektController@save');
Route::get('/pridat_clena','userTeamController@insert_zero');
Route::get('/uzivatel_tym_pridat_pr','userTeamController@store_lvl_two');
//Route::get('/', 'projektController@index');
Route::get('/projekt', 'projektController@index')->name('proj');
Route::get('/projekt/vytvor', 'projektController@create');
Route::patch('/projekt', 'projektController@store');
Route::get('/projekt/{project}', 'rizikaController@index');
Route::get('/projekt/{project}/rejstrik', 'rizikaController@show')->name('rejstr');
Route::get('/polozky_sablony', 'polozkySablonyController@index');
Route::get('/upravit_rejstrik', 'rejstrikController@index')->name('uprav');
Route::get('/rejstrik/{project}','rejstrikController@show');
Route::get('/rejstrik/{project}/create_risk','rejstrikController@create');
Route::patch('/rejstrik/{project}/save_risk','rejstrikController@save_risk');
Route::get('/rejstrik/{project}/{cislor}','rejstrikController@update');
//Route::get('/smazat_projekt','projektController@destroy');
//Route::get('/smazat_projekt/{project}','projektController@smazat');
Route::get('/mapa_rizik','rejstrikController@mapa_rizik');

Route::get('checklist_admin', 'ChecklistControllerTwo@admin_insert');
Route::post('cl_pridat', 'ChecklistControllerTwo@admin_store');

Route::get('/blink/{case}','rizikaController@blink');
Route::patch('/rejstrik/{project}/{cislor}/store','rejstrikController@store');

//NOVEJ CHeckList
//Route::get('/checklist', 'ChecklistController@index');
Route::get('/checklist2', 'ChecklistControllerTwo@index');

//NOVEJ CHeckList
//Route::get('/checklist/{project}', 'ChecklistController@show');
Route::get('/checklisttwo/{project}', 'ChecklistControllerTwo@show');

Route::get('/katalog','katalogController@index')->name('katalog');
Route::patch('/katalog/vloz','katalogController@insert');
Route::post('/katalog/vlozdo_projektuP','polozkySablonyController@insert');
Route::post('/katalog/vlozdo_projektuA','polozkySablonyController@store');


//NOVEJ CHeckList
//Route::post('/checklist/{project}/uprav', 'ChecklistController@update')->name('uprava_checklistu');
Route::post('/checklisttwo/{project}/uprav', 'ChecklistControllerTwo@update')->name('uprava_checklistuTwo');

Route::post('/checklisttwo/{project}/pridat','ChecklistControllerTwo@insert');
Route::post('/checklisttwo/{project}/store','ChecklistControllerTwo@store');

Route::post('/checklist/insert', 'ChecklistController@insert');

Route::get('/set_projekt/{project}','cookieController@sample2');


Route::post('katalog_smazat','katalogController@destroy');
Auth::routes();

//Route::get('/', 'HomeController@index');



//Route::get('/', 'HomeController@index')->name('home');



Route::get('/home', 'HomeController@index')->name('home');
