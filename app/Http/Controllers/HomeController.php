<?php

namespace App\Http\Controllers;

use App\Models\Article;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::latestWithUser()->paginate(config('app.pagination'));
        return view('home', compact('articles'));
    }
}
