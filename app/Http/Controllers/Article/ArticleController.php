<?php

namespace App\Http\Controllers\Article;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Article;
use Illuminate\Support\Facades\Gate;

class ArticleController extends Controller
{

    /**
     * Class Constructor
     */
    public function __construct()
    {
        $this->middleware('auth')->except('index', 'detail');
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $data = [
        //     ['id' => 1, 'name' => 'Article One'],
        //     ['id' => 2, 'name' => 'Article Two']
        // ];

        $data = Article::latest()->paginate(5);

        // return $data;

        return view('articles.index', [
            'articles' => $data
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function detail($id)
    {
        $detail = Article::find($id);

        // return $detail;

        return view('articles.detail', [
            'article' => $detail,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function add()
    {
        $categories = [
            ['id' => 1, 'name' => 'News'],
            ['id' => 2, 'name' => 'Discovery']
        ];

        return view('articles.add', [
            'categories' => $categories,
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function create(Request $request)
    {
        $validator = Validator($request->all(), [
            'title' => 'required',
            'body' => 'required',
            'category_id' => 'required'
        ]);

        if($validator->fails())
        {
            return back()->withErrors($validator);
        }
        
        // $article = new Article($request->all());
        // $article->save();

        $article = new Article;
        $article->title = $request->title;
        $article->body = $request->body;
        $article->category_id = $request->category_id;
        $article->save();

        return redirect('/articles');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        if(Gate::denies('comment-delete', $article))
        {
            return back()->with('error', 'Unauthorize');
        }
        else
        {
            // Article::find($id)->delete();
            $article->delete();
            return redirect('/articles')->with('info', 'Article Delete');
        }   
    }
}
