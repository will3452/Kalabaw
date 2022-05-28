<?php

namespace Modules\Announcement\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Contracts\Support\Renderable;
use Modules\Announcement\Entities\Announcement;
use Modules\Farmer\Entities\Farmer;
use Modules\Fishermen\Entities\Fishermen;

class AnnouncementController extends Controller
{
    public function sendMessage($phone, $message)
    {
        $ch = curl_init();
        $parameters = array(
            'apikey' => env('SMS_API_KEY'),
            'number' => $phone,
            'message' => $message,
            'sendername' => 'SEMAPHORE'
        );
        curl_setopt( $ch, CURLOPT_URL,'https://semaphore.co/api/v4/messages');
        curl_setopt( $ch, CURLOPT_POST, 1 );

        //Send the parameters set above with the request
        curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query( $parameters ) );

        // Receive response from server
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        $output = curl_exec( $ch );
        curl_close ($ch);

        //Show the server response
        echo $output;
    }
    public function getColumns()
    {
        $result = [];
        foreach (Announcement::_COLUMNS as $value) {
            if (in_array($value, Announcement::_EXCLUDE_TO_FORM)) {
                continue;
            }
            $result[] = $value;
        }
        return $result;
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $announcements = Announcement::get();
        $columns = $this->getColumns();
        return view('announcement::index', compact('columns', 'announcements'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $columns = $this->getColumns();
        $model = Announcement::class;
        return view('announcement::create', compact('columns', 'model'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $fields = $this->getColumns();
        $fieldsToValidate = [];
        foreach ($fields as $value) {
            $fieldsToValidate[$value] = 'required';
        }
        $data = $request->validate($fieldsToValidate);
        Announcement::create($data);
        $mobile = [];

        if ($data['for'] == 'farmers') {
            $mobile = Farmer::get(['contact_no'])->pluck('contact_no');
        } else if ($data['for'] == 'fishermen') {
            $mobile = Fishermen::get(['contact_no'])->pluck('contact_no');
        } else {
            $farmers = Farmer::get(['contact_no'])->pluck('contact_no')->toArray();
            $fishermen = Fishermen::get(['contact_no'])->pluck('contact_no')->toArray();
            $raw = array_merge($farmers, $fishermen);
            $mobile = array_unique($raw);
        }
        foreach ($mobile as $f) {
            $this->sendMessage($f, $request->message);
        }
        return back()->withSuccess('The message was successfully sent! ');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('announcement::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Announcement $announcement)
    {
        $columns = $this->getColumns();
        $model = Announcement::class;
        return view('announcement::edit', compact('announcement', 'columns', 'model'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, Announcement $announcement)
    {
        $fields = $this->getColumns();
        $fieldsToValidate = [];
        foreach ($fields as $value) {
            $fieldsToValidate[$value] = 'required';
        }
        $data = $request->validate($fieldsToValidate);
        $announcement->update($data);
        return back()->withSuccess('Changes has been saved!');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Announcement $announcement)
    {
        $announcement->delete();
        return back()->withSuccess('Record has been archived! ');
    }
}
