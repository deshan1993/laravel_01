<?php

namespace App\Http\Controllers;
use App\Keyword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Validation\Rule;
use Validator;

class KeywordController extends Controller
{
    //insert keywords
    public function insertKeyword(Request $request){
      $validator = Validator::make($request->all(), [
        'name' => 'required'
      ]);
      if($validator->fails()){
        return response()->json(['error'=>$validator->errors()], 401);
      }
      else{
        $table = new Keyword();
        $table->name = $request->input('name');
        $table->save();
        if($table->save()){
          return response()->json("Sucessfully added a keyword");
        }
        else{
          return response()->json("There is an error");
        }
      }
    }

    //view keywords
    public function viewKeyword(){
      $table = new Keyword();
      $data = DB::table('keywords')->pluck('name');
      return response()->json($data);
    }

    //update keywords
    public function updateKeyword(Request $request){
      $validator = Validator::make($request->all(), [
        'id' => 'required',
        'name' => 'required'
      ]);
      if($validator->fails()){
        return response()->json(['error'=>$validator->errors()], 401);
      }
      else{
        $update = ['name' => $request->input('name')];
        $data = DB::table('keywords')->whereIn('id', [$request->input('id')])->update($update);
        if($data){
          return response()->json("Updated successfully");
        }
        else{
          return response()->json("There is an error");
        }
      }
    }

    //delete keywords
    public function deleteKeyword(Request $request){
      $validator = Validator::make($request->all(), [
        'id' => 'required'
      ]);
      if($validator->fails()){
        return response()->json(['error'=>$validator->errors()], 401);
      }
      else{
        $data = DB::table('keywords')->where('id', [$request->input('id')])->delete();
        if($data){
          return response()->json("Successfully deleted");
        }
        else{
          return response()->json("There is an error");
        }
      }
    }
}
