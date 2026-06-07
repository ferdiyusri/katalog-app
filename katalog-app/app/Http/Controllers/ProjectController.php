<?php

namespace App\Http\Controllers;

use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with('category', 'images')->get();

        return view('projects.index', compact('projects'));
    }
    public function show($id)
    {
        $project = Project::with('category', 'images')->findOrFail($id);
        return view('projects.show', compact('project'));
    }
}