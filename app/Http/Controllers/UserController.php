<?php
/**
 * Created by PhpStorm.
 * User: mehmet
 * Date: 11/11/2023
 * Time: 21:11
 */

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Str;

class UserController extends Controller
{
    public function index() {
        $users = User::orderBy('created_at', 'DESC')->get();
        return view('users/index', compact('users'));
    }

    public function show($id) {
        $user = User::findOrFail($id);
        return view('users/show', compact('user'));
    }

    public function edit($id) {
        $user = User::findOrFail($id);
        return view('users/edit', compact('user'));
    }

    public function update($id, Request $request) {
        $user = User::findOrFail($id);

        if(!empty($request->file('photo'))){
            if(!empty($user->photo) && file_exists('upload/'.$user->photo)) {
                unlink('upload/'.$user->photo);
            }

            $file = $request->file('photo');
            $randomStr = Str::random(30);
            $fileName = $randomStr.'.'.$file->getClientOriginalExtension();
            $file->move('upload/',$fileName);
            $user->photo = $fileName;
        }

        $user->update($request->all());

        return redirect()->route('users')->with('success', 'User updated successfully');
    }

    public function destroy($id) {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users')->with('success', 'User deleted successfully');
    }

    public function trashed() {
        $users = User::whereNotNull('deleted_at')->get();

        return view('users/trashed', compact('users'));
    }

    public function restore($id) {
        $user = User::findOrFail($id);
        $user->updated_at = date('Y-m-d h:s:i');
        $user->deleted_at = NULL;
        $user->save();

        return redirect()->route('users')->with('success', 'User restore successfully');
    }

    public function delete($id) {
        $user = User::findOrFail($id);
        $user->updated_at = date('Y-m-d h:s:i');
        $user->deleted_at = date('Y-m-d h:s:i');
        $user->save();

        return redirect()->route('users')->with('success', 'User permanently deleted successfully');
    }
}