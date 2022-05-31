<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingsController extends Controller
{
    public function resetPassword(Request $req)
    {
        $username = session('username');
        $newPass = $req->input('newPass');
        $existing = $req->input('existing');
        $stored = DB::select('SELECT passwd FROM users WHERE username = ?', [$username]);
        $stored = $stored[0]->passwd;
        if ($stored == $existing)
        {
            DB::update('UPDATE users SET passwd = ? WHERE username = ?', [$newPass, $username]);
            return response()->json(["message"=>"Password updated Successfully", "redirectURL"=>"/home"]);
        }
        else
        {
            return response()->json(["message"=>"The existing password is incorrect", "redirectURL"=>""]);
        }
    }

    public function resetEmail(Request $req)
    {
        $username = session('username');
        $newEmail = $req->input('newEmail');
        DB::update('UPDATE users SET email = ? WHERE username = ?', [$newEmail, $username]);
        return response()->json(["message"=>"Email updated Successfully", "redirectURL"=>"/home"]);
    }

    public function deleteAccount(Request $req)
    {
        $username = session('username');
        DB::delete('DELETE FROM movielist WHERE username = ?', [$username]);
        DB::delete('DELETE FROM animelist WHERE username = ?', [$username]);
        DB::delete('DELETE FROM booklist WHERE username = ?', [$username]);
        DB::delete('DELETE FROM user_genres WHERE username = ?', [$username]);
        DB::delete('DELETE FROM users WHERE username = ?', [$username]);
        session()->flush();
        return response()->json(["message"=>"Account deleted Successfully", "redirectURL"=>"/"]);
    }
}
