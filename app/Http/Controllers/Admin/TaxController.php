<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\tax as Project;
use Yajra\DataTables\Facades\DataTables;


class TaxController extends Controller
{
  
  
  
  public function index()
    {
        $projects = Project::query();
        return DataTables::of($projects)
        ->addColumn('action', function ($project) {
                 
            $showBtn =  '<button ' .
                            ' class="btn btn-outline-info" ' .
                            ' onclick="showProject(' . $project->id . ')">Show' .
                        '</button> ';
 
            $editBtn =  '<button ' .
                            ' class="btn btn-outline-success" ' .
                            ' onclick="editProject(' . $project->id . ')">Edit' .
                        '</button> ';
 
            $deleteBtn =  '<button ' .
                            ' class="btn btn-outline-danger" ' .
                            ' onclick="destroyProject(' . $project->id . ')">Delete' .
                        '</button> ';
 
            return $showBtn . $editBtn . $deleteBtn;
        })
        ->rawColumns(
        [
            'action',
        ])
        ->make(true);
    }
}