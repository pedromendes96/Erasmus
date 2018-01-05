<?php

namespace App\Http\Controllers;

use App\Information;
use Illuminate\Http\Request;

class InformationsController extends Controller
{
    public function News(Request $request){
        $news = Information::orderBy('created_at','desc')->get();
        $rows = $news->count();
        $selectedNews = null;
        $number  = 0;
        if($rows >= 6){
            $selectedNews = $news->take(6);
            $number = 6;
        }elseif($rows >= 4){
            $selectedNews = $news->take(4);
            $number = 4;
        }else{
            $selectedNews = $news->take(2);
            $number = 2;
        }
        return view('index',compact('selectedNews','number'));
    }

    public function SelectedNew(Request $request){
        $info = Information::find($request->info);
        return view('news', compact('info'));
    }
    //
}
