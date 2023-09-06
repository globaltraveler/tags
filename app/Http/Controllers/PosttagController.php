<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Posttag;
use DB;

class PosttagController extends Controller
{
    public function index()
    {
    	$posts = Posttag::all();
        return view('index', compact('posts'));
    }
    public function store(Request $request)
    {
    	$this->validate($request, [
            'title_name' => 'required',
            'content' => 'required',
            'tags' => 'required',
        ]);
    	$input = $request->all();
    	$tags = explode(",", $request->tags);
    	$post = Posttag::create($input);
    	$post->tag($tags);
        return back()->with('success','Post added to database.');
    }
}