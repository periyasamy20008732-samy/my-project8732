<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pages;
use Yajra\DataTables\Facades\DataTables;

class PagesController extends Controller
{
    //

    public function addpage()
    {
        return view('admin.add-page');
    }
    public function editpage($id)
    {
        $page = Pages::findOrFail($id);
        return view('admin.edit-page', compact('page'));
        //   return view('admin.edit-page');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Pages::latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('showappmenu', function ($row) {
                    return $row->showapp_menu == 1
                        ? 'Show'
                        : 'Hide';
                })
                ->addColumn('status', function ($row) {
                    return $row->status == 1
                        ? '<span class="badge badge-linesuccess">Active</span>'
                        : '<span class="badge badge-linedanger">Inactive</span>';
                })
                ->addColumn('action', function ($row) {
                    return '
        <div class="action-table-data">
            <div class="edit-delete-action d-flex">
               
                <a href="edit-page/' . $row->id . '" class="me-2 p-2 edit-btn">
                    <i data-feather="edit" class="text-info" style="width: 18px; height: 18px;"></i>
                </a>
                <form id="delete-form-' . $row->id . '" action="' . route('admin.pages.destroy', $row->id) . '" method="POST" style="display:inline;">
                    ' . csrf_field() . method_field('DELETE') . '
                    <a class="p-2 delete-btn" data-id="' . $row->id . '">
                        <i data-feather="trash-2" class="text-danger" style="width: 18px; height: 18px;"></i>
                    </a>
                </form>
            </div>
        </div>
    ';
                })

                ->rawColumns(['status', 'action'])
                ->make(true);
        }
        $pages = Pages::all();
        return view('admin.pages', compact('pages'));
    }


    public function store(Request $request)
    {
        // $validatedData = $request->validate([
        //     'title' => 'required|string|max:255',
        //     'details' => 'nullable|string',
        //     'option' => 'nullable|string',
        //     'showapp_menu' => 'nullable|integer',
        //     'status' => 'nullable|integer'
        // ]);
        $request->validate([
            'title' => 'required|string|max:255',
            'details' => 'nullable|string',
            'option' => 'nullable|string',
            'showapp_menu' => 'nullable|integer',
            'status' => 'nullable|integer'
        ]);
        Pages::create([
            'title' => $request->title,
            'details' => $request->details,
            'option' => $request->option,
            'showapp_menu' => $request->showapp_menu,
            'status' => $request->status
            // Slug is generated automatically in the model
        ]);
        return redirect()->route('admin.pages.index')->with('success', 'Page created successfully.');
    }

    public function show($id)
    {
        $pages = Pages::findOrFail($id);
        return response()->json($pages);
    }
    public function update(Request $request, $id)
    {
        //$package = Packages::findOrFail($id);
        $pages = Pages::findOrFail($id);

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'details' => 'nullable|string',
            'option' => 'nullable|string',
            'showapp_menu' => 'nullable|integer',
            'status' => 'nullable|integer',


        ]);

        $validatedData['showapp_menu'] = $request->has('showapp_menu') ? 1 : 0;
        $validatedData['status'] = $request->has('status') ? 1 : 0;

        // dd($validatedData);

        $pages->update($validatedData);


        return redirect()->route('admin.pages.index')->with('success', 'Page updated successfully.');
    }


    public function destroy($id)
    {
        Pages::findOrFail($id)->delete();
        return redirect()->route('admin.pages.index')->with('success', 'Page deleted successfully.');
    }


}