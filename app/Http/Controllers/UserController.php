<?php

namespace App\Http\Controllers;

use App\Models\Ability;
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
        $abilities = Ability::query()->get();
        return view('user.create', compact('types', 'abilities'));
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
            'email' => ['required', 'email:rfc,dns', 'unique:users,email'],
            'name' => ['required', 'min:4'],
            'password' => ['required', 'min:6', 'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/'],
            'type' => ['in:admin,maestro,staff,student'],
        ]);
        $values = $request->all();
        $abilities = Ability::query()->get();
        //return $values;
        $new_user = User::query()->create(['email' => $values['email'], 'name' => $values['name'], 'type' => $values['type'], 'password' => $values['password']]);
        foreach ($abilities as $ability){
            if($request->has($ability->name)){
                $specific_ability = Ability::query()->find($ability->id);
                $new_user->abilities()->save($specific_ability);
            }
        }
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
        $abilities = Ability::query()->get();
        $user_abilities = User::query()->where('id', $id)->first()->abilities;
        $user_abilities_list = [];
        foreach ($user_abilities as $ability){
            $user_abilities_list[] = $ability->id;
        }
        return view('user.edit', compact('user', 'types', 'abilities', 'user_abilities_list'));
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
            'email' => ['required', 'email:rfc,dns', 'unique:users,email,'.$id],
            'name' => ['required', 'min:4'],
            'type' => ['in:admin,maestro,staff,student'],
        ]);
        $values = $request->all();
        // return $values;
        $user = User::find($id);
        $user->name = $values['name'];
        $user->email = $values['email'];
        $user->type = $values['type'];
        $user->save();

        $abilities = Ability::query()->get();
        //return $values;

        $user_abilities = User::query()->where('id', $id)->first()->abilities;
        $user_abilities_list = [];
        foreach ($user_abilities as $ability){
            $user_abilities_list[] = $ability->id;
        }

        foreach ($abilities as $ability){
            $specific_ability = Ability::query()->find($ability->id);
            if($request->has($ability->name)){
                if(!in_array($ability->id,$user_abilities_list)){
                    $user->abilities()->attach($specific_ability);
                }
            }
            else{
                $user->abilities()->detach($specific_ability);
            }
        }
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
