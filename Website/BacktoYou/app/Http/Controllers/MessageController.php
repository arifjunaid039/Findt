<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{

    // Send Message
    public function sendAjax(Request $request, $conversationId)
    {
        $request->validate([
            'message' => 'required'
        ]);


        DB::table('messages')->insert([

            'conversation_id' => $conversationId,

            'sender_id' => Auth::id(),

            'message' => $request->message,

            'is_read' => 0,

            'created_at' => now(),

            'updated_at' => now()

        ]);


        return response()->json([
            'success' => true
        ]);
    }



    // Load Messages
    public function load($conversationId)
    {

        $messages = DB::table('messages')

            ->join(
                'users',
                'messages.sender_id',
                '=',
                'users.id'
            )

            ->where(
                'conversation_id',
                $conversationId
            )

            ->select(

                'messages.id',

                'messages.sender_id',

                'messages.message',

                'messages.created_at',

                'users.fullname'

            )

            ->orderBy(
                'messages.created_at',
                'asc'
            )

            ->get();


        return response()->json($messages);

    }





    // Inbox
public function inbox()
{

    $conversations = DB::table('conversations')

        ->join(
            'items',
            'conversations.item_id',
            '=',
            'items.id'
        )


        ->where(function($query){

            $query->where(
                'conversations.owner_id',
                Auth::id()
            )

            ->orWhere(
                'conversations.claimant_id',
                Auth::id()
            );

        })


        ->select(

            'conversations.*',

            'conversations.claim_id',

            'items.title',

            'items.photo',

            'items.status',


            DB::raw(
                '(
                    SELECT message 
                    FROM messages 
                    WHERE messages.conversation_id = conversations.id 
                    ORDER BY id DESC 
                    LIMIT 1
                ) as last_message'
            ),


            DB::raw(
                '(
                    SELECT COUNT(*)
                    FROM messages
                    WHERE messages.conversation_id = conversations.id
                    AND messages.sender_id != '.Auth::id().'
                    AND messages.is_read = 0
                ) as unread'
            )

        )


        ->orderBy(
            'conversations.updated_at',
            'desc'
        )


        ->get();



    return view(
        'messages.index',
        compact('conversations')
    );

}






    // Open Chat
    public function show($conversation)
    {

        $conversationData = DB::table('conversations')


            ->join(
                'items',
                'conversations.item_id',
                '=',
                'items.id'
            )


            ->where(
                'conversations.id',
                $conversation
            )


            ->select(

                'conversations.*',

                'items.title',

                'items.photo',

                'items.status'

            )


            ->first();



        if(!$conversationData)
        {
            abort(404);
        }





        $messages = DB::table('messages')


            ->join(
                'users',
                'messages.sender_id',
                '=',
                'users.id'
            )


            ->where(
                'conversation_id',
                $conversation
            )


            ->select(

                'messages.*',

                'users.fullname'

            )


            ->orderBy(
                'messages.created_at',
                'asc'
            )


            ->get();



        // Mark messages as read
        DB::table('messages')

            ->where(
                'conversation_id',
                $conversation
            )

            ->where(
                'sender_id',
                '!=',
                Auth::id()
            )

            ->update([
                'is_read'=>1
            ]);




        return view(
            'messages.chat',
            [
                'conversation'=>$conversationData,

                'messages'=>$messages
            ]
        );

    }


}