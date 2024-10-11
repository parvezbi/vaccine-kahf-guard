<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\VaccineCenter;
use App\Models\ScheduledVaccination;
use App\Models\User;
use App\Models\EmailNotification;
class VaccinationService
{
    public function createSchedule(User $user, $vaccineCenterId)
    {
        //vaccination-date
        $vaccineDate = $this->getAvailableVaccinationDate(now(), $vaccineCenterId);

        // Create-schedule
        $schedule = ScheduledVaccination::create([
            'user_id' => $user->id,
            'vaccine_center_id' => $vaccineCenterId,
            'vaccine_date' => $vaccineDate,
            'status' => 3,
        ]);

        return $schedule;
    }

    public function saveVaccineNotification($user){
        EmailNotification::create([
            'user_id' => $user->id,
            'email' => $user->user->email,
            'subject' => "Hello {$user->user->name}, your vaccine notification.",
            'message' => 'This is a reminder that your vaccination is scheduled for tomorrow, '.Carbon::parse($user->vaccine_date)->format('l, F j, Y').'.',
        ]);
    }

    public function getAvailableVaccinationDate($createdAt, $vaccineCenterId)
    {
        $vaccineCenter = VaccineCenter::findOrFail($vaccineCenterId);
        $centerDailyLimit = $vaccineCenter->daily_limit;
        $date = Carbon::parse($createdAt)->addDay();

        do {
            if ($date->dayOfWeek === Carbon::FRIDAY || $date->dayOfWeek === Carbon::SATURDAY) {
                $date->next(Carbon::SUNDAY);
                continue;
            }

            $totalRegistered = ScheduledVaccination::where('vaccine_center_id', $vaccineCenterId)
                ->whereDate('vaccine_date', $date)
                ->count();

            if ($totalRegistered < $centerDailyLimit) {
                break;
            }

            $date->addDay();
        } while (true);

        return $date;
    }
}
