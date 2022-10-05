<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use LINE\LINEBot\Event\MessageEvent;
use LINE\LINEBot\Exception\InvalidEventRequestException;
use LINE\LINEBot\Exception\InvalidSignatureException;
use LINE\LINEBot\Event\MessageEvent\TextMessage;

class WebhookController extends Controller
{
    public function webhook(Request $request)
    {
        Log::info($request);

        $httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient(env('LINE_CHANNEL_ACCESS_TOKEN'));
        $bot = new \LINE\LINEBot($httpClient, ['channelSecret' => env('LINE_CHANNEL_SECRET')]);

        foreach ($request['events'] as $event) {
            if ($event['message']['type'] == 'text' && $event['message']['text'] == 'give me 10 scores') {
                $post = Post::inRandomOrder()->first();
                $response = $bot->replyText($event['replyToken'], $post->title);
            }

            if ($event['message']['type'] == 'sticker') {
                $response = $bot->replyText($event['replyToken'], 'package_Id = '
                    . $event['message']['packageId']
                    . 'and'
                    . 'stickerId = '
                    .$event['message']['stickerId']);
            }
        }

        return response()->json([]);

//        $signature = $request->header(\LINE\LINEBot\Constant\HTTPHeader::LINE_SIGNATURE);
//        if (empty($signature)) {
//            abort(400);
//        }
//
//        Log::info($request->getContent());
//
//        try {
//            $events = $bot->parseEventRequest($request->getContent(), $signature);
//        } catch (InvalidSignatureException $e) {
//            Log::error('Invalid signature');
//            abort(400, 'Invalid signature');
//        } catch (InvalidEventRequestException $e) {
//            Log::error('Invalid event request');
//            abort(400, 'Invalid event request');
//        }

//        foreach ($events as $event) {
//            if (!($event instanceof MessageEvent)) {
//                Log::info('Non message event has come');
//                continue;
//            }
//
//            if (!($event instanceof TextMessage)) {
//                Log::info('Non text message has come');
//                continue;
//            }
//            $inputText = $event->getText();
//            $replyText = '';
//            if ($inputText == 'give me 10 scores') {
//                $replyText = Post::all()->random();
//            } else {
//                Log::info('inputText: ' . $inputText);
//            }
//            $replyToken = $event->getReplyToken();
//            $userId = $event->getUserId();
//            $profile = $bot->getProfile($userId);
//            $profile = $profile->getJSONDecodedBody();
//            $displayName = $profile['displayName'];
//            $pictureUrl = $profile['pictureUrl'];
//            $statusMessage = $profile['statusMessage'];
//
//            if ($replyText !== '') {
//                $response = $bot->replyText($replyToken, $replyText);
//
//                Log::info($response->getHTTPStatus() . ': ' . $response->getRawBody());
//            } else {
//                $multiMessageBuilder = new \LINE\LINEBot\MessageBuilder\MultiMessageBuilder();
//                $textMessageBuilder = add(new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($displayName));
//                $multiMessageBuilder = add(new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($statusMessage));
//                $multiMessageBuilder = add(new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($pictureUrl, $pictureUrl));
//                $response = $bot->replyMessage($replyToken, $multiMessageBuilder);
//            }
//        }


    }

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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

    public function getMessage(Request $request){
        return response()->json([]);
    }
}
