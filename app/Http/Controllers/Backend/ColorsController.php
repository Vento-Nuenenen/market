<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Http\Request;

class ColorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     *
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        if ($request->input('search') == null) {
            $colors = Color::all();
        } else {
            $search_string = $request->input('search');
            $colors = Color::where('name', 'LIKE', "%$search_string%")
                ->orWhere('slug', 'LIKE', "%$search_string%")
                ->orWhere('hex_code', 'LIKE', "%$search_string%")->get();
        }

        return view('backend.colors.index', ['colors' => $colors]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View|Factory|Application
    {
        return view('backend.colors.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $scout_name = $request->input('scoutname');
        $first_name = $request->input('firstname');
        $last_name = $request->input('lastname');
        $email = $request->input('email');

        $password = $request->input('password');
        $password_repeat = $request->input('password_repeat');

        if ($password != null && $password === $password_repeat) {
            $password = Hash::make($password);
            $password_repeat = null;

            User::create([
                'scoutname' => $scout_name,
                'firstname' => $first_name,
                'lastname' => $last_name,
                'email' => $email,
                'password' => $password,
            ]);

            return redirect()->back()->with('message', 'Benutzer wurde erstellt.');
        } else {
            return redirect()->back()->with('error', 'Passwort wurde nicht korrekt wiederholt!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($uid): View|Factory|Application
    {
        $user = User::find($uid);

        return view('backend.users.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $uid): RedirectResponse
    {
        $scout_name = $request->input('scoutname');
        $first_name = $request->input('firstname');
        $last_name = $request->input('lastname');
        $email = $request->input('email');

        $password = $request->input('password');
        $password_repeat = $request->input('password_repeat');

        if ($password != null && $password === $password_repeat) {
            $password = Hash::make($password);
            $password_repeat = null;

            User::find($uid)->update([
                'scoutname' => $scout_name,
                'firstname' => $first_name,
                'lastname' => $last_name,
                'email' => $email,
                'password' => $password,
            ]);

            return redirect()->back()->with('message', 'Benutzer wurde aktualisiert.');
        } elseif ($password == null) {
            User::find($uid)->update([
                'scoutname' => $scout_name,
                'firstname' => $first_name,
                'lastname' => $last_name,
                'email' => $email,
            ]);

            return redirect()->back()->with('message', 'Benutzer wurde aktualisiert. Das Passwort wurde beibehalten!');
        } else {
            return redirect()->back()->with('error', 'Passwort wurde nicht korrekt wiederholt!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($uid): RedirectResponse
    {
        User::destroy($uid);

        return redirect()->back()->with('message', 'Benutzer erfolgreich gelöscht.');
    }
}
