<?php

namespace App\Http\Controllers;
use App\Models\News;

use Carbon\Traits\Timestamp;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    //
    public function index(){
        
        $news = News::all();
        return view("welcome",compact("news"));
    }


}
