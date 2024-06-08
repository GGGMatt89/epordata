<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Offer;
use App\Models\Info;
use App\Models\User;
use App\Models\LastUpdate;
use Auth;
use Carbon\Carbon;
// use App\Mail\ScheduleMail;
// use App\Mail\ContactMail;
// use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $timenow = Carbon::now();
        $news = News::all();
        $offers = Offer::all();
        $infos = Info::all();
        $lastup = LastUpdate::all()->sortByDesc('last_update')->first();
        if (isset($lastup)) {
            $maxdate = $lastup->last_update;
        } else {
            $maxdate = $timenow;
        }
        if (!$news->isEmpty()) {
            $maxnews = $news->sortByDesc('updated_at')->first()->updated_at;
        } else {
            $maxnews = $maxdate;
        }
        if (!$offers->isEmpty()) {
            $maxoffer = $offers->sortByDesc('updated_at')->first()->updated_at;
        } else {
            $maxoffer = $maxdate;
        }
        if (!$infos->isEmpty()) {
            $maxinfo = $infos->sortByDesc('updated_at')->first()->updated_at;
        } else {
            $maxinfo = $maxdate;
        }
        if ($maxoffer > $maxinfo) {
            $maxdate = $maxoffer;
        } else {
            $maxdate = $maxinfo;
        }
        if ($maxnews > $maxdate) {
            $maxdate = $maxnews;
        }
        if (!$offers->isEmpty() || !$infos->isEmpty() || !$news->isEmpty()) {
            if (isset($lastup)) {
                if ($maxdate > $lastup->last_update) {
                    LastUpdate::firstOrCreate(['last_update' => $maxdate]);
                }
            } else {
                LastUpdate::firstOrCreate(['last_update' => $maxdate]);
            }
        } else {
            if (!isset($lastup)) {
                LastUpdate::firstOrCreate(['last_update' => $maxdate]);
            }
        }
        $today = Carbon::today('UTC');
        $nextDays = Carbon::today('UTC')->addDays(3);
        $Nmeeting = 0;
        $future_meetings = [];
        if (Auth::check()) {
            $meetings = Auth::user()->meetings->sortBy('scheduled_at');
            foreach ($meetings as $meeting) {
                $date = Carbon::parse($meeting->scheduled_at);
                if ($date->between($today, $nextDays)) {
                    array_push($future_meetings, $date);
                }
            }
            $Nmeeting = count($future_meetings);
        }
        $news_selected = News::whereDate('date', '<=', $today)->get();
        $offers_selected = Offer::whereDate('expiration', '>=', $today)->get();
        $loader = true;
        if (request()->exists('loader')) {
            $loader = request('loader');
        }
        return view('homepage', ['loader' => $loader, 'news_all' => $news_selected, 'offers' => $offers_selected, 'infos' => $infos, 'maxdate' => $maxdate, 'Nmeeting' => $Nmeeting]);
        // return view('homepage'); #, ['loader' => $loader, 'news_all' => $news_selected, 'offers' => $offers_selected, 'infos' => $infos, 'maxdate' => $maxdate, 'Nmeeting' => $Nmeeting]);
    }
    // public function dailyMail()
    // {
    //     $users = User::all();
    //     $meetings = null;
    //     $list = [];
    //     foreach ($users as $user) {
    //         $meetings = $user->meetings()->whereDate('scheduled_at', Carbon::today())->get(['cust_surname', 'cust_name',  'scheduled_at', 'meet_address']);
    //         if ($meetings->count() > 0) {
    //             // $this->info($user->email);
    //             // $this->info($meetings);
    //             foreach ($meetings as $meeting) {
    //                 array_push($list, 'Ore ' . Carbon::parse($meeting->scheduled_at)->format('H:i') . ' presso ' . $meeting->cust_surname . ' ' . $meeting->cust_name . ' in ' . $meeting->meet_address);
    //             }
    //             // $this->info(implode(' - ', $list));
    //             Mail::to($user->email)
    //                 ->send(new ScheduleMail($list));
    //             $list = [];
    //         }
    //     }
    //     return 'Task executed';
    // }
    // public function contactMe()
    // {
    //     if (request()->has('name') && request()->has('email') && request()->has('message')) {
    //         $name = request()->input('name');
    //         $email_address = request()->input('email');
    //         if (request()->has('phone')) {
    //             $phone = request()->input('phone');
    //         }
    //         $message = request()->input('message');
    //         // Create the email and send the message
    //         $receiver = 'info@epordata.it'; // Add your email address inbetween the '' replacing yourname@yourdomain.com - This is where the form will send a message to.
    //         $email_subject = "Website Contact Form:  $name";
    //         $email_body = "Avete ricevuto un nuovo messaggio dal form di contatto online del sito.\n\n" . "Qui i dettagli:\n\nNome: $name\n\nEmail: $email_address\n\nTelefono: $phone\n\nMessaggio:\n$message";
    //         Mail::to($receiver)
    //                 ->send(new ContactMail($email_subject, $email_body));
    //         return response()->json(['result' => true, 'name' => $name, 'email' => $email_subject, 'body' => $email_body]);
    //     } else {
    //         return response()->json(['result' => false]);
    //     }
    // }
}
