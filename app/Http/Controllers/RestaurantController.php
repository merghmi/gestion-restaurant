<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Restaurant;
use Illuminate\validation\Rule;
class RestaurantController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $restaurants=Restaurant::paginate(7);
        return view('/layouts/adminview/listeRestaurants')->with('restaurant',$restaurants);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('/layouts/adminview/addrestaurant');
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
      $validat=  validator::make($request->all(), [
            'label' => ['required', 'string', 'max:255'],
            'adress'=>['required', 'string', 'max:300'],
            'latitude' => ['required', 'string', 'min:8','max:255','unique:restaurants'],
            'longitude' => ['required', 'string', 'max:255','unique:restaurants'],
            'file' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            
         ]);
        if($validat->fails()) 
             return response()->json(array('errors' =>$validat->getMessageBag()->toarray() ));
         else{
             $restaurant=new Restaurant();
             $restaurant->label=$request->label;
                     $restaurant->adress=$request->adress;
                     $restaurant->latitude=$request->latitude;
                     $restaurant->longitude=$request->longitude;
                      if($request->hasFile('file')) {
                      $image = $request->file('file');
                     $fileName = $image->getClientOriginalName();
                    $restaurant->image=$fileName;
                   $image->move(public_path('images'),$fileName);
            }
             $restaurant->save();
             //return redirect('/admin/restaurants');
             return response()->json($restaurant);
              
            
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
     * Update the specified resource in storage
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {    $id=$request->id;
         $restaurant=Restaurant::find($id);
        $validat= validator::make($request->all(), [
            'label' => ['required', 'string', 'max:255'],
            'adress'=>['required', 'string', 'max:300'],
            'latitude' => ['required', 'string', 'min:8','max:255',Rule::unique('restaurants')->ignore($id)],
            'longitude' => ['required', 'string', 'max:255',Rule::unique('restaurants')->ignore($id)],
            'file' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
            
         ]);
        if($validat->fails())
            return response()->json(array('errors' =>$validat->getMessageBag()->toarray()));

        else {
        # code...
    
                     $restaurant->id=$id;
                     $restaurant->label=$request->label;
                     $restaurant->adress=$request->adress;
                     $restaurant->latitude=$request->latitude;
                     $restaurant->longitude=$request->longitude;
                      if($request->hasFile('file')) {
                      $image = $request->file('file');
                     $fileName = $image->getClientOriginalName();
                    $restaurant->image=$fileName;
                   $image->move(public_path('images'),$fileName);
            }
                     $restaurant->save();
                     //return redirect('admin/restaurants');
                     return response()->json($restaurant);

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
       $restaurant=Restaurant::find($request->id)->delete();
        return response()->json();
    }
  
}
 