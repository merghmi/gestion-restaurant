<?php

namespace App\Http\Controllers\Auth;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\validation\Rule;
use Illuminate\Http\Response;
use Illuminate\Http\Request;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    //protected $redirectTo ='';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
   protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'min:8','max:12','unique:users'],
            'adress' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'image'=>['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {  
   
            
     

        return User::create([
            'name' => $data['name'],
            'phone' => $data['phone'],
            'adress' => $data['adress'],
            'email' => $data['email'],
            'image' => $data['image'],
            'password' => Hash::make($data['password']),
        ]);
            
    }

protected function registerAdmin(Request $request){
   $validator= validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'min:8','max:12','unique:users'],
            'adress' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
             'file' =>  'image|mimes:jpeg,png,jpg,gif|max:2048',
            'password' => ['required', 'string', 'min:6', 'confirmed'],

        ]);

   if($validator->fails())
   {
        return response()->json(array('errors' =>$validator->getMessageBag()->toarray() ));
    
   }

    else
       {
         
         $admin= new User();
         $admin->name=$request['name'];
         $admin->phone=$request['phone'];
         $admin->adress=$request['adress'];
         $admin->email=$request['email'];
         if($request->hasFile('file')) {
                $image = $request->file('file');
                $fileName = $image->getClientOriginalName();
                $admin->image=$fileName;
                $image->move(public_path('images'),$fileName);
            }
            $admin->password=$request['password'];
            $admin->permission=$request['permission'];

            $admin->save();
          
      return response()->json($admin);
    }
}
protected function index(){
  $admins=User::where('permission','!=','')->paginate(5);
  return view('layouts.adminview.users')->with('admins',$admins);

 }

 protected function edit($id){
 

 }
 protected function update(Request  $request){
     $id=$request['id'];
     $user=User::find($id);
     $validator=validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'min:8','max:12',Rule::unique('users')->ignore($id)],
            'adress' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255',Rule::unique('users')->ignore($id)
         ],
            'file' =>  'image|mimes:jpeg,png,jpg,gif|max:2048',
            
]);
      if($validator->fails())
     {
        return response()->json(array('errors' =>$validator->getMessageBag()->toarray() ));
    
     }

     else
    {    $user->id=$id;
         $user->name=$request['name'];
         $user->phone=$request['phone'];
         $user->adress=$request['adress'];
         $user->email=$request['email'];
         if($request->hasFile('file')) {
                $image = $request->file('file');
                $fileName = $image->getClientOriginalName();
                $user->image=$fileName;
                $image->move(public_path('images'),$fileName);
            }
         $user->permission=$request['permission'];
         $user->save();
    
      return response()->json($user);
     }
}
 protected function delete(Request $request){
  $admin=User::find($request->id)->delete();
  return response()->json();
  //return redirect('/admin/users')->with('sucsess','removed');
 }
}
