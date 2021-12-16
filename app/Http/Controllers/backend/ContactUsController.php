<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use DB;
use Elsayednofal\BackendLanguages\Models\Languages;

use App\Models\ContactUsAddress;

class ContactUsController extends Controller
{

    public function anyIndex(Request $request)
    {
        $data['result'] = ContactUs::orderBy('id', 'DESC');

        if($request->filled('find'))
            $data['result']->where('email', $request->find)->orWhere('phone', $request->find)->orWhere('subject', 'LIKE', '%' . $request->find . '%');

        $data['result'] = $data['result']->paginate(50)->withPath(url('/backend/contact-us'))->appends($request->all());

        if(!empty($data['result']->pluck('id')))
            ContactUs::whereIn('id', $data['result']->pluck('id'))->update(['is_read' => true]);

        return view('backend.contact_us.index', $data);
    }

    public function anyDelete($id)
    {
        $contactUs = ContactUs::find($id);
        if(is_object($contactUs))
        {
            $contactUs->delete();
            $response = new \stdClass();
            $response->status = 'ok';
            $response->message = 'Deleted successfully';
        }
        else
        {
            $response = new \stdClass();
            $response->status = 'warning';
            $response->message = 'Row can not be deleted';
        }
        echo json_encode($response);
    }

    public function anySendReplay(Request $request)
    {
        if($request->ajax())
        {
            $contactUs = ContactUs::find($request->message_id);
            $response = new \stdClass();
            if(is_object($contactUs))
            {
                $contactUs->replay = $request->replay;
                $contactUs->is_read = true;
                $contactUs->is_replied = true;
                $contactUs->save();
                $response->status = 'ok';
                $response->message = 'Your Reply Message Sent Successfully';
            }
            else
            {
                $response->status = 'error';
                $response->message = 'Your Reply Message Not Sent Please Try Later';
            }
        }
        echo json_encode($response);
    }
    
    
    //============================ Address data ===============================    
    function create(Request $request){
        $address=new ContactUsAddress();
        if($request->isMethod('POST')){
            $this->store($address,$request);
        }
        $data['address']=$address;
        $data['languages']= Languages::all();
        return view('backend.contact_us.address.create',$data);
    }
    
    function update(Request $request,$id){
        $address= ContactUsAddress::findOrFail($id);
        if($request->isMethod('POST')){
            $this->store($address, $request);
        }
        $data['address']=$address;
        $data['languages']= Languages::all();
        return view('backend.contact_us.address.update',$data);
    }
    
    function delete($id){
        $address= ContactUsAddress::findOrFail($id);
        $address->delete();
        $res=new \stdClass();
        $res->message='Raw deleted Successfully';
        $res->status='ok';
        echo json_encode($res);
    }
    
    function index(Request $request){
        $addresses=new ContactUsAddress();
        if($request->address){
            foreach($request->address as $key=>$value){
                if($value=='')continue;
                $addresses=$addresses->where($key,'like','%'.$value.'%');
            }
        }
        $data['address'] = $addresses->get();
        $data['languages'] = Languages::all();
        $data['langs'] = $this->getLangById();
        //dd($data);
        return  view('backend.contact_us.address.index',$data);
    }
    
    
    function store(ContactUsAddress $address,Request $request){
        $address->address=$request->address['address'];
        $address->lat=$request->lat;
        $address->lng=$request->lng;
        $address->zoom=$request->zoom;
        $address->phones=$request->address['phones'];
        $address->emails=$request->address['emails'];
        $address->language_id=$request->address['language_id'];
        $address->save();
        Session()->flash('success','saved Successfully');
    }
    
    protected function getLangById(){
        $languages = Languages::all();
        $result = [];
        foreach($languages as $language){
            $result[$language->id]=$language;
        }
        return $result;
    }

}
