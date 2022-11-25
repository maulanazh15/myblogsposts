<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.profile.index', [
            'user' => auth()->user()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {
        $valid = $request->validate([
            'image' => 'image|file|max:5024|mimes:jpg,png'
        ]);
        if($request->file('image')){
            if($request->oldImage){Storage::delete($user->image);}
            
            $valid['image']  = $request->file('image')->store('user-images');
        }
        
        User::where('id', auth()->user()->id)->update($valid);

        return redirect()->back()->with('pesan','Gambar berhasil diupload');
    }

    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $rules = [
            'name' => 'required|max:255',
            'username' => ['required','min:3','max:255','unique:users'],
            'email' => 'required|email:dns|unique:users'
        ];
        $user = auth()->user();

        if ($user->email == $request->email) {
            unset($rules['email']);
        } 

        if ($user->username == $request->username) {
            unset($rules['username']);
        }

        $validated = $request->validate($rules);

        User::where('id', auth()->user()->id)->update($validated);

        return redirect()->back()->with('pesan','Profil berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
