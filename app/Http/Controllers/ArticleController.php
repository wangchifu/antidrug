<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::all();
        $data = [
            'articles'=>$articles,
        ];

        return view('articles.index',$data);
    }

    public function create()
    {
        return view('articles.create');
    }

    public function store(Request $request)
    {
        $att = $request->all();
        Article::create($att);
        return redirect()->route('articles.index');
    }

    public function edit(Request $request,Article $article)
    {
        $data = [
            'article'=>$article,
        ];

        return view('articles.edit',$data);
    }

    public function show(Article $article)
    {
        $data = [
            'article'=>$article,
        ];

        return view('articles.show',$data);
    }

    public function update(Request $request,Article $article)
    {
        $att = $request->all();
        $article->update($att);
        return redirect()->route('articles.index');
    }

    public function destroy(Article $article)
    {
        $article->delete();
        return redirect()->route('articles.index');
    }
}
