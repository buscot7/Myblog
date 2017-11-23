<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use App\Models\User;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'article' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string|max:255',
        ]);
        $article = new article;
        $article->title = $request->description;
        $article->content = $request->article;
        $article->category_id = $request->category_id;
        $article->user_id = auth()->id();
        $article->save();
        return back()->with('ok', __("L'article a bien été enregistrée"));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        $title = $article->title;
        return view ('articles.edit', compact('article', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        $this->authorize('update', $article);

        $request->validate([
            'content' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'title' => 'reduired|string|max:255',
        ]);
        $article->update([
            'description' => $request->title,
            'categogy_id' => $request->category_id,
            'content' => $request->article,
            ]);
        return back()->with('ok', __("L'article a bien été modifié"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $article->delete();
        return back();
    }
    public function getArticlesForCategory($slug)
    {
        return Article::latestWithUser()->whereHas('category', function ($query) use ($slug) {
            $query->whereSlug($slug);
        })->paginate(config('app.pagination'));
    }
    public function category($slug)
    {
        $category = Category::whereSlug($slug)->firstorFail();
        $articles = $this->getArticlesForCategory($slug);
        return view('home', compact('category', 'articles'));
    }
    public function user(User $user)
    {
        $articles = $this->getImagesForUser($user->id);
        return view('home', compact('user', 'articles'));
    }
    public function getImagesForUser($id)
    {
        return Article::latestWithUser()->whereHas('user', function ($query) use ($id) {
            $query->whereId($id);
        })->paginate(config('app.pagination'));
    }
}
