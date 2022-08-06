<?php

namespace App\Http\Controllers;

use App\Models\Ability;
use App\Models\MaestroAbility;
use App\Models\User;
use Illuminate\Http\Request;

class AbilityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $abilities = Ability::query()->paginate(5);
        return view('ability.index', compact('abilities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ability.create');
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
            'ability' => ['required'],
        ]);
        $values = $request->all();
        $ability_name = $values['ability'];

        Ability::query()->create([
            'name' => $ability_name,
        ]);

        return redirect('/ability');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ability = Ability::query()->where('id', $id)->get()->first();
        return view('ability.show', compact('ability'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ability = Ability::query()->where('id', $id)->get()->first();
        return view('ability.edit', compact('ability'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $validation = $request->validate([
            'name' => ['required'],
        ]);
        $values = $request->all();
        $ability = Ability::find($id);
        $ability->name = $values['name'];
        $ability->save();
        return redirect('/ability');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res = Ability::query()->where('id', $id)->delete();
        return redirect('/ability');
    }
}
