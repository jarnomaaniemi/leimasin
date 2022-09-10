<?php

namespace App\Http\Controllers;

use App\Models\Timestamp;
use Illuminate\Http\Request;

class TimestampController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'message' => 'required|string',
            'remote-ip' => 'required|ip',
            'user-agent' => 'required|string'
        ]);

        $validated['unix-time'] = time();

        Timestamp::create($validated);

        return redirect('/')->with('status', 'Leimaus onnistui!');
    }
}
