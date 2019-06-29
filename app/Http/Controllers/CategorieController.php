<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Restaurant;
use App\Categorie;
use Illuminate\validation\Rule;
class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $listRestaurant=Restaurant::all();
        $listCateg=Categorie::all();
        return view('./layouts/adminview/categorie',compact('listRestaurant', 'listCateg'));
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
    public function store(Request $request)
    { //return response()->json($request);
        $validat=  validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255',Rule::unique('categories')->where('name',$request['name'])->where('name_restaurant',$request['name_restaurant'])],
             'name_restaurant' =>['required','string'],
              'file' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
          
            
         ]);
        if($validat->fails()) 
             return response()->json(array('errors' =>$validat->getMessageBag()->toarray() ));
        else{

            $categ=new Categorie();
            $categ->name=$request['name'];
            $categ->name_restaurant=$request['name_restaurant'];
            if($request->hasFile('file')) {
                $image = $request->file('file');
                $fileName = $image->getClientOriginalName();
                $categ->image_categ=$fileName;
                $image->move(public_path('images'),$fileName);
            }
            $categ->save();
            
    
          
            return response()->json($categ);
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
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {   
        $validat=  validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255',Rule::unique('categories')->ignore($request['id'])->where('name',$request['name'])->where('name_restaurant',$request['name_restaurant'])],
             'name_restaurant' =>['required','string'],
          
            
         ]);
        if($validat->fails()) 
             return response()->json(array('errors' =>$validat->getMessageBag()->toarray() ));
        else{
           $categ=Categorie::find($request['id']);
             $categ->name=$request['name'];
            $categ->name_restaurant=$request['name_restaurant'];
            if($request->hasFile('file')) {
                $image = $request->file('file');
                $fileName = $image->getClientOriginalName();
                $categ->image_categ=$fileName;
                $image->move(public_path('images'),$fileName);
            }
            $categ->save();
            return response()->json($categ);
    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
      $categ=Categorie::find($request->id)->delete();
       return response()->json();
    }
}
