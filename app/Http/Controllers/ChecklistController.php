<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use Auth;

class ChecklistController extends Controller
{
    public function index()
    {

    	$moje_checklisty = collect(DB::select('select p.idproj, p.nazev, checklist.poradi, checklist.polozka, checklist.komentar, pc.login, pc.role FROM checklist RIGHT JOIN projekt as p on checklist.idproj=p.idproj JOIN projekty_a_clenove as pc on pc.idproj=p.idproj'))->where('login', auth()->user()->email)->values();
    	

    	$moje_projekty = $moje_checklisty->unique('idproj');
    		
    	return view ('checklist', compact('moje_checklisty','moje_projekty'));
    }

    public function show($id)
    {

		$moje_checklisty = collect(DB::select('select p.idproj, p.nazev, checklist.poradi, checklist.polozka, checklist.komentar, checklist.splneno, pc.login, pc.role FROM checklist RIGHT JOIN projekt as p on checklist.idproj=p.idproj JOIN projekty_a_clenove as pc on pc.idproj=p.idproj'))->where('login', auth()->user()->email)->values();
    	
	    
	    $checklist_projektu = $moje_checklisty->where('idproj',$id)->values();
	    
        //return $checklist_projektu;
	    $moje_projekty = $moje_checklisty->unique('idproj');
	    
	    $id_proj=$id;

	   

	    return view ('checklist_two', compact('checklist_projektu','moje_projekty','id_proj'));

    }
    public function update(Request $request)
    {	

    	if (!empty($request->smazat))
    	{
    		DB::table('checklist')->where('idproj', $request->idproj)->where('poradi', $request->smazat)->delete();
    	}
    	
    	if(!empty($request->splneno))
    	{
			foreach ($request->splneno as $val){ 
   				$affected = DB::update('update checklist set splneno = ? where idproj = ? and poradi = ? ', [true, $request->idproj, $val]);
			}
    	}
    	else
    	{

    		$tasky = \App\Checklist::where('idproj',$request->idproj)->update(['splneno' => 0]);



    	}
 	
		
    	foreach ($request->except('_token') as $key => $part) {
			$pos = stripos($key, '*');		
			$r_poradi = substr($key, 0,$pos);
			$r_pol_kom_spl = substr($key, $pos+1,strlen($key));
			$r_val = $part;
			//echo $r_poradi.":".$r_pol_kom_spl.":".$r_val."<br>";
			if(strcmp($r_pol_kom_spl, 'polozka')==0)
			{
				$affected = DB::update('update checklist set polozka = ? where idproj = ? and poradi = ? ', [$r_val, $request->idproj, $r_poradi]);
			}
			else if(strcmp($r_pol_kom_spl, 'komentar')==0)
			{
				$affected = DB::update('update checklist set komentar = ? where idproj = ? and poradi = ? ', [$r_val, $request->idproj, $r_poradi]);
			}

		}
		$moje_checklisty = collect(DB::select('select p.idproj, p.nazev, checklist.poradi, checklist.polozka, checklist.komentar, checklist.splneno, pc.login, pc.role FROM checklist RIGHT JOIN projekt as p on checklist.idproj=p.idproj JOIN projekty_a_clenove as pc on pc.idproj=p.idproj'))->where('login', auth()->user()->email)->values();
    	
	    $checklist_projektu = $moje_checklisty->where('idproj',$request->idproj)->values();
	    
	    $moje_projekty = $moje_checklisty->unique('idproj');
	    
	    $id_proj=$request->idproj;

    	return view ('checklist_two', compact('checklist_projektu','moje_projekty','id_proj'));
    }
    public function insert(Request $request)
    {
    	$max_poradi = \App\Checklist::all()->where('idproj',$request->idproj)->pluck('poradi')->max();
    	$vlozeno = DB::insert('insert into checklist (idproj, poradi, polozka, komentar, splneno) values (?, ?, ?,?,?)', [$request->idproj, $max_poradi+1, $request->polozka,$request->komentar,false]);


    	$moje_checklisty = collect(DB::select('select p.idproj, p.nazev, checklist.poradi, checklist.polozka, checklist.komentar, checklist.splneno, pc.login, pc.role FROM checklist RIGHT JOIN projekt as p on checklist.idproj=p.idproj JOIN projekty_a_clenove as pc on pc.idproj=p.idproj'))->where('login', auth()->user()->email)->values();
    	
	    
	    $checklist_projektu = $moje_checklisty->where('idproj',$request->idproj)->values();
	    
	    $moje_projekty = $moje_checklisty->unique('idproj');
	    
	    $id_proj=$request->idproj;

	    return view ('checklist_two', compact('checklist_projektu','moje_projekty','id_proj'));
    }
    public function destroy(Request $request)
    {
    	return $request;
    }



}
