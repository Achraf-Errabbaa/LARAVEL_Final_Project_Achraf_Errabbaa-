<?php

namespace App\Http\Controllers;

use App\Models\Classmodel;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function index()
    {
        return view('coach.calendar');
    }
    public function create()
    {
        //

        $events = Classmodel::all();

        $events = $events->map(function ($e) {
            return [
                "start" => $e->start,
                "end" => $e->end,
                "color" => "#fcc102",
                "passed" => false,
                "title" => $e->name
            ];
        });

        return response()->json([
            "events" => $events
        ]);
    }

  
}
