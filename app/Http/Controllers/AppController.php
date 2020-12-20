<?php

namespace App\Http\Controllers;

use App\app;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Validator;
use App\User;

class AppController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        $id = 123;
        $name = $req->session()->get('username');
        return view('home.home',compact('id', 'name'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function userlist(){
        $users  = App::all();
        return view('home.userlist')->with('users', $users);
    }
    public function create()
    {
        return view('home.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
                $user = new app();
                $user->username     = $request->username;
                $user->password     = $request->password;
                $user->name         = $request->name;
                $user->type         = $request->type;
                if($user->save()){
                    return redirect()->route('home.userlist');
                }else{
                    return back();
                }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\app  $app
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\app  $app
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = app::find($id);       
        return view('home.edit', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\app  $app
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $req)
    {
        $user = app::find($id); 
        $user->username     = $req->username;
        $user->password     = $req->password;
        $user->name         = $req->name;
        $user->type         = $req->type;
        $user->save();

        return redirect()->route('home.userlist');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\app  $app
     * @return \Illuminate\Http\Response
     */
    public function delete($id){
        
        return view('home.delete');
    }
    public function destroy($id)
    {

        $user = DB::table('user')->where('id',$id)->delete();

        return view('home.userlist');
       
    }
    public function index2()
    {
     return view('home.users');
    }
    public function search(Request $request)
    {
      
       if($request->ajax()){
    
         $output="";
         $products = app::where('username','LIKE','%'.$request->search."%")->get();
         
         if($products){
      
            foreach ($products as  $product) {
            
             $output.='<tr>'.
             
             '<td>'.$product->id.'</td>'.
             
             '<td>'.$product->username.'</td>'.
             
             '<td>'.$product->password.'</td>'.
             
             '<td>'.$product->name.'</td>'.
             
             '</tr>';
         
            }
            return $output;  
 
         }
   
       }
 
    }

}
