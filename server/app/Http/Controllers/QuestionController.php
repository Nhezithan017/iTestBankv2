<?php

namespace App\Http\Controllers;

use App\Question;
use App\Department as Department;
use Illuminate\Http\Request;
use App\Http\Requests\QuestionPost;
class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Department $department)
    {
       
        
       $questions = $department->questions;

        return response()->json(compact('questions'));
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
    public function insert(QuestionPost $request, Department $department)
    {
        $request->validated();
        
        
        if($department){
            $department->questions()->create($request->json()->all());
           
        } 
        return response()->json(['msg' => 'Question created successfully','status' => 201]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        if($question){
            return response()->json(compact('question'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(QuestionPost $request, Question $question)
    {
        $request->validated();
        
        
        if($question){
            $question->update($request->json()->all());
           
        } 
        return response()->json(['msg' => 'Question updated successfully','status' => 200]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        if($question){
            $question->delete();
        }
        return response()->json(['msg' => 'Question deleted successfully','status' => 200]);
    }
}
