<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AgentController extends Controller
{
    //
public function ask(Request $request)
    {
        $question = $request->input('question');

        // Here you would typically call your AI agent service to get a response
        // For demonstration, we'll just return a dummy response
        $response = "This is a response to your question: " . $question;

        return response()->json(['response' => $response]);
    }
}
