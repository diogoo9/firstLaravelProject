<?php

namespace App\Http\Controllers;

use App\User;
use App\UsersSkill;
use Illuminate\Http\Request;
use Validator;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /*
             $messages = [
            'name.required'=>'nome obrigatório'
        ];

        $rules = [
            'name'=>'required',
            'email'=>'required',
            'cpf'=>'required',
            'phone'=>'required',
        ];

        $validatedData = Validator::make($request->all(),$rules)->validate();

        if($validatedData->fails()){
            return redirect('users/create')
            ->withErrors($validatedData)
            ->withInput();
        }
        */
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {           
        $validateData = $request->validate([
            'name'=>'required'
        ],['name.required'=>'campo nome obrigatório']);
        dd($validateData->errors());
        if($validateData->errors()){

            return response()->json($validateData->errors());
        }
        //$userClass = new User();
        //$userClass->name = $request->input('name');
        //$userClass->email = $request->input('email');
        //$userClass->cpf = $request->input('cpf');
        ///$userClass->phone = $request->input('phone');
        //$userClass->status = $request->input('status');
        $userClass->save($request->all());
        //return response()->json($errors->all());
        $skills = $request->input('skills');
        foreach($skills as $skill){
            $usersSkillClass = new UsersSkill();
            $usersSkillClass->user_id = $userClass->id;  
            $usersSkillClass->skill_id = $skill; 
            $usersSkillClass->save();
        }            
        return response()->json($userClass);
        
    }    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id = 1)
    {
        $userClass = User::find($id);
        //$userClass->update()->where('id')
        return response()->json($userClass);
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
    public function update(Request $request, $id)
    {
        $userClass = User::find($id);
        //$userClass->email = $request->input('email');
        //$userClass->phone = $request->input('phone');
        //$userClass->status = $request->input('status');
        $userClass->update($request->all());
        return response()->json($userClass);

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
