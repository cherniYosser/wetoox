<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Picker;
use App\Models\Receiver;
use App\Models\Toox;
use App\Models\Transporter;
use App\Models\Sender;




class TooxController extends Controller
{

    public function index(Request $request)
    {

        $tooxs = Toox::where(function ($query) use ($request) {

            if (($tooxname = $request->get('search_toox_name'))) {
                $query->Where('name', 'like', '%' . $tooxname . '%');
            }
            if (($pickup_location = $request->get('search_toox_pickup_location'))) {
                $query->Where('pickup_location', 'like', '%' . $pickup_location . '%');
            }
            if (($delivery_location = $request->get('search_toox_delivery_location'))) {
                $query->Where('delivery_location', 'like', '%' . $delivery_location . '%');
            }
            if (($price = $request->get('search_toox_price'))) {
                $query->Where('price', 'like', '%'.$price.'%');
            }
            if (($delivery_deadline = $request->get('search_delivery_deadline'))) {
                $query->Where('delivery_deadline', 'like', $delivery_deadline);
            }
        })
            ->where("status",true)
            ->orderBy("id", "desc")
            ->paginate(4);

        return response()->json([
            'tooxs' => $tooxs
        ]);

    }

    public function store(Request $request)
    {
        $picker = new Picker();
        $receiver = new Receiver();
        $toox = new Toox();

        // $this->validate($request, [
        //     'name' => 'required',
        // ]);
        // if ($request->size != 'pet') {
        //     $this->validate($request, [
        //         'value' => 'required'
        //     ]);
        // }
        // $this->validate($request, [
        //     'size' => 'required',
        //     'toox_picture' => 'image|max:2048|required|dimensions:min_height=295,min_width=280',
        //     'pickup_location' => 'required',
        // ]);
        // if ($request->picker == '') {
        //     $this->validate($request, [
        //         'picker' => 'required'
        //     ]);
        // }
        // if ($request->picker == '2') {
        //     $this->validate($request, [
        //         'picker_name' => 'required',
        //         'picker_email' => 'required',
        //         'picker_phone' => 'required',
        //     ]);
        // }
        // if ($request->picker == '3') {
        //     $this->validate($request, [
        //         'pickup_from_location' => 'required',
        //         'pickup_from_location_email' => 'required',
        //         'pickup_from_location_phone' => 'required'
        //     ]);
        // }
        // $this->validate($request, [
        //     'delivery_location' => 'required'
        // ]);
        // if ($request->receiver == '') {
        //     $this->validate($request, [
        //         'receiver' => 'required'
        //     ]);
        // }
        // if ($request->receiver == '5') {
        //     $this->validate($request, [
        //         'receiver_name' => 'required',
        //         'receiver_email' => 'required',
        //         'receiver_phone' => 'required'
        //     ]);
        // }
        // if ($request->receiver == '6') {
        //     $this->validate($request, [
        //         'recive_location' => 'required',
        //         'recive_location_email' => 'required',
        //         'recive_location_phone' => 'required'
        //     ]);
        // }
        // if ($request->package_deliver_date == '') {
        //     $this->validate($request, [
        //         'package_deliver_date' => 'required'
        //     ]);
        // }
        // if ($request->package_deliver_date == '8') {
        //     $this->validate($request, [
        //         'delivery_deadline' => 'required'
        //     ]);
        // }
        // $this->validate($request, [
        //     'additional_information' => 'required'
        // ]);
        // $this->validate($request, [
        //     'delivery_location' => 'required',
        //     'additional_information' => 'required'
        // ]);
        // if ($request->additional_expenses == '') {
        //     $this->validate($request, [
        //         'additional_expenses' => 'required'
        //     ]);
        // }
        // if ($request->additional_expenses == '11') {
        //     $this->validate($request, [
        //         'reason' => 'required',
        //         'extra_compensation' => 'required'
        //     ]);
        // }


        // if ($request->picker == '1') {
        //     if(Auth::user() != null){
        //         $picker->picker_name = Auth::user()->name;
        //         $picker->picker_email = Auth::user()->email;
        //         if(Auth::user()->sender != null){
        //             $picker->picker_phone = Auth::user()->sender->phone;
        //         }
        //     }
        //     else{
        //         $picker->auth=true;
        //     }
        // }
        // else if ($request->picker == '2') {
        //     $picker->picker_name = $request->picker_name;
        //     $picker->picker_email = $request->picker_email;
        //     $picker->picker_phone = $request->picker_phone;

        // }
        // else if ($request->picker == '3') {
        //     $picker->picker_name = $request->pickup_from_location;
        //     $picker->picker_email = $request->pickup_from_location_email;
        //     $picker->picker_phone = $request->pickup_from_location_phone;

        // }

        // if ($request->receiver == '4') {
        //     if(Auth::user() != null) {
        //         $receiver->receiver_name = Auth::user()->name;
        //         $receiver->receiver_email = Auth::user()->email;
        //         if (Auth::user()->sender != null) {
        //             $receiver->receiver_phone = Auth::user()->sender->phone;
        //         }
        //     }
        //     else{
        //         $receiver->auth=true;
        //     }


        // }
        // else if ($request->receiver == '5') {
        //     $receiver->receiver_name = $request->receiver_name;
        //     $receiver->receiver_email = $request->receiver_email;
        //     $receiver->receiver_phone = $request->receiver_phone;

        // }
        // else if ($request->receiver == '6') {
        //     $receiver->receiver_name = $request->recive_location;
        //     $receiver->receiver_email = $request->recive_location_email;
        //     $receiver->receiver_phone = $request->recive_location_phone;

        // }


        $toox->name = $request->name;
        $toox->value = $request->value;
        $toox->size = $request->size;
        // = $request->pickup_location;
        //$toox->delivery_location = $request->delivery_location;
        $toox->additional_information = $request->additional_information;


        // if ($request->package_deliver_date == '8') {
        //     $toox->delivery_deadline = $request->delivery_deadline;
        // }




        $toox->price = $request->pricetopay;


        // $toox->latpl = $request->lat;
        // $toox->lngpl = $request->lng;
        // $toox->latdl = $request->lat2;
        // $toox->lngdl = $request->lng2;




/*
        if ($request->hasFile('toox_picture')) {

            $toox->picture =  UploadsController::upload('toox_picture', '', '/uploads/toox/', '295', '280');
        }
*/
        $picker->save();
        $receiver->save();
        $toox->picker_id = $picker->id;
        $toox->receiver_id = $receiver->id;
        $toox->state = "Waiting for transporter";

        $toox->status = false;
/*
        if ( Auth::user()== true && Auth::user()->sender == null ) {

            $sender = new Sender();
            $sender->user_id= Auth::user()->id;
            $sender->save();

            $toox->sender_id = $sender->id;
            $toox->status = false;

        }
        elseif( Auth::user()== true ){
            $toox->sender_id = Auth::user()->sender->id;
        }

        else{
            $toox->status = false;
        }
*/
        $toox->save();

        /*
        if(Auth::user()== null){

            $idtoox= $toox->id;
            $session = new Session();
            $session->set('toox',$idtoox);
            $request->session()->flash('alert-tooxsession', 'Please register or login to save your toox');
            return response()->json([
                'status'=>200
            ])->setCallback($request->input('callback'));
        }
*/
        return response()->json([
            'status'=>200
        ]);


    }


