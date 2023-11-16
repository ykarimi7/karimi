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
     public function newaddnewuser(Request $request)
     {


        $user1=Auth()->user();
        $this->validate($request,['name'=>'required','name1'=>'required','email'=>'required','password'=>'required','tel'=>'required'],['name1.required'=>'İsim boş biraklamaz','name.required'=>'Şube boş biraklamaz','password.required'=>'Şifre boş biraklamaz','tel.required'=>'telefon boş biraklamaz']);
         $name=$request->name;
         $name1=$request->name1;

         $password=$request->password;

         $email=$request->email;
         $phone=$request->tel;



         $user= User::create([
             'name' => $name1,
             'username'=>$name,
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

          // return back()->with('success','Kayd oldu');
         return redirect('/trending');



     }



    public function addmanager(Request $request,$id)
    {

         $this->validate($request,['companyname'=>'required','tel'=>'required'],['companyname.required'=>'Şirket İsim boş biraklamaz','tel.required'=>'Telfon boş biraklamaz']);
         $name=$request->companyname;
         $phone=$request->tel;
         $user=User::where('id','=',$id)
                   ->update(['companyname'=>$name,'tel'=>$phone]);
    }

    public function del(Request $request)
    {
         $id = $request->id;
         User::where('id','=',$id)->delete();
         Manauser::where('user_id','=',$id)->delete();
         return redirect('/trending')->with('success','User deleted successfully');

    }


    public function  newedituser(Request $request,$id)
    {
        $id=$request->id;
        $name=$request->name1;
        $username=$request->name;
        $email=$request->email;
        $tel=$request->tel;
        $edit=User::where('id','=',$id)
                   ->update(['name'=>$name,'email'=>$email,'tel'=>$tel]);
        return redirect('/trending');

    }

    public function newsearch(Request $request)
    {
       /* $date1=$request->date1;
        $date2=$request->date2;
        echo 'date1='.$date1;
        echo 'date2='.$date2;
       */

        $user=Auth()->user();
        $status=$user->status;
        if($status==0)
            $status='Ooffline';
        if($status==1)
            $status='Online';
        $lastvizit=$user->last_activity;
        $count=Manauser::where('manager_id','=',$user->id)->count();
        $var=Manauser::where('manager_id','=',$user->id)->get();



        $view = View::make('customer',['var'=>$var,'status'=>$status,'lastvizit'=>$lastvizit,'count'=>$count,'usercount'=>$user->usercount]);
        if ($this->request->ajax()) {

            $sections = $view->renderSections();
            if ($this->request->input('page') && intval($this->request->input('page')) > 1) {
                return $sections['pagination'];
            } else {
                return $sections['content'];
            }
        }
        return $view;



    }


}