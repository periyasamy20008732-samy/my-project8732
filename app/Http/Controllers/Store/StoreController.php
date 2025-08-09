<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Store;
use Yajra\DataTables\Facades\DataTables;
use App\Models\CountrySettings;
use Illuminate\Support\Facades\Validator;
//use Illuminate\Support\Facades\Storage;


class StoreController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Store::latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function ($row) {
                    return $row->status == 1
                        ? '<span class="badge badge-linesuccess">Active</span>'
                        : '<span class="badge badge-linedanger">Inactive</span>';
                })
                ->addColumn('action', function ($row) {
                    return '
        <div class="action-table-data">
            <div class="edit-delete-action d-flex">
                <a class="me-2 p-2 view-btn" data-id="' . $row->id . '">
                    <i data-feather="eye" class="text-secondary" style="width: 18px; height: 18px;"></i>
                </a>
                <a class="me-2 p-2 edit-btn" data-id="' . $row->id . '">
                    <i data-feather="edit" class="text-info" style="width: 18px; height: 18px;"></i>
                </a>
                <form id="delete-form-' . $row->id . '" action="' . route('store.store.destroy', $row->id) . '" method="POST" style="display:inline;">
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
        $countries = CountrySettings::all();
        return view('store.store', compact('countries'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'store_name' => 'required|string|max:255',
            'store_website' => 'required|string|max:255',
            'gst_no' => 'required|string|max:255',
            'website' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'mobile' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'postcode' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'store_logo' => 'sometimes|file|image|nullable',
            'signature' => 'sometimes|file|image|nullable',
            //'status' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $data = $request->all();
        $data['status'] = $request->input('status', 1);
        $data['user_id'] = auth()->user()->user_level;

        // Handle logo upload
        if ($request->hasFile('store_logo')) {
            $file = $request->file('store_logo');
            $directory = 'storage/store/';
            $imageName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path($directory), $imageName);
            $data['store_logo'] = $directory . $imageName;
        }

        // Handle signature upload
        if ($request->hasFile('signature')) {
            $file = $request->file('signature');
            $directory = 'storage/store/';
            $imageName = time() . '_sign.' . $file->getClientOriginalExtension();
            $file->move(public_path($directory), $imageName);
            $data['signature'] = $directory . $imageName;
        }

        $store = Store::create($data);

        return redirect()->route('store.store.index')->with('success', 'Store created successfully.');
    }


    public function show($id)
    {
        $unit = Store::findOrFail($id);
        return response()->json($unit);
    }
    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'store_name'     => 'required|string|max:255',
            'store_website'  => 'required|string|max:255',
            'gst_no'         => 'required|string|max:255',
            'website'        => 'required|string|max:255',
            'country'        => 'required|string|max:255',
            'mobile'         => 'required|string|max:255',
            'email'          => 'required|string|max:255',
            'city'           => 'required|string|max:255',
            'state'          => 'required|string|max:255',
            'postcode'       => 'required|string|max:255',
            'address'        => 'required|string|max:255',
            'store_logo'     => 'sometimes|nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'signature'      => 'sometimes|nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        $store = Store::findOrFail($id);

        $data = $request->all();
        $data['status'] = $request->input('status', 1);

        $directory = 'storage/store/';

        //update logo 
        if ($request->hasFile('store_logo')) {
            $file = $request->file('store_logo');
            $imageName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path($directory), $imageName);
            $data['store_logo'] = $directory . $imageName;
        }

        //update sign
        if ($request->hasFile('signature')) {
            $file = $request->file('signature');
            $imageName = time() . '_sign.' . $file->getClientOriginalExtension();
            $file->move(public_path($directory), $imageName);
            $data['signature'] = $directory . $imageName;
        }

        $store->update($data);

        return redirect()->route('store.store.index')->with('success', 'Store updated successfully.');
    }



    public function destroy($id)
    {
        Store::findOrFail($id)->delete();
        return redirect()->route('store.store.index')->with('success', 'Store deleted successfully.');
    }
}
