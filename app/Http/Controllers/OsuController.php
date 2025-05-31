<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\OsuApiService;

class OsuController extends Controller
{
    public function index()
    {
        return view('osu.index');
    }

    public function check(Request $request, OsuApiService $osuApi)
    {
        $request->validate([
            'username' => 'required|string'
        ]);

        $bCount = $osuApi->getBCount($request->username);

        return view('osu.index', [
            'bCount' => $bCount,
            'username' => $request->username
        ]);
    }

    public function show(OsuApiService $osu)
    {
        $user = $osu->getUser('imNotDelta'); // ← ユーザー名は必要に応じて変更可能
        return view('osu.profile', compact('user'));
    }
}
