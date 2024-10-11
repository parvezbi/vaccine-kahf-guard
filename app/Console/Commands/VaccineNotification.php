<?php

namespace App\Console\Commands;

use App\Models\ScheduledVaccination;
use App\Services\VaccinationService;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class VaccineNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:vaccine-notification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email notification before vaccine date';

    /**
     * Execute the console command.
     */
    public function handle(VaccinationService $vaccinationService)
    {
        $users = ScheduledVaccination::whereDate('vaccine_date', now()->addDay())->get();
        Log::info($users);
        Log::info('Found ' . $users->count() . ' users with vaccine scheduled for tomorrow.');
        foreach ($users as $user) {
            Log::info($user->user->email);
            $subject = "Hello {$user->user->name}, your vaccine notification.";
            $body = "Dear {$user->user->name},\n\n";
            $body .= "This is a reminder that your vaccination is scheduled for tomorrow, ";
            $body .= Carbon::parse($user->vaccine_date)->format('l, F j, Y') . ".\n\n";
            $body .= "Vaccination Center: {$user->vaccineCenter->name}\n\n";
            $body .= "Please remember to bring your nid and any required documents.\n\n";
            $body .= "Stay safe and healthy!\n";
        $body .= "Vaccine Management Team";

        Mail::raw($body, function ($message) use ($user, $subject) {
            $message->to($user->user->email)
                    ->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
                    ->subject($subject);
        });

            $vaccinationService->saveVaccineNotification($user);
            Log::info('Vaccine notification email sent successfully to ' . $user->user->email);
        }

    }
}
