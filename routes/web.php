<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Article;
use App\Articles\ArticlesRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('articles.index', [
        'articles' => Article::all()
    ]);
});

Route::get(/**
 * @param ArticlesRepository $repository
 * @param Request $request
 */
    '/search', function (ArticlesRepository $repository, Request $request) {
  $articles = $repository->search((string) $request->get('q'));
  return view('articles.index', compact('articles'));
});