    public function GetDrivingDistance($lat1, $lat2, $long1, $long2)
    {
        $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=" . $lat1 . "," . $long1 . "&destinations=" . $lat2 . "," . $long2 . "&mode=driving&language=pl-PL";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $response = curl_exec($ch);
        curl_close($ch);
        $response_a = json_decode($response, true);

        $dist = $response_a['rows'][0]['elements'][0]['distance']['text'];
        return $dist;
    }


    public function price(Request $request)
    {

        $extra_compensation = $request->extra_compensation;
        $intextra_compensation = (int)$extra_compensation;

        $pricedist = 0;

        if ($request->has('lat') || $request->has('lat2') || $request->has('lng') || $request->has('lng2')) {

            $lat = $request->lat;
            $lat2 = $request->lat2;
            $lng = $request->lng;
            $lng2 = $request->lng2;
            $dist = self::GetDrivingDistance($lat, $lat2, $lng, $lng2);
            $distance = (int)$dist;
            $pricedist = 0.1 * $distance;

        }


        $price = 10  + $intextra_compensation + $pricedist;
        return response()->json($price);


    }


    public function show($id)
    {
        $toox = Toox::find($id);
        return response()->json([
            'toox'=>$toox
        ]);
    }

    public function mytoox($id)
    {
        $tooxs = Toox::where('sender_id', $id)->where('status',1)->get();
        return response()->json([
            'tooxs'=>$tooxs
        ]);
    }

    public function toox_transporter($id)
    {
        $tooxs = Toox::where('transporter_id', $id)->where('status',1)->get();
        return response()->json([
            'tooxs'=>$tooxs
        ]);
    }

    public function mytooxdetails($id)
    {
        $toox = Toox::find($id);

        if ($toox->state == 'Waiting for transporter') {
            return view('toox.mytooxdetails', compact('toox'));
        }
        else {
            $transporterid = $toox->transporter;
            $transporter = Transporter::find($transporterid);
            return  response()->json([
                'toox'=>$toox,
                'transporter'=>$transporter
            ]);
        }

    }
    public function toox_transporter_details($id)
    {
        $toox = Toox::find($id);
        return response()->json([
            'toox'=>$toox
        ]);
    }



    public function choosetoox($id)
    {

        $transporterid = Auth::user()->transporter->id;

        $toox = Toox::find($id);

        if (!$toox->transporters->contains($transporterid)) {
            $toox->transporters()->attach($transporterid);

        }

        return   response()->json([
            'status'=>200        ])->setCallback($request->input('callback'));
    }

