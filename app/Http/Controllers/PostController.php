<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
 
    public function all(Request $request)
    {   
      

        $posts = Post::where([
            ['created_at', '!=', null],
            [function($query) use ($request){
                if(($post = $request->post)){
                    $query->orWhere('post', 'LIKE', '%'. $post . '%')->get();
    
                    
                }
            }]
        ])
    
        ->orderBy("created_at","desc")
        ->paginate(6);
    
    
           return view('pages.home',compact('posts'),['posts'=>$posts])
           ->with('i',(request()->input('page',1)-1)*5);
        
    }

    public function byCategory(Category $category)
    {   
        $posts = Post::where('category_id', $category->id)->orderBy('created_at', 'desc')->paginate(6);
        return view('pages.category', compact('posts', 'category'));
    }

    public function byAuthor(User $author)
    {
        $posts = Post::where('user_id', $author->id)->orderBy('created_at', 'desc')->paginate(6);
        return view('pages.author', compact('posts', 'author'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all()->sortBy('category');
        return view('pages.users.create-post', compact('categories'));    
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
            'category_id'   =>  'required',
            'post'          =>  'required|string|max:255'
        ]);
        Post::create($request->all());
        // return back()->with('status', 'Post published successfully.');
        return redirect('posts')->with('status', 'Post published successfully.');
    }
}
