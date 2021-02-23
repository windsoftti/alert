<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Tipo;
use App\Prospecto;
use App\Chat;
use App\User;

class ChatController extends Controller
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Broadcast Message

        $prospecto = Prospecto::findOrFail($request->prospecto_id);

        $userSource = User::findOrFail($prospecto->user_source_id);

        $JSON_DATA = '{"token":"'.$userSource->pickyassist_token.'","priority ":0,';
        $JSON_DATA.='"application":"5","sleep":0,"globalmessage":"test","globalmedia":"",';
        $JSON_DATA.='"data":[{"messenger_id":"'.preg_replace('/[^0-9]/', '', $prospecto->number).'","message":"'.$request->message.'"}]}';

        //--CURL FUNCTION TO CALL THE API--
        $url = 'https://pickyassist.com/app/api/v2/push';

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $JSON_DATA);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($JSON_DATA))
        );

        $result = curl_exec($ch);

        $res = json_decode($result,true);

        if($res["status"]=="100"){

            $chat = new Chat;
            $chat->message = $request->message;
            $chat->user_id = auth()->user()->id;
            $chat->lead_id = $prospecto->id;
            $chat->type_id = 5;
            $chat->save();

        }else{

        }

        //--API RESPONSE--

        return response()->json(json_decode($result,true));

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


    public function chatsLeadAjax($id)
    {
        $chats = Chat::where('lead_id',$id)->get();

        foreach($chats as $chat){
            $chat->user=$chat->user;
            $chat->lead=$chat->lead;
        }
        return response()->json($chats);

    }
}
