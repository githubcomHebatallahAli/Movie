<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function createAdmin(CreateAdminRequest $request)
    {
      $user=User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>$request->password,
            // 'age'=>$request->age,
            'type'=>$request->type
        ]);
        if($user){
            $admin =Admin::create ([
                'salary' => $request->salary ,
                'user_id' => $request->user_id,
            ]);
            $admin->users()->associate($user);
            $admin->save();
            // return $admin;
            return response()->json([
                'admin' => $admin,
                'message' => "Admin Created Successfully."
            ], 200);
            }

        }

        public function sendEmail(Request $request)
        {
        Mail::to($user->email)->send(new WelcomeMail($user));
        return $user;
        }

        public function editAdmin(string $id)
        {
            $user = User::find($id);
            return $user;
        }

        public function updateAdmin(Request $request, string $id)
        {
            $user=User::findOrFail($id);
            // $user->update([
            //     'name'=>$request->name,
            //     'email'=>$request->email,
            //     'password'=>$request->password,
            //     'age'=>$request->age,
            //     'type'=>$request->type
            // ]);
            // if($user){
                $admin =Admin::update ([
                    'salary' => $request->salary ,
                    'user_id' => $request->user_id,
                ]);
                // $admin->users()->associate($user);
                $admin->save();
                // return $admin;
                return response()->json([
                    'admin' => $admin,
                    'message' => "Admin Created Successfully."
                ], 200);
                }

    

    public function destroyAdmin(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return $user;
    }

        public function showDeletedAdmin(){
            $users=User::onlyTrashed()->get();
            return $users;

    }

        public function restoreAdmin(string $id){
            User::withTrashed()->where('id',$id)->restore();

    }

    public function forceDelete($id){
        User::withTrashed()->where('id',$id)->forceDelete();
    }
}
