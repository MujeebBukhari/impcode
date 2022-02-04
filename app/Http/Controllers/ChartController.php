<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Chart;

class ChartController extends Controller
{
    public function index()
    {
        $userData = User::select(\DB::raw("COUNT(*) as count"))
        ->whereYear('created_at', date('Y'))
        ->groupBy(\DB::raw("Month(created_at)"))
        ->pluck('count');
        return view('charts', compact('userData'));
    }
    public function echart()
    {
        $fruit = Chart::where('product_type','fruit')->get();
    	$veg = Chart::where('product_type','vegitable')->get();
    	$grains = Chart::where('product_type','grains')->get();
    	$fruit_count = count($fruit);    	
    	$veg_count = count($veg);
    	$grains_count = count($grains);
    	return view('echart',compact('fruit_count','veg_count','grains_count'));   
    }
}
