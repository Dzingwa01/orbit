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
        $input = $request->all();
        $dir = "files/";
        $file = $input['file_url'];
        $ext  = $file->getClientOriginalExtension();
        $filename = md5(str_random(5)).'.'.$ext;
        $name = 'file_url';
        if($file->move($dir,$filename)){
            $this->arr[$name] = $dir.$filename;
        }

        $input['file_url'] = $this->arr[$name];
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

    public function apiGetEmployeeMaterials(User $user){
        $materials = TrainingMaterial::join('teams','teams.creator','training_materials.creator_id')
                    ->join('team_members','team_members.member_team_id','teams.id')->where('team_member_id',$user->id)->select('training_materials.*')
                    ->distinct()->get();
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
    public function destroy(TrainingMaterial $material)
    {
        DB::beginTransaction();
        try {
            $material->delete();

            DB::commit();
            return redirect('training_materials')->with('status','File deleted successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect('training_materials')->with('error','Error occured during deleting the file');
        }
    }
}
