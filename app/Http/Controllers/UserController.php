<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('id', '>' ,-1)->paginate(5);
        return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = ['admin', 'maestro', 'staff', 'student'];
        return view('user.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = $request->validate([
            'email' => ['required', 'email:rfc,dns'],
            'name' => ['required', 'min:4'],
            'password' => ['required', 'min:6', 'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/'],
            'type' => ['in:admin,maestro,staff,student'],
        ]);
        $values = $request->all();
        // return $values;
        User::query()->create(['email' => $values['email'], 'name' => $values['name'], 'type' => $values['type'], 'password' => $values['password']]);
        return redirect('/users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::query()->where('id', $id)->get();
        return view('user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::query()->where('id', $id)->get();
        $types = ['admin', 'maestro', 'staff', 'student'];
        return view('user.edit', compact('user', 'types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validation = $request->validate([
            'email' => ['required', 'email:rfc,dns'],
            'name' => ['required', 'min:4'],
            'type' => ['in:admin,maestro,staff,student'],
        ]);
        $values = $request->all();
        $user = User::find($id);
        $user->name = $values['name'];
        $user->email = $values['email'];
        $user->type = $values['type'];
        $user->save();
        return redirect('/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res = User::query()->where('id', $id)->delete();
        $users = User::all();
        // which one is correct?
        return redirect('/users');
        return view('user.index', compact('users'));
    }
}
