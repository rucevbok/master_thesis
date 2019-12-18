<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;

class ChecklistControllerTwo extends Controller
{
    public function index()
    {
    	$projekty_uzivatele =  collect(DB::select('select p.idproj, p.nazev, pc.login FROM projekt as p INNER JOIN projekty_a_clenove as pc ON pc.idproj=p.idproj INNER JOIN checklist_projektu as cp ON cp.idproj= p.idproj'))->where('login', auth()->user()->email)->unique()->values();

    	$projekty_s_checklistem = collect(DB::select('select p.idproj, p.nazev, checklist_projektu.id_oblasti, checklist_projektu.poradi,oc.nazev_oblasti, pc.login, pc.role, ot.otazka FROM checklist_projektu JOIN projekt as p ON checklist_projektu.idproj=p.idproj  JOIN projekty_a_clenove as pc ON pc.idproj=p.idproj JOIN otazky_checklistu as ot ON ot.id_oblasti = checklist_projektu.id_oblasti AND ot.poradi = checklist_projektu.poradi JOIN oblast_checklistu as oc ON oc.id_oblasti= ot.id_oblasti order by p.idproj,  oc.nazev_oblasti,checklist_projektu.poradi'))->where('login', auth()->user()->email)->values();

//    	return $projekty_uzivatele;
    	return view('checklisttwo',compact('projekty_s_checklistem','projekty_uzivatele'));
    }

    public function show($id)
    {
    	$projekty_uzivatele =  collect(DB::select('select p.idproj, p.nazev, pc.login FROM projekt as p INNER JOIN projekty_a_clenove as pc ON pc.idproj=p.idproj INNER JOIN checklist_projektu as cp ON cp.idproj= p.idproj'))->where('login', auth()->user()->email)->unique()->values();

    	$projekty_s_checklistem = collect(DB::select('select p.idproj, p.nazev, checklist_projektu.id_oblasti, checklist_projektu.splneno, checklist_projektu.komentar,checklist_projektu.poradi,oc.nazev_oblasti, pc.login, pc.role, ot.otazka FROM checklist_projektu JOIN projekt as p ON checklist_projektu.idproj=p.idproj JOIN projekty_a_clenove as pc ON pc.idproj=p.idproj JOIN otazky_checklistu as ot ON ot.id_oblasti = checklist_projektu.id_oblasti AND ot.poradi = checklist_projektu.poradi JOIN oblast_checklistu as oc ON oc.id_oblasti= ot.id_oblasti order by p.idproj, oc.nazev_oblasti,checklist_projektu.poradi'))->where('login', auth()->user()->email)->where('idproj',$id)->values();
    	//return $projekty_s_checklistem;
    	$old_oblast = '}1.?*$res';
    	$id_proj = $id;
    	$proj = \App\Project::where('idproj',$id_proj)->first();
    	return view('checklisttwo_two',compact('projekty_s_checklistem','proj','projekty_uzivatele','old_oblast','id_proj'));
    }


