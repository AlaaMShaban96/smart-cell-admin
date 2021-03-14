<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Store;
use Illuminate\Http\Request;

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
}
