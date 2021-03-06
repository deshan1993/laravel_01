<?php

namespace App\Http\Controllers;
use App\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Validation\Rule;
use Validator;

class AuthorController extends Controller
{
    //insert author
    public function insertAuthor(Request $request){
      $validator = Validator::make($request->all(), [
        'name' => 'required'
      ]);

      if($validator->fails()){
        return response()->json(['error'=>$validator->errors()], 401);
      }
      else{
        $table = new Author();
        $table->name = $request->input('name');
        $table->save();
        if($table->save()){
          return response()->json("Inserted successfully");
        }
        else{
          return response()->json("Error occured");
        }
      }
    }

    //view author
    public function viewAuthor(){
      $table = new Author();
      $data = DB::table('authors')->pluck('name');
      return response()->json($data);
    }

    //update author details
    public function updateAuthor(Request $request){
      $validator = Validator::make($request->all(), [
        'id' => 'required',
        'name' => 'required'
      ]);
      if($validator->fails()){
        return response()->json(['error'=>$validator->errors()], 401);
      }
      else{
        $id = $request->input('id');
        $update = ['name' => $request->input('name')];
        $data = DB::table('authors')->whereIn('id', [$id])->update($update);
        if($data){
          return response()->json("Successfully updated");
        }
        else{
          return reponse()->json("There is an error");
        }
      }
    }

    //delete authors
    public function deleteAuthor(Request $request){
      $validator = Validator::make($request->all(), [
        'id' => 'required'
      ]);
      if($validator->fails()){
        return response()->json(['error'=>$request->errors()], 401);
      }
      else{
        $id = $request->input('id');
        $data = DB::table('authors')->whereIn('id', [$id])->delete();

        if($data){
          return response()->json("Successfully deleted");
        }
        else{
          return response()->json("There is an error");
        }
      }
    }
}
