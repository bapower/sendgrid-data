<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Route;
use File;
use Mail;
use DB;

class EventController extends Controller
{
	/**
	 * The email address to send error alert emails
	 *
	 * @const string
	 */
	const ALERTEMAIL = 'bapower@gmail.com';

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

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->input();
            $response = response('Not Found', 401)->header('Content-Type', 'text/plain');
            $error = False;

            foreach ($data as $item) {
                $event = $item['event'];

                switch ($event) {
                    case 'bounce':
                        $path = 'api/bounce';
	                    $request = Request::create($path, 'post', [], [], [], [], json_encode($item));
	                    $response = app()->handle($request);
                        break;
                    case 'click':
                        $path = 'api/click';
	                    $request = Request::create($path, 'post', [], [], [], [], json_encode($item));
	                    $response = app()->handle($request);
                        break;
                    case 'deferred':
                        $path = 'api/deferred';
	                    $request = Request::create($path, 'post', [], [], [], [], json_encode($item));
	                    $response = app()->handle($request);
                        break;
                    case 'delivered':
                        $path = 'api/delivered';
	                    $request = Request::create($path, 'post', [], [], [], [], json_encode($item));
	                    $response = app()->handle($request);
                        break;
                    case 'dropped':
                        $path = 'api/dropped';
	                    $request = Request::create($path, 'post', [], [], [], [], json_encode($item));
	                    $response = app()->handle($request);
                        break;
                    case 'open':
                        $path = 'api/open';
	                    $request = Request::create($path, 'post', [], [], [], [], json_encode($item));
	                    $response = app()->handle($request);
                        break;
                    case 'processed':
                        $path = '/api/processed';
	                    $request = Request::create($path, 'post', [], [], [], [], json_encode($item));
	                    $response = app()->handle($request);
                        break;
                    case 'spam report':
                        $path = 'api/spamreport';
	                    $request = Request::create($path, 'post', [], [], [], [], json_encode($item));
	                    $response = app()->handle($request);
                        break;
                    case 'unsubscribe':
                        $path = 'api/unsubscribe';
	                    $request = Request::create($path, 'post', [], [], [], [], json_encode($item));
	                    $response = app()->handle($request);
                        break;
                    default:
                        $response = response('Not Found', 401)->header('Content-Type', 'text/plain');
                }
	            if ($response->getStatusCode() != 200) {
                	$error = True;
		            File::append(storage_path() . '/logs/errordata.json', json_encode($item) . PHP_EOL);
	            }
            }
            if($error) {
	            $messageBase = "The Sendgrid data API generated an error : ";
	            $this->sendAlertEmail($messageBase .
		            $response->getStatusCode() . " " .
		            $response->getContent() . " " .
		            json_encode($item)
	            );
            }
            return $response;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //return Recipient::find($id);
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

	/**
	 * Send an email alerting a possible error in the system.
	 *
	 * @param  string  $emailBody
	 */

	public static function sendAlertEmail($emailBody)
	{
		Mail::raw($emailBody, function ($message) {
			$message->subject('Sendgrid data API alert');
			$message->to(self::ALERTEMAIL);
		});
	}
}
