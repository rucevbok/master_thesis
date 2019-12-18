<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use Cookie;
use DB;
use Auth;
class swotController extends Controller
{

    protected function autor ($id)
    {
      $je_zapsan = \App\userTeam::where('login',auth()->user()->email)->where('idproj',$id)->first();
        
        if( empty($je_zapsan))
        {
            $row = new \App\neopravnenyPristup;
            $row->idproj = $id;
            $row->email = auth()->user()->email;
            $row->detaily = "pokus o přístup do detailu projektu";
            $row->save();
            return true;
            
        }
        return false;
    }
    public function index(Request $request)
    { 
     // $value = \App\Cookie::get('project');
      
      //return $value;
  
    	$swotky = collect(DB::select('select p.idproj, p.nazev, swot.strengths, swot.weak, swot.opport, swot.threats, pc.login, pc.role FROM swot JOIN projekt as p on swot.idproj=p.idproj JOIN projekty_a_clenove as pc on pc.idproj=p.idproj'))->where('login', auth()->user()->email)->values();

    	return view ('swot', compact('swotky'));
    }

    public function show($id)
   	{
      if (self::autor($id))
      {
        return redirect()->route('proj') ->with('alert', 'Uživatel není zapsán k projektu.\nPokus o přístup byl zaznamenán.');
      }

    	$swotky = collect(DB::select('select p.idproj, p.nazev, p.popis, swot.strengths, swot.weak, swot.opport, swot.threats, pc.login, pc.role FROM swot JOIN projekt as p on swot.idproj=p.idproj JOIN projekty_a_clenove as pc on pc.idproj=p.idproj'))->where('login', auth()->user()->email)->values();

   		$swot = \App\SWOT::all()->where('idproj',$id)->values()->first();
   		$idpr=$id;
   		$edit_flag=0;
      $popis_projektu = \App\Project::all()->where('idproj',$id)->first();
   	
   		return view ('swot2', compact('swot','swotky','idpr','edit_flag','popis_projektu'));
   	}
   	public function update($id)
   	{
   		$edit_flag=1;
   		$affected = DB::update('update swot set strengths = ? where idproj = ?', [request()->strengths, $id]);
   		$affected = DB::update('update swot set weak = ? where idproj = ?', [request()->weak, $id]);
   		$affected = DB::update('update swot set opport = ? where idproj = ?', [request()->opport, $id]);
   		$affected = DB::update('update swot set threats = ? where idproj = ?', [request()->threats, $id]);
   		return redirect()->route('uprava_swotu', [
    		'project' => $id
		])->with( ['edit_flag' => $edit_flag] );

   		//return request();
   	}
}
