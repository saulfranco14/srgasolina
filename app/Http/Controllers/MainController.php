<?php
namespace App\Http\Controllers;
use DB;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class MainController extends Controller{

    public function cpState(){
        $cpState = DB::select("select distinct(d_estado) from cp");

        return view( 'welcome', [
            'cpState'				=> 	$cpState
        ] );
    
    }

    public function delegateState( Request $request, $cpState ){
        $delegaciones = DB::table('cp')
                    ->where('d_estado', '=', $cpState)
                    ->orderBy('d_asenta','asc')
                    ->get();
       
        return $delegaciones;
        
    }

    
}