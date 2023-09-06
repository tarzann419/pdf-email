<?php

namespace App\Http\Controllers;

use App\Mail\MailExample;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;

class PdfEmailController extends Controller
{
    public function index(){
        $data['email'] = "your@mail.com";
        $data['title'] = "A Special Title";
        $data['body'] = "THis is about how this tuttorial was formed, performed and achieved";

        $pdf = PDF::loadView('emails.test_mail', $data);
        $data['pdf'] = $pdf;

        Mail::to($data['email'])->send(new MailExample($data));

        dd('MAil sent successfully');
    }
}
