<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Party;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class MessagesController extends Controller
{
    //

    public function createMessage(Request $request){

        Log::info("Creating a message");

        try {
            $validator = Validator::make($request->all(), [
                'message' => 'required|string|max:255',
                'party' => 'required',
            ]);
    
            if ($validator->fails()) {
                return response([
                    'success' => false,
                    'message' => $validator->messages()
                ], 400);
            }
    
            $userId = auth()->user()->id;
            $partyName = $request->name;
            $partyId = $request->party;
            $requestedMessage = $request->message;
    
            $party =Party:: 
            // where('name', $partyName)->where("id", $partyId)->first();
            select('parties.id', 'parties.name', 'parties.game', 'parties.owner')
                ->with('users:id,username,steamUsername,email')
                ->where('parties.id', $partyId)
                ->find($userId);

                


            if ($party === null) {
                return response([
                    'success' => true,
                    'message' => "the party could not be found or the user that is trying to send a message is not in {$partyName} party",
                ], 404);
            }


    
            $message = Message::create([
                'party' => $partyId,
                'message' => $requestedMessage,
                'from' => $userId,
                'date' =>  date(DATE_ATOM)
            ]);

            $message->save();

            return response([
                'success' => true,
                'message' => "the message has been created successfully =>",
                "data" => $message
            ], 200);
            
        } catch (\Throwable $th) {
            Log::error("The message could not be created");

            return response([
                'success' => false,
                'message' => "the message could not be created " . $th->getMessage(),
            ], 500);
        }

    }
}
