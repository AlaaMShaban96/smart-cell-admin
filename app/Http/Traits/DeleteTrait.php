<?php

namespace App\Http\Traits;
use App\Models\Student;
use Illuminate\Support\Facades\Session;
use Revolution\Google\Sheets\Facades\Sheets;



trait DeleteTrait {

    private function setGoogleSheetCredentials( $store)
    {
        $jsonString = file_get_contents(storage_path('credentials.json'));
            
        $data = json_decode($jsonString, true);
        $data= [
         "type" =>$store["type"],
        "project_id" =>$store["project_id"],
        "private_key_id" =>$store["private_key_id"],
        "private_key" =>$store["private_key"],
        "client_email" =>$store["client_email"],
        "client_id" =>$store["client_id"],
        "auth_uri" =>$store["auth_uri"],
        "token_uri" =>$store["token_uri"],
        "auth_provider_x509_cert_url" =>$store["auth_provider_x509_cert_url"],
        "client_x509_cert_url" =>$store["client_x509_cert_url"],
        ];
        $newJsonString = json_encode($data, JSON_PRETTY_PRINT);

        file_put_contents(storage_path('credentials.json'), stripslashes($newJsonString));

    }
    public function deleteStoreFromGoogleSheet($id,$sheetId)
    {
        // Storage::disk('s3')->delete('images/'.substr(strrchr(Session::get('logo'), "/"), 1));// for delete photos
        $batchInsertRowRequest = new \Google_Service_Sheets_BatchUpdateSpreadsheetRequest(array(
                'requests' => array(
                    "insertDimension" => array(
                    'range' => array(
                        'sheetId' => $sheetId, // the ID of the sheet/tab shown after 'gid=' in the URL
                        'dimension' => "ROWS",
                        'startIndex' =>1, // row number to delete
                        'endIndex' =>2
                    ),
                    "inheritFromBefore"=> true,

                )    
                )
            ));
        $batchUpdateRequest = new \Google_Service_Sheets_BatchUpdateSpreadsheetRequest(array(
                'requests' => array(
                'deleteDimension' => array(
                    'range' => array(
                        'sheetId' => $sheetId, // the ID of the sheet/tab shown after 'gid=' in the URL
                        'dimension' => "ROWS",
                        'startIndex' =>1, // row number to delete
                        // 'endIndex' =>6
                    )
                )    
                )
            ));
            // try {
                Sheets::getService()->spreadsheets->batchUpdate($id, $batchInsertRowRequest);
                Sheets::getService()->spreadsheets->batchUpdate($id, $batchUpdateRequest);
            //     return true;

            // } catch (\Throwable $th) {
            //    return false;
            // }
    }
    public function deleteStoreFromFireStore($storeID)
    {
        $db = app('firebase.firestore')->database();
        $storeRef = $db->collection('Stores')->document($storeID)->snapshot();
        foreach ($storeRef->data()['users'] as $userEmail) {
            $db->collection('users')->document("".$userEmail)->delete();
        }
        $data=$storeRef->data();
        $data['SA']="0";
        $data['name']="";
        $data['expiringDate']='';
        $data['mc_api']='';
        $data['icon']='';
        $data['users']=[];
        $db->collection('Stores')->document($storeID)->set($data);
    }
        
    
    
}