<?php

namespace App\Listeners;

use App\Events\SendCustomer;
use App\Events\PodcastProcessed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\customer;
use Mail;
use DB;

class SendCustomerFired
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\SendCustomer  $event
     * @return void
     */
    public function handle(SendCustomer $event)
    {
       $customers = $event->customers;
       $customers = customer::where('id',$event->customers->id)->first();

        Mail::send( 'email.user_notification', ['fist_name' => $customers->fist_name, 'last_name' => $customers->last_name, 'phone_number' => $customers->phone_number], function($message) use ($customers) {
            $message->from('admin@gmail.com');
            $message->to(DB::table('customers')->orderBy("customers.created_at", "DESC")->pluck('customers.email')->first()); 
            $message->subject('Thank you');
            $message->attach(public_path('/folder/thank_you.jpg'));
        });
    }
}
