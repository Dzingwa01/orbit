<?php

namespace App\Http\Controllers;

use App\OnBoardingMaterial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Shift;
use Yajra\Datatables\Datatables;
use DB;
use File;

class OnBoardingMaterialsController extends Controller
{
    public function index()
    {
        //
        return view('onboarding.index');
    }

    public function getTrainingMaterials(){
        $materials = OnBoardingMaterial::where('creator_id',Auth::user()->id)->get();
        return DataTables::of($materials)
            ->addColumn('action', function ($material) {
                return '<a href="training_materials/' . $material->id . '" title="View Material" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-eye-open"></i></a><a href="training_materials/' . $material->id . '/edit" style="margin-left:0.5em" title="Edit Material" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i></a><a href="delete_material/' . $material->id . '" style="margin-left:0.5em" class="btn btn-xs btn-danger" title="Delete Shift"><i class="glyphicon glyphicon-trash "></i></a>';
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
        return view('onboarding.create');
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
        DB::beginTransaction();
        try {
            $material = OnBoardingMaterial::create($input);
            DB::commit();

        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
        return redirect('onboarding_materials');

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
        $material = OnBoardingMaterial::where('id',$id)->first();
        return view('onboarding.show',compact('material'));
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
        $material = OnBoardingMaterial::where('id',$id)->first();
        return view('onboarding.edit',compact('material'));
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
