<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\MessageTestMail;

class MessageTestController extends Controller
{
    /**
     * 
     */
    public function send()
    {
        Mail::to('jadersonrilidio@gmail.com')->send(new MessageTestMail());
        return '
                <h2> Mail sent </h2>
                <ul>
                    <li><a href="/">Return to index</a></li>
                    <li><a href="'.route('home').'">Home</a></li>
                </ul>';
    }


}
