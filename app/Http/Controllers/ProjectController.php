<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;
use DB;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $query = DB::raw('SELECT * FROM projects');
      $projects = Project::fromQuery($query);
      return view('project.index',['projects'=>$projects]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('project.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $validatedData = $request->validate([
        'project_no' => 'required|unique:projects|integer|digits_between:1,6|min:1',
        'project_data' => 'required|max:20',
      ]);

      DB::insert('INSERT INTO projects (project_no, project_data) VALUES (?, ?)',
        [$request->project_no, $request->project_data]);

      return redirect()->route('project.show',['id'=>$request->project_no])->with('message', 'Project created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $query = DB::raw('SELECT * FROM projects WHERE project_no = :project_no');
      $project = Project::fromQuery($query, ['project_no'=>$id])->first();

      $query = DB::raw('SELECT * FROM orders WHERE project_no = :project_no');
      $orders = Project::fromQuery($query, ['project_no'=>$id]);

      return view('project.show')
        ->with('project',$project)
        ->with('orders',$orders);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        //
    }
}
