<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Posts;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */ 

    public function create(Request $request)
    {
  
        // Varidationを行う
        $this->validate($request, Posts::$rules);
  
        $posts = new Posts;
        $form = $request->all();
  
        // データベースに保存する
        $posts->fill($form);
        $posts->save();
  
        return redirect('home');
    }

    public function index(Request $request)
    {
        $user = new User;
        // 作成日の降順に並び替える
        $posts = Posts::orderBy('created_at', 'desc')->get();
        // ユーザー名を追加する
        foreach ($posts as $post) {
            $post->name = $user->where('id', $post->user_id)->get()->pluck('name')->first();
        }
        return view('home', ['posts' => $posts]);
    }

    public function destroy($id)
    {
        // Booksテーブルから指定のIDのレコード1件を取得
        $post = Posts::find($id);
        // レコードを削除
        $post->delete();
        // 削除したら一覧画面にリダイレクト
        return redirect('home');
        // return redirect()->route('book.index');
    }
}
