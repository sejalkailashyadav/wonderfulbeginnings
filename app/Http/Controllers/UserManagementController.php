<?php

namespace App\Http\Controllers;
use App\Models\UserManagements;
use Illuminate\Http\Request;
use App\Models\CenterManagements;

class UserManagementController extends Controller
{
    
    public function showLogin()
    {
        return view('login'); // Create this file in resources/views/auth/login.blade.php
    }

public function doLogin(Request $request)
{
    $username = $request->input('user_name');
    $password = $request->input('password');

    // Find user by username
    $user = UserManagements::where('user_name', $username)->first();

    // Compare plain text password directly (NOT secure for production!)
    if ($user && $password === $user->password) {
        // Store user session
        session([
            'user_type' => $user->user_type,  // Fix: use correct DB column name
            'user_id' => $user->user_id,
            'center_id' => $user->center_id
        ]);

    $centers = CenterManagements::all();
    $users = UserManagements::all();

    return view('dashboard', compact('centers', 'users'));
    
    }

    // If login fails
    return back()->withErrors(['Invalid login credentials']);
}
public function dashboard()
{
    $centers = CenterManagement::all();
    $users = UserManagements::all();

    return view('index', compact('centers', 'users'));
}

  //  public function loginPage()
    //  {
    //      return view('login');
    //  }

    //  public function doLogin(Request $request)
    //  {
    //      $user = UserManagements::where('user_name', $request->user_name)
    //          ->where('password', $request->password) 
    //          ->first();

    //      if ($user) {
    //          session(['user' => $user]);
    //          return redirect('/dashboard');
    //      }

    //      return redirect('/login')->with('error', 'Invalid Credentials');
    //  }

    //  public function dashboard()
    //  {
    //      $user = session('user');

    //      if (!$user) return redirect('/login');

    //      if ($user->user_type === 'Manager') {
    //          $users = UserManagements::where('center_id', $user->center_id)->get();
    //          $centers = CenterManagements::where('center_id', $user->center_id)->get();
    //      } else {
    //          $users = UserManagements::all();
    //          $centers = CenterManagements::all();
    //      }

    //      return view('dashboard', compact('users', 'centers'));
    //  }

    //  public function logout()
    //  {
    //      session()->flush();
    //      return redirect('/login');
    //  }
 


    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     $users = UserManagements::all();
    //     return view('user_managements.index', compact('users'));
    // }

    // /**
    //  * Show the form for creating a new resource.
    //  */
    // public function create()
    // {
    //     return view('user_managements.create');
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  */
    // public function store(Request $request)
    // {
    //     $validated = $request->validate([
    //         'user_name' => 'required|string|max:255',
    //         'user_type' => 'required',
    //         'user_status' => 'required',
    //     ]);
    //     UserManagements::create($request->all());

    //     return redirect('user-managements')->with('success', 'User created successfully.');
    // }

    // /**
    //  * Display the specified resource.
    //  */
    // public function show(string $id)
    // {
    //     //
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  */
    // public function edit(string $id)
    // {
    //     $user = UserManagements::findOrFail($id);
    //     return view('user_managements.edit', compact('user'));
    // }

    // /**
    //  * Update the specified resource in storage.
    //  */
    // public function update(Request $request, string $id)
    // {
    //     $request->validate([
    //         'user_name' => 'required|string|max:255',
    //         'user_type' => 'required',
    //         'user_status' => 'required',
    //     ]);

    //     $user = UserManagements::findOrFail($id);
    //     $user->update($request->all());

    //     return redirect('user-managements')->with('success', 'User updated successfully.');
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    // public function destroy(string $id)
    // {
    //     $user = UserManagements::findOrFail($id);
    //     $user->delete();

    //     return redirect('user-managements')->with('success', 'User deleted successfully.');
    // }
}
