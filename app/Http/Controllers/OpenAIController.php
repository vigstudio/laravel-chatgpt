<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class OpenAIController extends Controller
{
    public function index(){
        return view('openai');
    }
    
    public function generateText(Request $request)
    {
        // Get the input text from the form
        $inputText = $request->input('text');

        // Create a new Guzzle client
        $client = new Client();

        //Make a POST request to the OpenAI API
        $response = $client->post('https://api.openai.com/v1/completions', [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
            ],
            'json' => [
                'model' => 'text-davinci-003',
                'prompt' => $inputText,
                'temperature' => 0,
                'max_tokens' => 500,
            ],
        ]);

        // Get the JSON response
         $responseJson = json_decode($response->getBody()->getContents());
        
        //converte response to audio
        // $txt = $responseJson->choices[0]->text;
        // $txt=htmlspecialchars($txt);
        // $txt=rawurlencode($txt);
	    // $html=file_get_contents('https://translate.google.com/translate_tts?ie=UTF-8&client=gtx&q='.$txt.'&tl=es-IN');
	    // $player="<audio controls='controls' autoplay><source src='data:audio/mpeg;base64,".base64_encode($html)."'></audio>";

        // Return the generated text
        // return $player.$responseJson->choices[0]->text;

        return response()->json([
            'gptResponse' => $responseJson->choices[0]->text
        ]);
        
        // return $responseJson;
    }
}
