<?php

namespace App\Http\Controllers;

use App\Models\Hashtag;
use Illuminate\Http\Request;

class HashtageController extends Controller
{
    public function show($name){
        $hashtag=Hashtag::where('name',$name)->firstOrFail();
        $posts=$hashtag->posts()->latest()->paginate(10);
        
    }
}
