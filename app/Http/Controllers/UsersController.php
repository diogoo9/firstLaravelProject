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
        $users =  User::orderBy('name')->get();
        foreach($users as $user){
            $user->skills = UsersSkill::select('skill_id','description')
            ->where('user_id',$user->id)->join('skills','users_skills.skill_id','skills.id')            
            ->get();
        }
        return $users;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
     
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {              
             
        $validateData =   
        $request->validate(          
        [
            'name'=>'required',
            'email'=>'required|unique:users',
            'cpf'=>'required|unique:users',
        ],
        [
            'name.required'=>'campo nome obrigatório',
            'email.required'=>'emails é obrigatório',
            'email.unique'=>'o e-mail ja cadaastrado',
            'cpf.unique'=>'CPF ja cadastrado',
            'cpf.required'=>'CPF não informado',
        ]
        
            );
 
        $userClass = new User();
        $userClass->name = $request->input('name');
        $userClass->email = $request->input('email');
        $userClass->cpf = $request->input('cpf');
        $userClass->phone = $request->input('phone');
        $userClass->status = false;
        $userClass->save();

        $skills = $request->input('skills');
        if($skills){
            foreach($skills as $skill){
                $usersSkillClass = new UsersSkill();
                $usersSkillClass->user_id = $userClass->id;  
                $usersSkillClass->skill_id = $skill["id"]; 
                $usersSkillClass->save();
            }
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
