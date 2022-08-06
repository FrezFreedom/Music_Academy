<?php

namespace App\Http\Controllers;

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
        $abilities = MaestroAbility::query()->where('id', '>' ,-1)->paginate(5);
        $users = User::all();
        $user_names = [];
        foreach ($users as $user){
            $user_names[$user->id] = $user->name;
        }
        return view('ability.index', compact('abilities', 'user_names'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $maestros = User::query()->where('type', 'maestro')->get();
        return view('ability.create', compact('maestros'));
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
            'abilities' => ['required'],
        ]);
        $values = $request->all();
        $maestro_id = $values['maestro'];
        $abilities = $values['abilities'];
        $abilities = explode(' ', $abilities);
        foreach ($abilities as $ability){
            MaestroAbility::query()->create([
                'maestro_id' => $maestro_id,
                'ability' => $ability,
            ]);
        }
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
        $ability = MaestroAbility::query()->where('id', $id)->get();
        $name = User::query()->where('id', $ability[0]->maestro_id)->get()[0]->name;
        return view('ability.show', compact('ability', 'name'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $maestro = MaestroAbility::query()->where('id', $id)->get()[0];
        $name = User::query()->where('id', $maestro->maestro_id)->get()[0]->name;
        return view('ability.edit', compact('maestro', 'name'));
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
            'ability' => ['required'],
        ]);
        $values = $request->all();
        $maestro_ability = MaestroAbility::find($id);
        $maestro_ability->ability = $values['ability'];
        $maestro_ability->save();
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
        $res = MaestroAbility::query()->where('id', $id)->delete();
        return redirect('/users');
    }
}
