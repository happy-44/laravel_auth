<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function index(){
        // Get all admins
        $admins = User::where('role', 'admin')->get();
        return view('admins.index', compact('admins'));
    }

    public function dashboard(){
        // Show the admin creation form
        return view('admins.dashboard');
    }

    public function createAdmin(){
        // Show the admin creation form
        return view('admins.createAdmin');
    }

    public function admindashboard(){
        // Show the admin creation form
        return view('admins.admindashboard');
    }

    public function create(){
        // Show the admin creation form
        return view('admins.create');
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);
        $file = $request->file('photo') ;
        $filename = time().".".$file->getClientOriginalExtension();
        $storepath = $file->storeAs('public/uploads',$filename);

        // Create a new admin
        $admin = new User();
        $admin->name = $validatedData['name'];
        $admin->email = $validatedData['email'];
        $admin->password = bcrypt($validatedData['password']);
        $admin->role = 'admin';
        $admin->phone = $request->phone;
        $admin->address = $request->address;
        $admin->photo = $filename;
        $admin->save();
        return redirect()->route('admins.index')->with('success', 'Admin created successfully');
    }

    public function registerAdmin(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);
        $file = $request->file('photo') ;
        $filename = time().".".$file->getClientOriginalExtension();
        $storepath = $file->storeAs('public/uploads',$filename);

        // Create a new admin
        $admin = new User();
        $admin->name = $validatedData['name'];
        $admin->email = $validatedData['email'];
        $admin->password = bcrypt($validatedData['password']);
        $admin->phone = $request->phone;
        $admin->address = $request->address;
        $admin->photo = $filename;
        $admin->role = 'admin';
        $admin->save();
        return redirect()->route('users.adminViewIndex')->with('success', 'Admin created successfully');
    }

    public function edit($id){
        $user = User::find($id);
        if(is_null($user)){
            return redirect('admins/view');
        }else{
            return view('admins.edit', compact('user'));
        }
    }

    public function adminEdit($id){
        $user = User::find($id);
        if(is_null($user)){
            return redirect('admins/view');
        }else{
            // $url = url('/admins/update')."/".$id;
            // $title = "Update Admin Details";
            // $data = compact('user');
            return view('users.updateAdmin', compact('user'));
        }
    }

    public function update(Request $request, $id){
        $user = User::find($id);
        // Update the user details
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->phone = $request->phone;
        $user->address = $request->address;

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . "." . $file->getClientOriginalExtension();
            $storepath = $file->storeAs('public/uploads', $filename);
            $user->photo = $filename;
        }
        $user->save();
        return redirect()->route('admins.index')->with('success', 'Admin updated successfully');
    }

    public function adminUpdate(Request $request, $id){
        $user = User::find($id);
        // Update the admin details
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->phone = $request->phone;
        $user->address = $request->address;

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . "." . $file->getClientOriginalExtension();
            $storepath = $file->storeAs('public/uploads', $filename);
            $user->photo = $filename;
        }
        $user->save();
        return redirect()->route('users.adminViewIndex')->with('success', 'Admin updated successfully');
    }

    public function destroy($id){
        $user = User::find($id);
        if(!is_null($user)){
            $user->delete();
        }
        return redirect('admins/view')->with('message','Data Deleted successfully');
    }

    public function adminDelete($id){
        $user = User::find($id);
        if(!is_null($user)){
            $user->delete();
        }
        return redirect('admin/view')->with('message','Data Deleted successfully');
    }
}
