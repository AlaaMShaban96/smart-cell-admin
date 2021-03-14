<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // dd('hhhh');
        
        $arr = explode('@', $this->route()->getActionName());
        $method = $arr[1];  // The controller method
    
        $regex = '/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/';

    //    dd($method,$this->route()->getActionName());
        switch ($method) {
            case 'save':
                return [
                    'name' => 'required',
                    'expiringDate' => 'required',
                    'mc_api' => 'required',
                    // 'icon' => 'required|file',
                    // 'email' => 'required|email',
                    'phone' => 'required',
                    'passport' => 'required',
                    'users' => 'required',
               
                ];
                break;
            case 'store':
                return [
                    // 'name' => 'required',
                    // 'expiringDate' => 'required',
                    // 'mc_api' => 'required',
                    // 'icon' => 'required|file',
                    'email' => 'required|email',
                    'database_link' => 'required',
                    'id_data' => 'required',
                    // 'phone' => 'required',
                    // 'passport' => 'required',
                    'id_system' => 'required',
                    // 'users' => 'required',
                    'SA0' => 'required|file|mimes:json',
                    'SA1' => 'required|file|mimes:json',
                    'SA2' => 'required|file|mimes:json',
                    'SA3' => 'required|file|mimes:json',
                    'SA4' => 'required|file|mimes:json',
                ];
                break;
                
            case 'update':
                return [
                    'name' => 'required',
                    'expiringDate' => 'required',
                    'mc_api' => 'required',
                    // 'icon' => 'required|file',
                    'email' => 'required|email',
                    'database_link' => 'required',
                    'id_data' => 'required',
                    'id_system' => 'required',
                    'users' => 'required',
                    'SA0' => 'file|mimes:json',
                    'SA1' => 'file|mimes:application/json',
                    'SA2' => 'file|mimes:application/json',
                    'SA3' => 'file|mimes:application/json',
                    'SA4' => 'file|mimes:application/json',
                ];
                break;
         }
    }
    public function messages()
    {
        return [
            'users.required' => 'A user with this email address already exists.'
        ];
    }
    // protected function getValidatorInstance() {
    //     $validator = parent::getValidatorInstance();
    //     if (isset($input['users'])) {
    //         $validator->sometimes('users', 'required|email', function($input) {
    //             dd($input);
    //             $db = app('firebase.firestore')->database();
    //             $documents = $db->collection('users');
    //             foreach ($documents->documents() as $key => $user) {
    //                if($input['users'][0]== $user->id()){
    //                 return true;
    //                }
    //             }
    //             return false;
    //         });
    //     }
        
    //     return $validator;
    // }
   
  
}
