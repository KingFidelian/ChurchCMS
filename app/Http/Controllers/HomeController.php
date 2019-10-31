<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Member;
use App\Conference;
use App\Expense;
use App\Income;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members = Member::orderBy('bday', 'desc')->take(3)->get();
        $conferences = Conference::orderBy('date_of_conference', 'asc')->take(3)->get();
        $expenses = Expense::orderBy('date_received', 'desc')->take(5)->get();

        $user_id = auth()->user()->id;
        $user = User::find($user_id);

        return view('home')->with('sermons', $user->sermons)
                           ->with('members', $members)
                           ->with('conferences', $conferences)
                           ->with('expenses', $expenses);
    }
}