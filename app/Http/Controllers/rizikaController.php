<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class rizikaController extends Controller
{
    public function index($user)
    {
        if(strcmp(auth()->user()->email, $user)!==0)
        {
            $row = new \App\neopravnenyPristup;
            $row->idproj = "0";
            $row->email = auth()->user()->email;
            $row->detaily = "pokus o zobrazeni vlastnictvi rizik";
            $row->save();
            
            return redirect()->route('proj')->with('alert', 'Nesouhlasí login přihl. uživatele.\nPokus o přístup byl zaznamenán.');
        }
//select p.nazev, p.idproj, r.cislor, r.nazev_rizika,pol.hodnota FROM projekt as p LEFT JOIN riziko as r ON r.idproj= p.idproj LEFT JOIN polozka_riziko as pol ON pol.idproj=p.idproj'))->where('hodnota

        $moje_projekty = collect(DB::select('select p.nazev, p.idproj,pol.hodnota FROM projekt as p LEFT JOIN riziko as r ON r.idproj= p.idproj LEFT JOIN polozka_riziko as pol ON pol.idproj=p.idproj'))->where('hodnota', $user)->unique();
        //return $moje_rizika;
        $detail_rizik_proj= new \Illuminate\Database\Eloquent\Collection;
        return view ('rowner', compact('moje_projekty','detail_rizik_proj'));
    	
    }

    public function show_detail($user, $project)
    {
        if(strcmp(auth()->user()->email, $user)!==0)
        {
            $row = new \App\neopravnenyPristup;
            $row->idproj = "0";
            $row->email = auth()->user()->email;
            $row->detaily = "pokus o zobrazeni vlastnictvi rizik";
            $row->save();
            
            return redirect()->route('proj')->with('alert', 'Nesouhlasí login přihl. uživatele.\nPokus o přístup byl zaznamenán.');
        }
        $moje_projekty = collect(DB::select('select p.nazev, p.idproj,pol.hodnota FROM projekt as p LEFT JOIN riziko as r ON r.idproj= p.idproj LEFT JOIN polozka_riziko as pol ON pol.idproj=p.idproj'))->where('hodnota', $user)->unique();

        $detail_rizik_proj = collect(DB::select('select p.nazev, p.idproj, r.cislor, r.nazev_rizika,pol.hodnota FROM projekt as p LEFT JOIN riziko as r ON r.idproj= p.idproj LEFT JOIN polozka_riziko as pol ON pol.idproj=p.idproj'))->where('hodnota',$user)->where('idproj',$project)->unique();

        return view ('rowner', compact('moje_projekty','detail_rizik_proj'));
    }

    public function show($id)
    {
    	//$project = \App\Project::where('idproj', $id);
    	//$project = \App\Rizika::where('idproj', $id);

        $aut = \App\userTeam::all()->where('login', auth()->user()->email)->where('idproj',$id)->first();
        if( empty($aut))
        {
            $row = new \App\neopravnenyPristup;
            $row->idproj = $id;
            $row->email = auth()->user()->email;
            $row->detaily = "pokus o přístup do rejstříku rizik";
            $row->save();
            
            return redirect()->route('proj')->with('alert', 'Uživatel není zapsán k projektu.\nPokus o přístup byl zaznamenán.');
        }
        $detaily_projektu = \App\Project::all()->where('idproj', $id)->first();
        $tym = collect(DB::select('select u.name, pc.idproj from users as u LEFT JOIN projekty_a_clenove as pc ON pc.login=u.email'))->where('idproj', $id)->pluck('name');
        
        //return $tym;
        $manazer = \App\userTeam::all()->where('idproj', $id)->where('role','projmanazer')->first()->login;
        $man_name = \App\User::all()->where('email', $manazer)->first()->name;
        
        $nazev_projektu = \App\Project::where('idproj', $id);
        $nazev_proj = $nazev_projektu->get()->first()->nazev;

    	$project = \App\Rizika::where('idproj', $id);
    	$res = $project->get();
    	$risks = collect(DB::select('select ps.atribut, ps.idproj, k.popis from polozka_sabl as ps LEFT JOIN katalog as k ON k.atribut=ps.atribut'))->where('idproj', $id);
    	$riskse = $risks->values();
        
    	$hodnoty = \App\PolozkyRiziko::where('idproj', $id);
    	$hodnotyres = $hodnoty->get()->sort(function($a, $b) {
   			if($a->cislor === $b->cislor) {
     			if($a->atribut === $b->atribut) {
       				return 0;
     			}
     			return $a->atribut < $b->atribut ? -1 : 1;
   			} 
   		return $a->cislor < $b->cislor ? -1 : 1;
		})->values();
       // return $hodnotyres;
        $multiplied = $hodnotyres->map(function ($itemek, $key) {
            //echo $itemek;
            $itemek->cislor = \App\Rizika::where('idproj', $itemek->idproj)->where('cislor',$itemek->cislor)->get()->first()->nazev_rizika;
           // return $item;
        });

             $case1_1=0;
             $case1_2=0;
             $case1_3=0;
             $case1_4=0;
             $case1_5=0;
             $case2_1=0;
             $case2_2=0;
             $case2_3=0;
             $case2_4=0;
             $case2_5=0;
             $case3_1=0;
             $case3_2=0;
             $case3_3=0;
             $case3_4=0;
             $case3_5=0;
             $case4_1=0;
             $case4_2=0;
             $case4_3=0;
             $case4_4=0;
             $case4_5=0;
             $case5_1=0;
             $case5_2=0;
             $case5_3=0;
             $case5_4=0;
             $case5_5=0;
        $rizika_projektu = \App\Rizika::where('idproj', $id)->select('cislor')->get()->all();
        $pocet_rizik = count($rizika_projektu);
         for ($i=0; $i < $pocet_rizik; $i++) {
           // return ((\App\PolozkySablony::where('idproj',$id)->pluck('atribut')->contains('Dopad')) ? 'true' : 'false')
            if(\App\PolozkySablony::where('idproj',$id)->pluck('atribut')->contains('Dopad'))
            {
                $dopad = \App\PolozkyRiziko::where('idproj', $id)->where('cislor',$rizika_projektu[$i]['cislor'])->where('atribut',"Dopad")->get()->first()->hodnota;
                //return $dopad;
            }
            //return (\App\PolozkySablony::where('idproj',$id)->pluck('atribut')->contains('Dopad')) ? 'true' : 'false';
            //return (\App\PolozkySablony::where('idproj','7')->get()->contains('Dopad')) ? 'true' : 'false';
             
             //
             //echo " x ";
            if(\App\PolozkySablony::where('idproj',$id)->pluck('atribut')->contains('Pravděpodobnost'))
            {
             $pst = \App\PolozkyRiziko::where('idproj', $id)->where('cislor',$rizika_projektu[$i]['cislor'])->where('atribut',"Pravděpodobnost")->get()->first()->hodnota;
            }
            // echo $pst;

             //echo "=";
             //echo $dopad*$pst;
             //echo "<br>";

             switch ($dopad) {
                case 1:
                    switch ($pst) {
                        case 1:
                            $case1_1++;
                            break;
                        case 2:
                            $case1_2++;
                            break;
                        case 3:
                            $case1_3++;
                            break;
                        case 4:
                            $case1_4++;
                            break;
                        case 5:
                            $case1_5++;
                            break;
                        default:
                            echo "neco spatne asi";
                            }
                    break;
                case 2:
                    switch ($pst) {
                        case 1:
                            $case2_1++;
                            break;
                        case 2:
                            $case2_2++;
                            break;
                        case 3:
                            $case2_3++;
                            break;
                        case 4:
                            $case2_4++;
                            break;
                        case 5:
                            $case2_5++;
                            break;
                        default:
                            echo "neco spatne asi";
                            }
                    break;
                case 3:
                    switch ($pst) {
                        case 1:
                            $case3_1++;
                            break;
                        case 2:
                            $case3_2++;
                            break;
                        case 3:
                            $case3_3++;
                            break;
                        case 4:
                            $case3_4++;
                            break;
                        case 5:
                            $case3_5++;
                            break;
                        default:
                            echo "neco spatne asi";
                            }
                    break;
                case 4:
                    switch ($pst) {
                        case 1:
                            $case4_1++;
                            break;
                        case 2:
                            $case4_2++;
                            break;
                        case 3:
                            $case4_3++;
                            break;
                        case 4:
                            $case4_4++;
                            break;
                        case 5:
                            $case4_5++;
                            break;
                        default:
                            echo "neco spatne asi";
                            }
                    break;
                case 5:
                    switch ($pst) {
                        case 1:
                            $case5_1++;
                            break;
                        case 2:
                            $case5_2++;
                            break;
                        case 3:
                            $case5_3++;
                            break;
                        case 4:
                            $case5_4++;
                            break;
                        case 5:
                            $case5_5++;
                            break;
                        default:
                            echo "neco spatne asi";
                            }
                    break;
                default:
        echo "neco spatne asi";
            }
         }
            // echo $case1_1;
            // echo $case1_2;
            // echo $case1_3;
            // echo $case1_4;
            // echo $case1_5;
            // echo $case2_1;
            // echo $case2_2;
            // echo $case2_3;
            // echo $case2_4;
            // echo $case2_5;
            // echo $case3_1;
            // echo $case3_2;
            // echo $case3_3;
            // echo $case3_4;
            // echo $case3_5;
            // echo $case4_1;
            // echo $case4_2;
            // echo $case4_3;
            // echo $case4_4;
            // echo $case4_5;
            // echo $case5_1;
            // echo $case5_2;
            // echo $case5_3;
            // echo $case5_4;
            // echo $case5_5;
        
        return view ('rejstrik', compact('res', 'hodnotyres', 'riskse', 'nazev_proj','case1_1',
             'case1_2',
             'case1_3',
             'case1_4',
             'case1_5',
             'case2_1',
             'case2_2',
             'case2_3',
             'case2_4',
             'case2_5',
             'case3_1',
             'case3_2',
             'case3_3',
             'case3_4',
             'case3_5',
             'case4_1',
             'case4_2',
             'case4_3',
             'case4_4',
             'case4_5',
             'case5_1',
             'case5_2',
             'case5_3',
             'case5_4',
             'case5_5' , 'detaily_projektu','tym','man_name'));
    }

    public function blink($case)
    {
        return redirect()->back() ->with('alert', $case);
    }
    public function edit()
    {

        $nazev_projektu = \App\Project::all();
        $multiplied = $nazev_projektu->map(function ($item, $key) {
            return [$item->nazev, $item->idproj];
        });
        $vysled = $multiplied->all();
        return view ('projekt.rejstrikedit', compact('vysled'));
    }

    public function show_rejstrik($id)
    {
      return $id;
    }



    
}
