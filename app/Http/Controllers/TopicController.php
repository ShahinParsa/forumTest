<?php

namespace App\Http\Controllers;

use App\Topic;
use App\User;
use Illuminate\Http\Request;
use App\cat;
use App\sub_cat;

class TopicController extends Controller
{
    function __construct(){
        return $this->middleware('auth')->except('index','show');
    }

    public function index()
    {
        // show last 10 topics
        $topics= Topic::orderBy('created_at', 'desc')->paginate(10);
        return view('topic.index')
            ->with(compact('topics'));
    }

    public function showByCategory($category){
        $topics= Topic::all()->where('sub_cat_id','' ,$category);
        return view('topic.index')
            ->with(compact('topics'));
    }


    public function create()
    {
        //
        $cats = cat::all();
        $subCats = sub_cat::all();

        $data = array('cats' =>  $cats,
            'subCats' => $subCats);
        return view('topic.create')->with($data);
    }


    public function store(Request $request)
    {
        //validate
        @$this->validate($request,[
            'title'=>'required|min:5',
            'sub_cat_id'=>'required',
            'topic_body'=>'required|min:50',
        ]);

        //auth user and store
        auth()->user()->topics()->create($request->all());

        //redirect
        return redirect()->route('topic.index')->withMessage('Topic is successfully created!');
    }


    public function show(Topic $topic)
    {
        //
        return view('topic.single', compact('topic'));
    }


    public function edit(Topic $topic)
    {
        //
        $cats = cat::all();
        $subCats = sub_cat::all();

        $data = array('cats' =>  $cats,
                        'subCats' => $subCats,
                        'topic' => $topic);
        return view('topic.edit')->with($data);
    }


    public function update(Request $request, Topic $topic)
    {

        /*if($user->id !== $topic->user_id){
            abort(401, 'Unauthorized');
        }*/

        if (!$this->authorize('update',$topic)){
                abort(401, 'Unauthorized');
        };

        //validate
        @$this->validate($request,[
            'title'=>'required|min:5',
            'sub_cat_id'=>'required',
            'topic_body'=>'required|min:50',
        ]);


        $topic->update($request->all());

        //redirect
        return redirect()->route('topic.show', $topic->id)->withMessage('Topic is updated!');
    }


    public function destroy(Topic $topic)
    {

        if (!$this->authorize('delete',$topic)){
            abort(401, 'Unauthorized');
        };
        //delete topic
        $topic->delete();

        return redirect()->route('topic.index')->withMessage('Topic is deleted!');

    }
}
