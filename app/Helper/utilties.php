<?php
use Illuminate\Support\Facades\Mail;
if (! function_exists('sendMail')) {
	function sendMail($template, $to, $subject, $data){
        info('trace email issue');
        info($subject);
        info($to);
		Mail::send($template, $data->toArray(), function($message) use($to, $subject){
            $message->subject($subject);
            $message->to($to);
        });
	}
}