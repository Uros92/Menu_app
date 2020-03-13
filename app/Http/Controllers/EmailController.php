<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect,Response,DB,Config;
use Mail;
class EmailController extends Controller
{
    /**
     * Send Email after order is completed
     *
     * @param $title
     *
     * @return mixed
     */
    public static function sendEmail($title)
    {
        $data['title'] = $title;

        Mail::send('emails.email', $data, function($message) {

            $message->to('stosicuros12345@gmail.com', 'Uros Stosic')

                ->subject('Mail from menu_app_test');
        });

        // check for failures
        if (Mail::failures()) {
            return 0;
        }

        // otherwise everything is okay ...
        return 1;
    }
}