    public function update(Request $request)
   	{

   		//return $request;
   		if(!empty($request->splneno))
    	{
    		$tasky = \App\checklistProjektu::where('idproj',$request->idproj)->update(['splneno' => 0]);
			foreach ($request->splneno as $val){ 
				$piece = explode("*", $val);
				
   				$affected = DB::update('update checklist_projektu set splneno = ? where idproj = ? and poradi = ? and id_oblasti= ?', [1, $request->idproj, $piece[0], $piece[1]]);
			}
    	}
    	else
    	{

    		$tasky = \App\checklistProjektu::where('idproj',$request->idproj)->update(['splneno' => 0]);

    	}
   		
   		foreach ($request->except('_token','splneno','idproj') as $key => $part) {
			$piece = explode("*", $key);
			if (is_null($part))
			{
				$part = "";
			}
			$affected = DB::update('update checklist_projektu set komentar = ? where idproj = ? and poradi = ? and id_oblasti = ?', [$part, $request->idproj, $piece[0],$piece[1]]);

		}


//REST
    	$projekty_uzivatele =  collect(DB::select('select p.idproj, p.nazev, pc.login FROM projekt as p INNER JOIN projekty_a_clenove as pc ON pc.idproj=p.idproj INNER JOIN checklist_projektu as cp ON cp.idproj= p.idproj'))->where('login', auth()->user()->email)->unique()->values();

    	$projekty_s_checklistem = collect(DB::select('select p.idproj, p.nazev, checklist_projektu.id_oblasti, checklist_projektu.splneno, checklist_projektu.komentar,checklist_projektu.poradi,oc.nazev_oblasti, pc.login, pc.role, ot.otazka FROM checklist_projektu JOIN projekt as p ON checklist_projektu.idproj=p.idproj  JOIN projekty_a_clenove as pc ON pc.idproj=p.idproj JOIN otazky_checklistu as ot ON ot.id_oblasti = checklist_projektu.id_oblasti AND ot.poradi = checklist_projektu.poradi JOIN oblast_checklistu as oc ON oc.id_oblasti= ot.id_oblasti order by p.idproj, oc.nazev_oblasti,checklist_projektu.poradi'))->where('login', auth()->user()->email)->where('idproj',$request->idproj)->values();
    	//return $projekty_s_checklistem;
    	$old_oblast = '}1.?*$res';
    	$id_proj = $request->idproj;
    	$proj = \App\Project::where('idproj',$id_proj)->first();
    	return view('checklisttwo_two',compact('projekty_s_checklistem','proj','projekty_uzivatele','old_oblast','id_proj'));

   	} 
   
   public function insert(Request $request)
   {
   $projekty_uzivatele =  collect(DB::select('select p.idproj, p.nazev, pc.login FROM projekt as p INNER JOIN projekty_a_clenove as pc ON pc.idproj=p.idproj INNER JOIN checklist_projektu as cp ON cp.idproj= p.idproj'))->where('login', auth()->user()->email)->unique()->values();

    $projekty_s_checklistem = collect(DB::select('select p.idproj, p.nazev, checklist_projektu.id_oblasti, checklist_projektu.splneno, checklist_projektu.komentar,checklist_projektu.poradi,oc.nazev_oblasti, pc.login, pc.role, ot.otazka FROM checklist_projektu JOIN projekt as p ON checklist_projektu.idproj=p.idproj  JOIN projekty_a_clenove as pc ON pc.idproj=p.idproj JOIN otazky_checklistu as ot ON ot.id_oblasti = checklist_projektu.id_oblasti AND ot.poradi = checklist_projektu.poradi JOIN oblast_checklistu as oc ON oc.id_oblasti= ot.id_oblasti order by p.idproj, oc.nazev_oblasti,checklist_projektu.poradi'))->where('login', auth()->user()->email)->where('idproj',$request->idproj)->values();

    $vsechny_otazky = collect(DB::select('select ot.id_oblasti, ot.poradi, ot.otazka, oc.nazev_oblasti from otazky_checklistu as ot JOIN oblast_checklistu as oc ON oc.id_oblasti = ot.id_oblasti order by ot.id_oblasti, ot.poradi'));


    $otazky_projektu = collect(DB::select('select ot.id_oblasti, ot.poradi, ot.otazka, oc.nazev_oblasti, cp.idproj from otazky_checklistu as ot JOIN oblast_checklistu as oc ON oc.id_oblasti = ot.id_oblasti JOIN checklist_projektu as cp ON ot.id_oblasti=cp.id_oblasti AND ot.poradi = cp.poradi'))->where('idproj',$request->idproj); 

    //return $vsechny_otazky;
    foreach ($vsechny_otazky as $key => $value) {
    	foreach ($otazky_projektu as $item) {

    		if(($value->poradi == $item->poradi) && ($value->id_oblasti == $item->id_oblasti))
    		{
    			$vsechny_otazky->forget($key);
    			continue;
    		}
    	}
    }
    //return $id_proj;
   // return $vsechny_otazky->values();


    $old_oblast = '}1.?*$res';
    $id_proj = $request->idproj;
    $proj = \App\Project::where('idproj',$id_proj)->first();
   	return view('checklisttwo_three',compact('id_proj','proj','projekty_uzivatele','projekty_s_checklistem','old_oblast','vsechny_otazky'));

   }

