<?php

namespace App\Http\Controllers;

use App\ShiftTask;
use App\TasksEmployee;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Task;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;
use DB;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
//        dd(Task::all());
        return view('tasks.index');
    }

    public function getTasks(){
        $tasks = DB::table('tasks')
                ->where('tasks.creator_id',Auth::user()->id)
            ->get();
        return DataTables::of($tasks)
            ->addColumn('action', function ($task) {
                return '<a href="tasks/' . $task->id . '" title="View Task" class=""><i class="glyphicon glyphicon-eye-open"></i></a><a href="tasks/' . $task->id . '/edit" style="margin-left:1em" title="Edit Task" class=""><i class="glyphicon glyphicon-edit"></i></a><a href="delete_tasks/' . $task->id . '" style="margin-left:1em" class="" title="Delete Task"><i class="glyphicon glyphicon-trash "></i></a>';
            })
            ->make(true);
    }

    public function getCurrentTasks(User $user){
        $current_date = Carbon::now()->format('Y-m-d');

        $current_tasks= ShiftTask::join('tasks','tasks.id','shift_tasks.task_id')
                        ->where('tasks.start_date','=',$current_date)
                        ->where('shift_tasks.employee_id','=',$user->id)
                        ->select('tasks.*')
                        ->get();
        return response()->json(["tasks" => $current_tasks]);
    }

    public function getCurrentManagerTasks(User $user){
        $current_date = Carbon::now()->format('Y-m-d');
        $current_tasks= Task::where('tasks.start_date','=',$current_date)
            ->where('tasks.creator_id','=',$user->id)
            ->select('tasks.*')
            ->get();
        $current_temp = array();
        $current_temp_2 = array();
        foreach($current_tasks as $current_task){
            if(!in_array($current_task->start_date,$current_temp)){
                array_push($current_temp,$current_task->start_date);
                array_push($current_temp_2,$current_task);
            }
        }
        $current_tasks = $current_temp_2;
        return response()->json(["tasks" => $current_tasks]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        DB::beginTransaction();
        try {
            $task = Task::create($request->all());
            DB::commit();

        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
        return redirect('tasks');
    }

    public function shiftTasks(Request $request){
        $input = $request->all();

        DB::beginTransaction();
        try {
            $task = Task::create($request->all());
            $shift_task = ShiftTask::create(['employee_id'=>$input['employee_id'],'shift_id'=>$input['shift_id'],'task_id'=>$task->id]);
            DB::commit();

        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
//        return redirect('tasks');
    }

    public function shiftTasksExisting(Request $request){
        $input = $request->all();
//        dd($input);
        DB::beginTransaction();
        try {
            $tasks_chosen = array_except($input,['shift_id','employee_id','_token']);
//            dd($tasks_chosen);
            foreach ($tasks_chosen as $task_selected){

//                $input['task_id'] = $task_selected;
                $shift_task = ShiftTask::create(['shift_id'=>$input['shift_id'],'employee_id'=>$input['employee_id'],'task_id'=>$task_selected]);
            }

            DB::commit();

        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
//        return redirect('tasks');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
        return view('tasks.view',compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
        return view('tasks.edit',compact('task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        //
        DB::beginTransaction();
        try {
            $task->update($request->all());
            DB::commit();

        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
        return redirect('tasks');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        //
        $task->delete();
    }
}
