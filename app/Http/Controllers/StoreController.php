<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Store;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRequest;

class StoreController extends Controller
{
    protected $db;
    public function __construct() {
        try {
            $this->db = app('firebase.firestore')->database();
        } catch (\Throwable $th) {
            dd($th);
        }
    }
   public function active()
   {
        $documents = $this->db->collection('Stores')->documents();
        $stores= array();
        foreach ($documents as $key=> $store) {
            if ($store->data()['name'] !='') {
                array_push($stores,$this->getOrderCollection($store->data(),$key));
            }
        }
        $stores= collect( $stores);
        $empty=false;
        return view('Dashbord.store.index',compact('stores','empty'));
   }

   public function empty()
   {
       
        $documents = $this->db->collection('Stores')->documents();
        $stores= array();
        foreach ($documents as $key=> $store) {
            if ($store->data()['name'] =='') {
                array_push($stores,$this->getOrderCollection($store->data(),$key));
            }
        }
        $stores= collect( $stores);
        $empty=true;
        return view('Dashbord.store.index',compact('stores','empty'));
   }
   public function edit(Store $store)
   {
    return view('Dashbord.store.edit',compact('store'));
   }
   public function create(Store $store)
   {
    //    dd('hhhhhd');
    return view('Dashbord.store.create',compact('store'));
   }
   public function store(StoreRequest $request)
   {
    //    dd($request->all()); 
        $store= new Store();
        $store->create($request->all());
        return redirect()->back();
    }
   public function save(StoreRequest $request,Store $store)
   {
        $request['expiringDate']= Carbon::parse( Carbon::now())->addMonths($request->renew);
        $store->save($request->all());
        return redirect('/store/empty-stores');
    }

   public function update(StoreRequest $request , Store $store)
   {
       
     $store->update($request->all());
     return redirect('store/active-stores');
   }
   public function destroy( Store $store)
   {
    //    dd('ooo');
     $store->delete();
     return redirect()->back();
   }
   

   private function getOrderCollection($data=[],$key)
   {   $data['id']=$key+1;
       return  new Store($data);
   }
//    static public function deleteItemOrCategoryOrLocation($id,$sheetName,$sheetId)
//    {
//        if ($sheetName=='Shop Logic') {
//                $ids = Sheets::spreadsheet(Session::get('sheet_id'))
//                ->sheet($sheetName)
//                ->majorDimension('COLUMNS')
//                ->range('B:B')
//                ->all();
       
//                foreach ($ids[0] as $key => $value) {
//                if ($value==$id) {
//                    // Storage::disk('s3')->delete('images/'.substr(strrchr(Session::get('logo'), "/"), 1));// for delete photos
//                    $batchUpdateRequest = new \Google_Service_Sheets_BatchUpdateSpreadsheetRequest(array(
//                            'requests' => array(
//                            'deleteDimension' => array(
//                                'range' => array(
//                                    'sheetId' => $sheetId, // the ID of the sheet/tab shown after 'gid=' in the URL
//                                    'dimension' => "ROWS",
//                                    'startIndex' => $key, // row number to delete
//                                    'endIndex' => $key+1
//                                )
//                            )    
//                            )
//                        ));
//                        Sheets::getService()->spreadsheets->batchUpdate(Session::get('sheet_id'), $batchUpdateRequest);
//                        break;
//                    }
//                }
//        }else{
//            $ids = Sheets::spreadsheet(Session::get('sheet_id'))
//            ->sheet($sheetName)
//            ->majorDimension('COLUMNS')
//            ->range('Z:Z')
//            ->all();

//            $batchUpdateRequest = new \Google_Service_Sheets_BatchUpdateSpreadsheetRequest(array(
//                'requests' => array(
//                  'deleteDimension' => array(
//                      'range' => array(
//                          'sheetId' => $sheetId, // the ID of the sheet/tab shown after 'gid=' in the URL
//                          'dimension' => "ROWS",
//                          'startIndex' => $id-1, // row number to delete
//                          'endIndex' => $id,
//                      )
//                  )    
//                )
//            ));
           
//            Sheets::getService()->spreadsheets->batchUpdate(Session::get('sheet_id'), $batchUpdateRequest);
//            // dd($sheetId,$id,count($ids[0]));
//        }
       
   
//    }
}
