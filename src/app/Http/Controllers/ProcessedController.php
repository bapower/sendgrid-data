<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

use App\Http\Requests;

use App\ProcessedEvent;
use App\Recipient;
use App\Category;
use App\CategoryEvent;

class ProcessedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        return $id;
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
    	$data = json_decode($request->getContent(), true);
    	try {
            $recipient = Recipient::firstOrNew(['email' => $data['email']]);
	    } catch (Exception $e){
		    return response($e->getMessage(), $e->getCode());
	    }

        if (isset($data['salesforce_contact_id'])) {
            $recipient->salesforce_id = $data['salesforce_contact_id'];
        }
        try {
            $recipient->save();
        } catch (Exception $e){
	        return response($e->getMessage(), $e->getCode());
        } catch (QueryException $e) {
	        return response($e->getMessage(), $e->getCode());
        }
        
        $timestamp = gmdate("Y-m-d H:i:s", $data['timestamp']);
        $event = new ProcessedEvent();
        $event->recipient_id = $recipient->id;

        if (isset($data['timestamp'])) {
            $event->event_date_time = $timestamp;
        }
        if (isset($data['ip'])) {
            $event->ip = $data['ip'];
        }
        if (isset($data['sg_event_id'])) {
            $event->sg_event_id = $data['sg_event_id'];
        }
        if (isset($data['sg_message_id'])) {
            $event->sg_message_id = $data['sg_message_id'];
        }
        if (isset($data['smtp-id'])) {
            $event->smpt_id = $data['smtp-id'];
        }
        if (isset($data['tls'])) {
            $event->tls = $data['tls'];
        }
        if (isset($data['cert_err'])) {
            $event->certificate_error = $data['cert_err'];
        }

        try {
            $event->save();
        } catch (Exception $e){
	        return response($e->getMessage(), $e->getCode());
        } catch (QueryException $e) {
	        return response($e->getMessage(), $e->getCode());
        }

	    if (array_key_exists('category', $data))
	    {
		    foreach ($data['category'] as $name)
		    {
			    try {
				    $category = Category::firstOrNew(['name' => $name]);
				    $category->save();
			    } catch (Exception $e) {
				    return response($e->getMessage(), $e->getCode());
			    } catch (QueryException $e) {
				    return response($e->getMessage(), $e->getCode());
			    }

			    $categoryEvent              = new CategoryEvent();
			    $categoryEvent->category_id = $category->id;
			    $categoryEvent->event_id    = $event->id;
			    $categoryEvent->event_type  = 'processed_event';
			    try {
				    $categoryEvent->save();
			    } catch (Exception $e) {
				    return response($e->getMessage(), $e->getCode());
			    } catch (QueryException $e) {
				    return response($e->getMessage(), $e->getCode());
			    }
		    }
	    }
        return response('Success', 200)->header('Content-Type', 'text/plain');
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
