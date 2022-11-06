<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     *
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        if ($request->input('search') == null) {
            $users = User::all();
        } else {
            $search_string = $request->input('search');
            $users = User::where('scoutname', 'LIKE', "%$search_string%")
                ->orWhere('firstname', 'LIKE', "%$search_string%")
                ->orWhere('lastname', 'LIKE', "%$search_string%")->get();
        }

        return view('backend.users.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        return view('backend.users.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return RedirectResponse
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
     *
     * @param $uid
     * @return Application|Factory|View
     */
    public function edit($uid): View|Factory|Application
    {
        $user = User::find($uid);

        return view('backend.users.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param    $uid
     * @return RedirectResponse
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
     *
     * @param $uid
     * @return RedirectResponse
     */
    public function destroy($uid): RedirectResponse
    {
        User::destroy($uid);

        return redirect()->back()->with('message', 'Benutzer erfolgreich gelöscht.');
    }
}
