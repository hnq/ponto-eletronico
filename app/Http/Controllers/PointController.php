<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Point;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PointController extends Controller
{
    public function index()
    {
        return view('point.index');
    }

    public function create()
    {
        return view('points.create'); 
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        Point::create([
            'user_id' => $user->id,
            'registered_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Ponto registrado com sucesso!');
    }

    public function adminIndex(Request $request)
    {
        $from = $request->input('from');
        $to   = $request->input('to');

        $points = Point::with(['user.manager'])
            ->when($from, fn($q) => $q->where('registered_at', '>=', Carbon::parse($from)->startOfDay()))
            ->when($to,   fn($q) => $q->where('registered_at', '<=', Carbon::parse($to)->endOfDay()))
            ->orderBy('registered_at', 'desc')
            ->get();

        return view('points.index', compact('points', 'from', 'to'));
    }
}
