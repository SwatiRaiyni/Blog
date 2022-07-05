<?php

namespace App\Http\Controllers;
use App\Models\Comment;
use Illuminate\Http\Request;
use Validator;

class BlogCommentsController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function insert(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name'=>'required',
            'text'=>'required',

        ]);


        if($validator->passes()){
        $data = new Comment;
        $data->name =  $request->name;
        $data->comment = $request->text;
        $data->post_id = $request->id;
        $data->save();
        $request->session()->flash('status','comment is inserted');
        return json_encode('yes');
        }else{
            return response()->json(['error'=>$validator->errors()->all()]);
           // $request->session()->flash('status1','All fields are required');
           // return json_encode("no");
        }
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
    public function delete($id)
    {
        $data = Comment::find($id); //dd($id);
        $data->delete();
        return redirect()->back()->with('status1', 'comment  is deleted');
    }
}
