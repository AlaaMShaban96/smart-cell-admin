<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;

class HomeController extends Controller
{
    protected $db;
    public function __construct() {
        try {
            $this->db = app('firebase.firestore')->database();
        } catch (\Throwable $th) {
            //throw $th;
            dd($th);
        }
    }
    public function index()
    {
        $expiringStore=0;
        $snapshot = $this->db->collection('Stores');
        $snapshot=$snapshot->documents();
        // dd($snapshot);
        $stores= array();
        foreach ($snapshot as $key=> $store) {
            $date = Carbon::parse( $store->data()['expiringDate']);
            $now  = Carbon::now();
            $diff = $date->diffInDays($now);
            if ($diff <= 10) {
                $expiringStore+=1;
            }
             array_push($stores,$this->getOrderCollection($store->data(),$key));
        }
        $stores= collect( $stores);
        
        return view('Dashbord.index',compact('stores','expiringStore'));

    }

    public function renew(Request $request, $id)
    {
        // dd(,$request->expiringDate,);
        // 
        $citiesRef = $this->db->collection('Stores')->document($id)->snapshot();
        $data=$citiesRef->data();
        $data['expiringDate']= Carbon::parse( $request->expiringDate)->addMonths($request->renew);
        // dd($data);


        $this->db->collection('Stores')->document($id)->set($data);
        return redirect()->back();
    }

    private function getOrderCollection($data=[],$key)
    {   $data['id']=$key+1;
        return  new Store($data);
    }
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }
    public function loginShow()
    {
        return view('login');
    }
    public function login()
    {
        
        return redirect('/redirect');
    }
    public function logout()
    {
        
        Session::forget('name');
        Session::forget('role');
        Session::forget('email');
        return redirect('/');

    }
    public function handleProviderCallback(Request $request)
    {
        try{
      
            $user = Socialite::with('google')->getAccessTokenResponse($request->code);
            
                # code...
           
                if ($this->selectUser($user['id_token'],$user)) {
                          
                                return redirect('/index');
                         
                    }else {
                        Session::flash('message', "ليس مصرح لك بدخول النظام");

                        return view('login');
                        
                    }
             
        } catch (\Exception $e) {
            return 'status'. $e;
        }
    }

    private function selectUser( $idToken,$userTest)
    {
        $user= app('firebase.auth')->signInWithGoogleIdToken($idToken);

        $snapshot = $this->db->collection('Admins')->document($user->data()['email'])->snapshot();
        
        if ($snapshot->exists()) {
            
                    if ($snapshot->data()['role']=='admin') {
                        
                        Session::put('name', $snapshot->data()['name']);
                        Session::put('role', $snapshot->data()['role']);
                        Session::put('email',$snapshot->data()['email']);                      
                    
                     
                        return true;
                    }else {
                        Session::flash('message', "لاتملك صلاحية الدخول");
                        return false;
                    }
                       

                } else {
                    Session::flash('message', "البريد غير موجود ");
                    return false;
                }

        
        
    }



}


