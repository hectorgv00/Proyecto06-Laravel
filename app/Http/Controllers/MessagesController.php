<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Party;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class MessagesController extends Controller
{
    //

    public function createMessage(Request $request)
    {

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

            $party = DB::select(
                "SELECT parties.id, parties.name ,parties.game ,parties.owner ,users.id , users.username, users.steamUsername, users.email 
            FROM parties
            JOIN party_user on parties.id = party_user.party
            JOIN users on users.id = party_user.player
            WHERE parties.id = {$partyId} AND users.id = {$userId}"
            );


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

    public function deleteAMessage(Request $request)
    {
        Log::info("Deleting a message");


        try {
            $userIdToken = auth()->user()->id;

            $userId = $request->input("id");
            $messageId = $request->input("messageId");

            
            $message = Message::find($messageId);
            
            if ($userIdToken !== $userId || $message->id !== $userIdToken) {
                return response([
                    'success' => false,
                    'message' => "You can only delete your messages"
                ], 401);
            }
            
            if (!$message) {
                response([
                    'success' => true,
                    'message' => "The message could not be found"
                ], 404);
            }

            $message->delete();

            return response([
                'success' => true,
                'message' => "You have deleted your message",
                "data" => $message
            ], 401);
        } catch (\Throwable $th) {
            Log::error("Trying to delete a Message but something went wrong " . $th->getMessage());

            response([
                'success' => false,
                'message' => "Message could not be deleted => " . $th->getMessage()
            ], 500);
        }
    }

    public function modifyAMessage()
    {
    }
}
