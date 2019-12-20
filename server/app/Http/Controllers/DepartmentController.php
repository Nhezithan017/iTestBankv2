<?php

namespace App\Http\Controllers;

use App\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\DepartmentPost;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
  
    public function __construct()
    {
      
    }
    public function index()
    {
        
        $user = $this->isAuth();
        $department = $user->department;

        return response()->json(compact('department'));
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
    public function insert(DepartmentPost $request)
    {
      
     
     $user = $this->isAuth();
     $request->validated();
    
     $deptID = $user->department()->create($request->json()->all())->id;
    
      return response()->json([
          'msg' => 'Added successfully',
           'status', 201
      ]);
    }
    public function update(DepartmentPost $request, $deptID)
    {
        
     $user = $this->isAuth();
     $request->validated();
    
    $user->department()->where('id', $deptID)->update($request->json()->all());    
      return response()->json([
          'msg' => 'Updated successfully',
           'status', 200
      ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
     
        return response()->json(["department" => $department]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
 
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        $department->delete();

        return response()->json(['msg' => 'Deleted Successfully', 'id' => $department->id]);
    }
}
