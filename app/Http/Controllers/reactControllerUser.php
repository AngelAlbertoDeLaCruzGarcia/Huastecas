<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Twilio\Jwt\AccessToken;
use Twilio\Rest\Client;

class reactControllerUser extends Controller
{

    public  function ReactUser(Request $user)
    {
        if ($user->name  != null) {
            User::updateOrInsert(
                ['id' => $user->id],
                [
                    'name' => $user->name,
                ]
            );
        }

        if ($user->email  != null) {
            User::updateOrInsert(
                ['id' => $user->id],
                [
                    'email' => $user->email,
                ]
            );
        }

        if ($user->cel  != null) {
            User::updateOrInsert(
                ['id' => $user->id],
                [

                    'cel' => $user->cel,
                ]
            );
        }

        if ($user->password  != null) {
            User::updateOrInsert(
                ['id' => $user->id],
                [
                    'password' => $user->password,
                ]
            );
        }
    }

    public function show(Request $DatosUser)
    {
        $datoUser = User::where('id', $DatosUser->id)->first();
        return $datoUser;
    }
    public function sendVerify(Request $request)
    {
        try {
            $sid = getenv("TWILIO_ACCOUNT_SID");
            $token = getenv("TWILIO_AUTH_TOKEN");
            $twilio = new Client($sid, $token);
            $verification = $twilio->verify->v2->services("VAa162319743c8b7474c403f9cae7551a0")
                ->verifications
                ->create("+52" . $request->cel, "sms");
            if ($verification->status == "pending" && !$verification->valid) {
                return  response()->json([
                    'message' => 'pending'
                ], 200);
            }
            return  response()->json([
                'message' => 'error'
            ], 500);
        } catch (\Exception $e) {
            return $e;
        }
    }
    public function verifycelular(Request $request)
    {
        try {
            $sid = getenv("TWILIO_ACCOUNT_SID");
            $token = getenv("TWILIO_AUTH_TOKEN");
            $twilio = new Client($sid, $token);

            $verification_check = $twilio->verify->v2->services("VAa162319743c8b7474c403f9cae7551a0")
                ->verificationChecks
                ->create(
                    $request->codigo, // code
                    ["to" => "+52" . $request->cel]
                );
            if ($verification_check->status == "approved" && $verification_check->valid) {
                return  response()->json([
                    'message' => 'echo'
                ], 200);
            }
            return  response()->json([
                'message' => 'error'
            ], 500);
        } catch (\Exception $e) {
            return $e;
        }
    }
    public function checkUser(Request $request)
    {
        $request->validate([
            'correo' => 'required|email|exists:users,email',
        ]);
        $query = User::where('email', $request->correo)->first();
        if ($query != null)
            return $query;
    }

    /*
            $twilio_number = "+17813497894";
            $client = new Client($sid, $token);
            $client->messages->create(
                // Where to send a text message (your cell phone?)
                '+527716838276',
                array( 
                    'from' => $twilio_number,
                    'body' => 'Huasteca Test SMS'
                )
            );
    */
}
