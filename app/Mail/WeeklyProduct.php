<?php

namespace App\Mail;

use App\Product;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WeeklyProduct extends Mailable
{
    use Queueable, SerializesModels;

    public $productID;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($productID)
    {
        $this->productID = $productID;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $users = User::all();
        $newUsers = array();
        foreach ($users as $user) 
            {
                $newUsers[] = array($user->email);
            }
        $singleUsers = call_user_func_array('array_merge', $newUsers);  
                $emails = implode("','", $singleUsers);  
                $newEmail = "'".$emails."'";
                $kkk = $newEmail;
                $array = array($kkk);
                // dd($array);
        // dd($singleUsers);
        return $this->bcc($singleUsers)
                    ->bcc('info@anexon.org')
                    ->subject('Anexon Global Ventures - Product of the week')
                    ->view('emails.products.weekly-product');
    }
}
