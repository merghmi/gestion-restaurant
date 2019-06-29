<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Restaurant;
use App\Categorie;
use Illuminate\validation\Rule;
use App\Food;
use Illuminate\Support\Facades\Validator;
class Food_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
       $listRestaurant=Restaurant::all();
       $listfood=Food::all();
       return view('./layouts/adminview/food',compact('listRestaurant', 'listfood'));
    }
   
    
     public function get_categorie(Request $request){
      //  return response()->json($request->all());
        $categorie_list=Categorie::where('name_restaurant',$request->name_restaurant)->get();
         return response()->json(($categorie_list));
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
    {
         $validat=  validator::make($request->all(), [
             'name' => ['required', 'string', 'max:255'],
             'price'=>['required','regex:/^\d*(\.\d{2})?$/'],
             'name_restaurant' =>['required','string'],
             'name_categorie'=>['required','string'],
          
            
         ]);
        if($validat->fails()) 
             return response()->json(array('errors' =>$validat->getMessageBag()->toarray() ));
         else{
            $food=new Food();
            $food->name=$request->name;
            $food->price=$request->price;
            $food->name_restaurant=$request->name_restaurant;
            $food->name_categorie=$request->name_categorie;
            $food->image=$request->image;
            $food->save();
            return response()->json($food);
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
    public function destroy($id)
    {
        //
    }
}
