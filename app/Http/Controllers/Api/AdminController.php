<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Sender;
use App\Transporter;
use Intervention\Image\ImageManagerStatic as Image;
use File;
use App\Http\Transformers\UsersTransformer;
use Dingo\Api\Routing\Helpers;
use App\Toox;
use App\Claim;
use Illuminate\Support\Facades\Mail;
use App\Mail\Claimreply;
class AdminController extends Controller
{

    use Helpers;

    public function index()
    {
        return view('admin.dashboard');
    }

    public function users()
    {
        $users = User::where('role', 'user')->get();
        return view('admin.users', compact('users'));
    }

    public function tooxs()
    {
        $tooxs = Toox::all();
        return view('admin.tooxs', compact('tooxs'));
    }

    public function edituser($id)
    {
        $user = User::find($id);
        return view('admin.edituser', compact('user'));
    }


    public function updateuser(Request $request, $id)
    {
        $user = User::find($id);

        $sender = Sender::find($user->sender_id);
        $transporter = Transporter::find($user->transporter_id);


        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            $location = public_path('/uploads/user/' . $filename);
            Image::make($avatar)->resize(300, 300)->save($location);
            $oldFile = $user->avatar;
            $user->avatar = "/uploads/user/" . $filename;
            File::delete('/uploads/user/' . $oldFile);
        }

        if ($user->sender != null) {
            $sender->cin = $request->sender_cin;
            $sender->phone = $request->sender_phone;
            $sender->card_number = $request->card_number;
            $sender->card_password = $request->card_password;
            $sender->update();
        }

        if ($user->transporter != null) {
            $transporter->cin = $request->transport_cin;
            $transporter->phone = $request->transport_phone;
            $transporter->num_driver_license = $request->num_driver_license;
            $transporter->car_registration_number = $request->car_registration_number;
            $transporter->car_insurance_number = $request->car_insurance_number;
            $transporter->car_type = $request->car_type;

            if ($request->hasFile('car_picture')) {
                $car_picture = $request->file('car_picture');
                $filename = time() . '.' . $car_picture->getClientOriginalExtension();
                $location = public_path('/uploads/usercar/' . $filename);
                Image::make($car_picture)->resize(300, 300)->save($location);
                $oldFile = $transporter->car_picture;
                $transporter->car_picture = "/uploads/usercar/" . $filename;
                File::delete('/uploads/usercar/' . $oldFile);

            }
            $transporter->update();
        }


        $user->update();

        return redirect()->route('adminusers');

    }

    public function claim()
    {
        $claims = Claim::all();
        return view('admin.claim', compact('claims'));
    }


    public function claimdetails($id)
    {
        $claim = Claim::find($id);
        return view('admin.claimdetails', compact('claim'));
    }

    public function tooxdetails($id)
    {
        $toox = Toox::find($id);
        return view('admin.tooxdetails', compact('toox'));
    }


    public function tooxedit($id)
    {
        $toox = Toox::find($id);
        return view('admin.tooxedit', compact('toox'));
    }

    public function updatetoox(Request $request, $id)
    {

    }


    public function block($id)
    {
        $user = User::find($id);
        if ($user->block == true) {
            $user->block = false;
        } else {
            $user->block = true;
        }
        $user->update();

        return response()->json(json_encode($user));

    }

    public function blocktoox($id)
    {
        $toox = Toox::find($id);
        if ($toox->status == true) {
            $toox->status = false;
        } else {
            $toox->status = true;
        }
        $toox->update();

        return redirect()->route('admintooxs');

    }

    public function claimmail($id){

        $claim=Claim::find($id);
        return view('admin.claimmail', compact('claim'));

    }


    public function claimsendmail(Request $request,$id){

        $claim=Claim::find($id);
        $sendto= $request->sendto;
        $subject= $request->subject;
        $message= $request->message;
        $username= $claim->user->name;
        Mail::to($sendto)->send(new Claimreply($subject,$message,$username));
        return redirect()->route('adminclaims');
    }



}
