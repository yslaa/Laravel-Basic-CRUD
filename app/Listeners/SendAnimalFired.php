<?php

namespace App\Listeners;

use App\Events\SendAnimal;
use App\Events\PodcastProcessed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\animal;
use Mail;
use DB;

class SendAnimalFired
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
     * @param  \App\Events\SendAnimal  $event
     * @return void
     */
    public function handle(SendAnimal $event)
    {
       $animals = $event->animal;
       $animals = animal::where('id',$event->animals->id)->first();

        Mail::send( 'email.user_notification', ['animal_name' => $animals->animal_name, 'animal_type' => $animals->animal_type, 'age' => $animals->age, 'gender' => $animals->gender], function($message) use ($animals) {
            $message->from('admin@gmail.com');
            $message->to('user@gmail.com');
            // $message->to(DB::table('customer')->leftJoin('users', 'users.id', '=', 'animal.user_id')->orderBy("animal.created_at", "DESC")->pluck('users.email')->first()); 
            //future purposes
            $message->subject('Thank you');
            $message->attach(public_path('/folder/thank_you.jpg'));
        });
    }
}
