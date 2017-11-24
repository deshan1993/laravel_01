<?php

namespace App\Http\Controllers;
use App\User as User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Validation\Rule;
use Validator;

class UserController extends Controller
{
    //function for register new user
    public function registerUser(Request $request){

      $validator = validator::make($request->all(), [
        'name'=> 'required',
        'email'=> 'required|email',
        'password' => 'required'
      ]);

      if($validator->fails()){
        return response()->json(['error'=>$validator->errors()], 401);
      }
      else{
        $table = new User();

        $table->name = $request->input('name');
        $table->email = $request->input('email');
        $table->password = $request->input('password');

        $table->save();

        if($table->save()){
          return response()->json("Data inserted successfully");
        }
        else{
          return response()->json("Data were not inserted");
        }
      }


    }

    //get all availabe users' details
    public function getUserDetails(){

      $data = DB::table('Users')->where('delete_col', [0])->pluck('name');
      return response()->json($data);

    }

    //update users details
    public function updateDetails(Request $request){

      $validator = Validator::make($request->all(), [
        'id' => 'required',
        'name' => 'required',
        'email' => 'required|email',
        'password' => 'required'
      ]);

      if($validator->fails()){
        return response()->json(['error'=>$validator->errors()], 401);
      }

      else{
        $id = $request->input('id');
        $name = $request->input('name');
        $email = $request->input('email');
        $p = $request->input('password');

        $update = [
              'name'     => $request->input('name'),
              'email'   => $request->input('email'),
              'password'     => $request->input('password')
          ];

        $data = DB::table('Users')->whereIn('id', [$id])->update($update);

        if(count($data)>0){
          return response()->json("Successfully updated");
        }
        else{
          return response()->json("Error occur");
        }
      }
    }

    //get specific user's details from table
    public function getSpecificData(Request $request){

      $validator = Validator::make($request->all(), [
        'name' => 'required'
      ]);

      if($validator->fails()){
        return reponse()->json(['error'=>$validator->errors()], 401);
      }

      else{
        $name = $request->input('name');
        $data = DB::select('SELECT name,email,password FROM Users WHERE name=:name AND delete_col=:del', ['name'=>$name, 'del'=>0]);
        if(count($data)){
          return response()->json($data);
        }
        else{
          return response()->json("No data");
        }
      }
    }

    //function for delete users
    public function deleteData(Request $request){
      $validator = Validator::make($request->all(), [
        'name' => 'required'
      ]);

      if($validator->fails()){
        return response()->json(['error'=>$validator->errors()], 401);
      }
      else{
        $update = ['delete_col'=>1];
        $name = $request->input('name');
        $data = DB::table('Users')->whereIn('name', [$name])->update($update);

        if(count($data)){
          return response()->json("Successfully deleted");
        }
        else{
          return response()->json("Error occur");
        }
      }
    }

    //function for enable disable users
    public function enableUsers(Request $request){
      $validator = Validator::make($request->all(), [
        'name' => 'required',
        'status' => 'required|boolean'
      ]);

      if($validator->fails()){
        return response()->json(['error'=>$validator->errors()], 401);
      }
      else{
        $name = $request->input('name');
        $status = $request->input('status');

        $update = ['status' => $status];
        $data = DB::table('Users')->whereIn('name', [$name])->update($update);

        if(count($data)){
          if($status==1){
            return response()->json("Successfully enabled");
          }
          else{
            return response()->json("Successfully disabled");
          }
        }
        else{
          return response()->json("Error occured");
        }
      }
    }
}