   public function store(Request $request)
   {
  
   		if(!empty($request->pridat))
    	{
    		foreach ($request->pridat as $value) {
    			$piece = explode("*", $value);
				
				$proj = new \App\checklistProjektu;
        		$proj->idproj = $request->idproj;
				$proj->id_oblasti = $piece[1];
				$proj->poradi =$piece[0];
				$proj->splneno = 0;
				$proj->komentar = "";
        		$proj->save();

    		}
    		
    	}
    	$projekty_uzivatele =  collect(DB::select('select p.idproj, p.nazev, pc.login FROM projekt as p INNER JOIN projekty_a_clenove as pc ON pc.idproj=p.idproj INNER JOIN checklist_projektu as cp ON cp.idproj= p.idproj'))->where('login', auth()->user()->email)->unique()->values();

    	$projekty_s_checklistem = collect(DB::select('select p.idproj, p.nazev, checklist_projektu.id_oblasti, checklist_projektu.splneno, checklist_projektu.komentar,checklist_projektu.poradi,oc.nazev_oblasti, pc.login, pc.role, ot.otazka FROM checklist_projektu JOIN projekt as p ON checklist_projektu.idproj=p.idproj  JOIN projekty_a_clenove as pc ON pc.idproj=p.idproj JOIN otazky_checklistu as ot ON ot.id_oblasti = checklist_projektu.id_oblasti AND ot.poradi = checklist_projektu.poradi JOIN oblast_checklistu as oc ON oc.id_oblasti= ot.id_oblasti order by p.idproj, oc.nazev_oblasti,checklist_projektu.poradi'))->where('login', auth()->user()->email)->where('idproj',$request->idproj)->values();
    	//return $projekty_s_checklistem;
    	$old_oblast = '}1.?*$res';
    	$id_proj = $request->idproj;
    	$proj = \App\Project::where('idproj',$id_proj)->first();
    	return view('checklisttwo_two',compact('projekty_s_checklistem', 'proj', 'projekty_uzivatele', 'old_oblast','id_proj'));
 
   }

	public function admin_insert()
	{
		$vsechny_otazky = collect(DB::select('select ot.id_oblasti, ot.poradi, ot.otazka, oc.nazev_oblasti from otazky_checklistu as ot JOIN oblast_checklistu as oc ON oc.id_oblasti = ot.id_oblasti order by id_oblasti, poradi'));
		$old_oblast = '}1.?*$res';
		$oblasti = \App\oblastChecklist::all();

		return view('cl_admin',compact('vsechny_otazky','old_oblast','oblasti'));
	}

	public function admin_store(Request $request)
	{
		$max_poradi = \App\otazkyChecklist::all()->where('id_oblasti',$request->oblast)->pluck('poradi')->max();
		

		$proj = new \App\otazkyChecklist;
		
		$proj->id_oblasti = $request->oblast;
		$proj->poradi = $max_poradi+1;
		$proj->otazka = $request->otazka;
		$proj->save();
		

		$vsechny_otazky = collect(DB::select('select ot.id_oblasti, ot.poradi, ot.otazka, oc.nazev_oblasti from otazky_checklistu as ot JOIN oblast_checklistu as oc ON oc.id_oblasti = ot.id_oblasti order by id_oblasti, poradi'));
		$old_oblast = '}1.?*$res';
		$oblasti = \App\oblastChecklist::all();

		return view('cl_admin',compact('vsechny_otazky','old_oblast','oblasti'));
	}











}













