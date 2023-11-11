<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Manauser;
use App\Models\User;
use App\Models\UserPass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ManagerUserController extends Controller
{
     public function adduser()
     {
        $user1=Auth()->user();
      /*  $this->validate($request,['name'=>'required','email'=>'required','password'=>'required','tel'=>'required'],['name.required'=>'İsim boş biraklamaz','password.required'=>'Şifre boş biraklamaz','tel.required'=>'Şifre boş biraklamaz']);
         $name=$request->name;
         $password=$request->password;
         $email=$request->email;
         $phone=$request->tel;
      */
         $name='abdollah';
         $password='12345678';
         $email='tr1wee34@gmail.com';
         $phone='548796254';

         $user= User::create([
             'name' => $name,
             'email' => $email,
             'tel'=>$phone,
             'password' => Hash::make($password),
         ]);

          $user->save();
          $var=User::where('email','=',$email)->first();
          $manauser=Manauser::create([
              'manager_id'=>$user1->id,
              'user_id'=>$var->id,
              'state'=>'0',


              ]);
          $manauser->save();
          $userpass=UserPass::create([
              'userid'=>$var->id,
               'pass'=>$password,
          ]);

           $userpass->save();
     }



    public function addmanager(Request $request,$id)
    {

         $this->validate($request,['companyname'=>'required','tel'=>'required'],['companyname.required'=>'Şirket İsim boş biraklamaz','tel.required'=>'Telfon boş biraklamaz']);
         $name=$request->companyname;
         $phone=$request->tel;
         $user=User::where('id','=',$id)
                   ->update(['companyname'=>$name,'tel'=>$phone]);
    }
}
