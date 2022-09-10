<?php

namespace App\Http\Controllers;

use App\Models\Bibleverse;
use Illuminate\Http\Request;

class BibleverseController extends Controller
{
    public function index()
    {
        $verse = Bibleverse::inRandomOrder()->first();

        session(['verse' => $verse]);

        return view('verse', ['verse' => $verse]);
    }
}
