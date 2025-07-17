<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;

class LandingController extends Controller
{
    public function index()
    {
        if (Session::has('id_user')) {
            return redirect('/dashboard');
        }
        return view('index');
    }
}