    public function choosetransporter($id, $idtoox)
    {

        $toox = Toox::findOrFail($idtoox);
        $toox->transporter_id = $id;
        $toox->state = 'In progress';

        $toox->update();
//redirect()->route('mytoox', Auth::user()->sender->id);
        return response()->json([
            'mytoox'=>Auth::user()->sender->id        ])->setCallback($request->input('callback'));

    }


    public function edit($id)
    {
        $toox = Toox::find($id);

        return view('toox.edittoox', compact('toox'));

    }


    public function update(Request $request, $id)
    {

        $toox = Toox::find($id);
        $idpicker = $toox->picker_id;
        $idreceiver = $toox->receiver_id;

        $picker = Picker::find($idpicker);
        $receiver = Receiver::find($idreceiver);


        $this->validate($request, [

            'toox_picture' => 'image|max:2048|dimensions:min_height=295,min_width=280'

        ]);

        if ($request->picker == '2') {
            $this->validate($request, [
                'picker_name' => 'required',
                'picker_email' => 'required',
                'picker_phone' => 'required',
            ]);
        }
        if ($request->picker == '3') {
            $this->validate($request, [
                'pickup_from_location' => 'required',
                'pickup_from_location_email' => 'required',
                'pickup_from_location_phone' => 'required'
            ]);
        }

        if ($request->receiver == '5') {
            $this->validate($request, [
                'receiver_name' => 'required',
                'receiver_email' => 'required',
                'receiver_phone' => 'required'
            ]);
        }
        if ($request->receiver == '6') {
            $this->validate($request, [
                'recive_location' => 'required',
                'recive_location_email' => 'required',
                'recive_location_phone' => 'required'
            ]);
        }


        if ($request->picker == '1') {
            $picker->picker_name = Auth::user()->name;
            $picker->picker_email = Auth::user()->email;
            $picker->picker_phone = Auth::user()->sender->phone;
        } else if ($request->picker == '2') {
            $picker->picker_name = $request->picker_name;
            $picker->picker_email = $request->picker_email;
            $picker->picker_phone = $request->picker_phone;
        } else if ($request->picker == '3') {
            $picker->picker_name = $request->pickup_from_location;
            $picker->picker_email = $request->pickup_from_location_email;
            $picker->picker_phone = $request->pickup_from_location_phone;
        }

        if ($request->receiver == '4') {
            $receiver->receiver_name = Auth::user()->name;
            $receiver->receiver_email = Auth::user()->email;
            $receiver->receiver_phone = Auth::user()->sender->phone;
        } else if ($request->receiver == '5') {
            $receiver->receiver_name = $request->receiver_name;
            $receiver->receiver_email = $request->receiver_email;
            $receiver->receiver_phone = $request->receiver_phone;
        } else if ($request->receiver == '6') {
            $receiver->receiver_name = $request->recive_location;
            $receiver->receiver_email = $request->recive_location_email;
            $receiver->receiver_phone = $request->recive_location_phone;
        }

        $toox->sender_id = Auth::user()->sender->id;
        $toox->name = $request->name;
        $toox->value = $request->value;
        $toox->size = $request->size;
        $toox->pickup_location = $request->pickup_location;
        $toox->delivery_location = $request->delivery_location;
        $toox->additional_information = $request->additional_information;


        if ($request->package_deliver_date == '8') {
            $toox->delivery_deadline = $request->delivery_deadline;
        }

        if ($request->hasFile('toox_picture')) {

            $oldImage = $toox->picture;
            $toox->picture =  UploadsController::upload('toox_picture', '', '/uploads/toox/', '295', '280');
            File::delete($oldImage);

        }

        if ($request->pricetopay != "") {


            $toox->price = $request->pricetopay;

        }

        if ($request->lat != "") {

            $toox->latpl = $request->lat;
            $toox->lngpl = $request->lng;
            $toox->latdl = $request->lat2;
            $toox->lngdl = $request->lng2;

        }

        $picker->update();
        $receiver->update();

        $toox->picker_id = $picker->id;
        $toox->receiver_id = $receiver->id;
        $toox->state = "Waiting for transporter";

        $toox->update();

        return redirect()->route('mytoox', Auth::user()->sender->id);
    }


    public function check_transporter($id)
    {
         $transporter = Transporter::find($id);
         return view('toox.check_transporter', compact('transporter'));
    }

    public function toox_picture_picker($id){

        $toox = Toox::find($id);
        $toox->toox_picture_picker = UploadsController::upload('toox_picture_picker', '', '/uploads/toox_picker/', '', '');
        $toox->update();
        return redirect()->back();
    }
    public function toox_picture_reciever($id){
        $toox = Toox::find($id);
        $toox->toox_picture_reciever = UploadsController::upload('toox_picture_reciever', '', '/uploads/toox_reciever/', '', '');
        $toox->update();
        return redirect()->back();

    }

}
