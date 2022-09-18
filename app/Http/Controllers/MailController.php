<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Mail\TestMail;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
public function sendMail()
{
$detail=
[
'title'=>'Test Email',
'body'=>'This email is sending just for testing purposes',
];
Mail::to("jamshedkpk@hotmail.com")->send(new TestMail($detail));
return "Email Send Successfully";
}
}
