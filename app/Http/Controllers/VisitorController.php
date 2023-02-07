<?php

namespace App\Http\Controllers;

use App\Models\VisitHistory;
use Illuminate\Http\Request;

class VisitorController extends Controller
{
    public function store(Request $request)
    {
        $visitor = VisitHistory::where('session_id', ($request->session()->getId()))->get();
        if(count($visitor) == 0) {
            $visitor = new VisitHistory();
            $visitor->session_id = $request->session()->getId();
            $visitor->save();
        }
    }
}
