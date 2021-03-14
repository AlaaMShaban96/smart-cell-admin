<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Http\Traits\DeleteTrait;
use Intervention\Image\Facades\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Store extends Model
{
    use DeleteTrait;
    use HasFactory;
    protected $sheetIds=[
            'ids_system'=>[
                '1247890525',// id sheet Shop Logic
                // '2068657180',//id sheet  Properties Logic
        ],
            'ids_data'=>[
                '1709273218',// id sheet توصيات الزبائن
                // '1709273218',// id sheet توصيات الزبائن
        ],
    ];
    protected $fillable = ['id','SA','SA0','SA1','SA2','SA3','SA4','SA5','SA6','email','expiringDate','icon','mc_api','name','s_id','users','database_link','id_data','id_system','phone','passport'];


    public function resolveRouteBinding($value, $field = null)
    {
        $db = app('firebase.firestore')->database();
        $documents = $db->collection('Stores')->document($value)->snapshot();
        $store=$documents->data();
        if (isset($store['users'][0])) {
            $user = $db->collection('users')->document($store['users'][0])->snapshot();
            $store['phone']=$user->data()['phone'];
            $store['passport']=$user->data()['passport'];
        }else {
            $store['phone']="";
            $store['passport']="";
            $store['users'][0]="";
        }
        
        $store=$this->getOrderCollection($store,$value);
        return isset($store)?$store: abort(400);
    }

    public function update(array $attributes = [], array $options = [])
    {
        $db = app('firebase.firestore')->database();
        $storeRef = $db->collection('Stores')->document($this->id)->snapshot();
        $data=$storeRef->data();
        $data['name']=$attributes['name'];
        $data['expiringDate']=new Carbon($attributes['expiringDate']);
        $data['mc_api']=$attributes['mc_api'];
        $data['icon']=isset($attributes['icon'])?$this->compress($attributes['icon']):$data['icon'];
        $data['email']=$attributes['email'];
        $data['database_link']=$attributes['database_link'];
        $data['id_data']=$attributes['id_data'];
        $data['id_system']=$attributes['id_system'];
        $data['users']=$attributes['users'];
        $data['SA0']=isset($attributes['SA0'])?$this->getFileContent($attributes['SA0']->getRealPath()):$data['SA0'];
        $data['SA1']=isset($attributes['SA1'])?$this->getFileContent($attributes['SA1']->getRealPath()):$data['SA1'];
        $data['SA2']=isset($attributes['SA2'])?$this->getFileContent($attributes['SA2']->getRealPath()):$data['SA2'];
        $data['SA3']=isset($attributes['SA3'])?$this->getFileContent($attributes['SA3']->getRealPath()):$data['SA3'];
        $data['SA4']=isset($attributes['SA4'])?$this->getFileContent($attributes['SA4']->getRealPath()):$data['SA4'];
        $db->collection('Stores')->document($this->id)->set($data);
        $db->collection('users')->document($attributes['users'][0])->set(
            [
            'email'=>$attributes['users'][0],
            'name'=>'Admin',
            'phone'=>$this->phone,
            'passport'=>$this->phone,
            'role'=>'admin',
            'store_id'=>$this->id,
        ]);

    }
    public function create(array $attributes = [], array $options = [])
    {
        $db = app('firebase.firestore')->database();
        $documents = $db->collection('Stores');
        $stores=$documents->documents();
        $this->id=count($stores->rows())+1 ;
        
        $data['AS']="0";
        $data['name']="";
        $data['expiringDate']="";
        $data['mc_api']="";
        $data['icon']="";
        $data['email']=$attributes['email'];
        $data['database_link']=$attributes['database_link'];
        $data['id_data']=$attributes['id_data'];
        $data['id_system']=$attributes['id_system'];
        $data['users']=[];
        $data['SA0']=isset($attributes['SA0'])?$this->getFileContent($attributes['SA0']->getRealPath()):$data['SA0'];
        $data['SA1']=isset($attributes['SA1'])?$this->getFileContent($attributes['SA1']->getRealPath()):$data['SA1'];
        $data['SA2']=isset($attributes['SA2'])?$this->getFileContent($attributes['SA2']->getRealPath()):$data['SA2'];
        $data['SA3']=isset($attributes['SA3'])?$this->getFileContent($attributes['SA3']->getRealPath()):$data['SA3'];
        $data['SA4']=isset($attributes['SA4'])?$this->getFileContent($attributes['SA4']->getRealPath()):$data['SA4'];
        $db->collection('Stores')->document($this->id)->set($data);
  

    }
    public function save(array $attributes = [], array $options = [])
    {
        // dd('save',$attributes);
        $db = app('firebase.firestore')->database();
        $storeRef = $db->collection('Stores')->document($this->id)->snapshot();
        $data=$storeRef->data();
        $data['name']=$attributes['name'];
        $data['phone']=$attributes['phone'];
        $data['passport']=$attributes['passport'];
        $data['expiringDate']=new Carbon($attributes['expiringDate']);
        $data['mc_api']=$attributes['mc_api'];
        $data['icon']=isset($attributes['icon'])?$this->compress($attributes['icon']):asset('images/logo.svg');
     

        $data['users']=$attributes['users'];
      
        // dd('save',$attributes,$data);
        
        $db->collection('Stores')->document($this->id)->set($data);
        $db->collection('users')->document($attributes['users'][0])->set(
            [
            'email'=>$attributes['users'][0],
            'name'=>'Admin',
            'phone'=>$data['phone'],
            'passport'=>$data['passport'],
            'role'=>'admin',
            'store_id'=>$this->id,
        ]);
                // dd( $data);

    }
    public function delete()
    {
        try {            

            $this->setGoogleSheetCredentials($this['SA'.($this->SA%5)]);

            foreach ($this->sheetIds['ids_system'] as $key => $id) {
                $this->deleteStoreFromGoogleSheet($this->id_system,$id);
            }
            $this->deleteStoreFromFireStore($this->id);

        } catch (\Throwable $th) {
            return false;
        }
            return true;
    }
    private function getOrderCollection($data=[],$key)
    {   $data['id']=$key;
        return  new Store($data);
    }
    private function getFileContent($path)
    {  
        $jsonString = file_get_contents($path);
        return json_decode($jsonString, true);
    }
    private function compress( $photo)
    {
        $nameFile=Session::get('store_name').(string) Str::uuid().'.png';
        $img = Image::make($photo->getRealPath())->resize(466, 466)->save('storage/'.$nameFile);
        $s3 = Storage::disk('s3');
        $filePath = 'images/' .Session::get('store_name').(string) Str::uuid();
        $s3->put($filePath, file_get_contents(public_path('storage/'. $nameFile)), 'public');
        $path='https://smartcellimage.s3.af-south-1.amazonaws.com/'.$filePath;
        return $path;

    } 
}
