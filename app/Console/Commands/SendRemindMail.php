<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\RemindMail;
use App\Models\Booking;
use Illuminate\Support\Facades\Log;

class SendRemindMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:Reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send remind email on the booking date at 9:00';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $today = date('Y-m-d');
        $bookings = Booking::where('date', '2022-03-17')
        ->with('user:id,name,email','shop:id,name')
        ->get();
        foreach($bookings as $booking){
            Log::info($booking);
            Mail::to($booking->user->email)
                ->send(new RemindMail($booking));
        }
    }
}
