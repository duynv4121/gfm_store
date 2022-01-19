<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mail;

class contactController extends Controller
{
    public function send_mail(Request $request)
    {
        $data = $request->all();
        
        Mail::send('sendmail.contact', $data, function ($message) use ($data) {
            $message->from($data['email'], $data['name']);
            $message->to('duynv41201@gmail.com', 'Green Farm Mart');
            $message->subject('Đóng góp ý kiến từ khách hàng');
        });
    }
}
