<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function create(){
        // Show the user creation form
        // $user = new User;
        // $method = "POST";
        // $url = url('/users/new');
        // $title = "User Registration"; 
        // $data = compact('url','title','user','method');
        return view('users.create');
    }

    public function userdashboard(){
        return view('users.user');
    }

    public function show(){
        $userId = Auth::id();
        $user = User::find($userId);
        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }
        return view('users.userProfile', compact('user'));
    }

    public function adminCreate(){
        return view('users.adminUser');
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

        // Create a new user
        $user = new User();
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->password = bcrypt($validatedData['password']);
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->photo = $filename;
        $user->role = 'user';
        $user->save();
        return redirect()->route('users.index1')->with('success', 'User created successfully');
    }

    public function adminStore(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);
        $file = $request->file('photo') ;
        $filename = time().".".$file->getClientOriginalExtension();
        $storepath = $file->storeAs('public/uploads',$filename);

        // Create a new user
        $user = new User();
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->password = bcrypt($validatedData['password']);
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->photo = $filename;
        $user->role = 'user';
        $user->save();
        return redirect()->route('users.adminIndex')->with('success', 'User created successfully');
    }

    public function userIndex(){
        // Get all users
        $users = User::where('role', 'user')->get();
        return view('users.index', compact('users'));
    }

    public function index(){
        // Get all users
        $users = User::where('role', 'user')->get();
        return view('users.usersView', compact('users'));
    }

    public function adminViewIndex(){
        // Get all admins
        $admins = User::where('role', 'admin')->get();
        return view('users.adminView', compact('admins'));
    }

    public function superAdminViewIndex(){
        // Get all superadmins
        $users = User::where('role', 'superadmin')->get();
        return view('users.superAdminView', compact('users'));
    }

    public function edit($id){
        $user = User::find($id);
        if(is_null($user)){
            return redirect('users/view');
        }else{
            return view('users.edit',compact('user'));
        }
    }

    public function userEdit($id){
        $user = User::find($id);
        if(is_null($user)){
            return redirect('users/view');
        }else{
            return view('users.updateUser',compact('user'));
        }
    }

    public function update(Request $request, $id){
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
        return redirect()->route('users.index1')->with('success', 'User updated successfully');
    }

    public function userUpdate(Request $request, $id){
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
        return redirect()->route('users.adminIndex')->with('success', 'User updated successfully');
    }

    public function destroy($id){
        $user = User::find($id);
        if(!is_null($user)){
            $user->delete();
        }
        return redirect()->route('users.index1')->with('success', 'User deleted successfully');
    }

    public function delete($id){
        $user = User::find($id);
        if(!is_null($user)){
            $user->delete();
        }
        return redirect()->route('users.adminIndex')->with('success', 'User deleted successfully');
    }
}
