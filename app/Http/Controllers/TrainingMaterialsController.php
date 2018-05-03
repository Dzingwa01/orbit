<?php

namespace App\Http\Controllers;

use App\TrainingMaterial;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Shift;
use Yajra\Datatables\Datatables;
use DB;
use File;

class TrainingMaterialsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('materials.index');
    }

    public function getTrainingMaterials(){
        $materials = TrainingMaterial::where('creator_id',Auth::user()->id)->get();
        return DataTables::of($materials)
            ->addColumn('action', function ($material) {
                return '<a href="training_materials/' . $material->id . '" title="View Material" class=""><i class="glyphicon glyphicon-eye-open"></i></a><a href="training_materials/' . $material->id . '/edit" style="margin-left:1em" title="Edit Material" class=""><i class="glyphicon glyphicon-edit"></i></a><a href="delete_material/' . $material->id . '" style="margin-left:1em" class="" title="Delete Shift"><i class="glyphicon glyphicon-trash "></i></a>';
            })
            ->make(true);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('materials.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
//        dd($request->all());
        $input = $request->all();
//        dd($input);
        $dir = "files/";
        if (File::exists(public_path($dir)) == false) {
            File::makeDirectory(public_path($dir), 0777, true);
        }

        $path = $request->file('file_url')->store($dir);
        $input['file_url'] = $path;
        $input['creator_id'] = Auth::user()->id;
        DB::beginTransaction();
        try {
            $material = TrainingMaterial::create($input);
            DB::commit();

        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
        return redirect('training_materials');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $material = TrainingMaterial::where('id',$id)->first();
        return view('materials.show',compact('material'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $material = TrainingMaterial::where('id',$id)->first();
        return view('materials.edit',compact('material'));
    }

    public function apiGetMaterials(User $user){
        $materials = TrainingMaterial::where('creator_id',$user->id)->get();
        return response()->json(["materials" => $materials]);
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
        //
//        dd($id);
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
