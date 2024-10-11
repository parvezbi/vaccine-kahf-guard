<?php

namespace App\Http\Controllers;

use App\Http\Requests\VaccineRequest;
use App\Models\ScheduledVaccination;
use App\Models\User;
use App\Models\VaccineCenter;
use App\Services\VaccinationService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class VaccineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('welcome');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function registration()
    {
        $vaccineCenters = VaccineCenter::all();
        return view('registration', compact('vaccineCenters'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VaccineRequest $request, VaccinationService $vaccinationService)
    {

        Log::info($request->all());
        // user-create
        $user = User::create($request->all());

        // get-user-details
        $userDetails = User::where('nid', $request->nid)->first();

        // create-schedule
        $schedule = $vaccinationService->createSchedule($userDetails, $request->vaccine_center_id);

        return redirect()->route('vaccine.success')->with('success', 'Registration successful');
    }

    public function success()
    {
        return view('success');
    }

    /**
     * Display the specified resource.
     */
    public function vaccineRegistrationCheck(Request $request)
    {
        $nid = $request->input('nid');
        $user = User::where('nid', $nid)->first();

        if (!$user) {
            return redirect()->route('welcome')->with('status', 'Not registered');
        }

        $schedule = ScheduledVaccination::where('user_id', $user->id)->first();

        if (!$schedule) {
            return redirect()->route('welcome')->with('status', 'Not scheduled');
        }

        // Convert 'vaccine_date' to a Carbon instance
        $vaccineDate = Carbon::parse($schedule->vaccine_date);

        // Determine if the user has been vaccinated
        $vaccineStatus = $vaccineDate->isPast() ? 'Vaccinated' : 'Scheduled';

        return redirect()->route('welcome')
            ->with('status', $vaccineStatus)
            ->with('user', $user)
            ->with('schedule', $schedule);
    }
}
