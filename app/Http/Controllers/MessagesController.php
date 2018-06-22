<?php

namespace App\Http\Controllers;

use App\Message;
use App\User;
use DB;
use Illuminate\Http\Request;
use File;
use Image;

class MessagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    public function getMessagesApi(User $user){
        $messages = Message::join('users','users.id','messages.to')
                        ->whereNull('users.deleted_at')
                          -> where('to',$user->id)
            ->orderBy('created_at','DESC')
            ->select('messages.*','users.name as first_name','users.surname as last_name','users.picture_url as user_picture_url')
            ->get();

        return response()->json(["messages"=>$messages]);
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
        $input = $request->all();
        DB::beginTransaction();
        try {
            $input['picture_url'] = "none";
            if (array_key_exists('image', $input)) {
                $main_picture_url = $request->file('image');
                $dir = "photos/";
                if (File::exists(public_path($dir)) == false) {
                    File::makeDirectory(public_path($dir), 0777, true);
                }
                $img = Image::make($main_picture_url->path());
                $path = "{$dir}" . uniqid() . "." . $main_picture_url->getClientOriginalExtension();
                $img->save(public_path($path));
                $input['message_picture_url'] = $path;
            }

            $message = Message::Create($input);
            $receiver = User::where('id',$message->from)->first();
            $push_message = new \stdClass();
            $push_message->id = $message->id;
            $push_message->first_name = $receiver->name;
            $push_message->last_name = $receiver->surname;
            $push_message->message_text = $message->message;
            $push_message->message_picture_url = $message->message_picture_url;
            $push_message->user_picture_url = $receiver->picture_url;
            DB::commit();
            return response()->json(["status" => "200", "message" => "Message sent successfully", "push_msg" => $message]);

        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
            return response()->json(["status" => "500", "message" => $e]);
        }
        return [];
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
