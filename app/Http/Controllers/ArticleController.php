<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\Http\Resources\Article as ArticleResource;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $articles = Article::latest()->paginate(15);

        return ArticleResource::collection($articles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return ArticleResource
     */
    public function store(Request $request)
    {
        // If method is PUT - find by id and save article, otherwise create new Article
        $article = $request->isMethod('put') ? Article::findOrFail($request->article_id) : new Article();

        $article->id = $request->input('article_id');
        $article->title = $request->input('title');
        $article->body = $request->input('body');

        if ($article->save())
            return new ArticleResource($article);

    }

    /**
     * Display the specified resource.
     * @param Article $article
     * @return ArticleResource
     */
    public function show(Article $article)
    {
        return new ArticleResource($article);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article $article
     * @return ArticleResource
     */
    public function destroy(Article $article)
    {
        if ($article->delete()) {
            return new ArticleResource($article);
        }
    }
}
