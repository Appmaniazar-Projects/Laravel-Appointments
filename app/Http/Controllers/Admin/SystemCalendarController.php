<?php

namespace App\Http\Controllers\Admin;

use App\Appointment;
use App\Http\Controllers\Controller;

class SystemCalendarController extends Controller
{

    public function index()
    {
        $events = [];

        $appointments = Appointment::with(['client','services'])->get();
    
        foreach ($appointments as $appointment) {
            if (!$appointment->start_time) {
                continue;
            }

            $events[] = [
                'title' => $appointment->client->name ,
                'name' => $appointment->name,
                'start' => $appointment->start_time,
                'capacity' =>$appointment->capacity,
                'road_closure' => $appointment->services, 
                'end' => $appointment->finish_time,
                'url'   => route('admin.appointments.show', $appointment->id),
            ];
        }

        return view('admin.calendar.calendar', compact('events'));
    }
}
