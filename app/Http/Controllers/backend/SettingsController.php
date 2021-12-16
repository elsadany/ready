<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Settings;
use Illuminate\Http\Request;

class SettingsController extends Controller
{

    public function anyIndex()
    {
        if(isset($_POST['save']) && isset($_POST['value']))
        {
            foreach($_POST['value'] as $key => $row)
            {
                $setting = Settings::find($key);
                if($setting)
                {
                    if(is_array($row))
                    {
                        foreach($row as $key2 => $row2)
                        {
                            $setting = Settings::find($key);
                            if($setting)
                            {
                                $setting->value = $row2;
                                $setting->save();
                            }
                        }
                    }
                    else
                    {
                        $setting->value = $row;
                        $setting->save();
                    }
                }
            }

            session()->flash('success', 'Update successfully');
            return redirect(\URL::Current());
        }
        $data['settings'] = Settings::Orderby('id', 'ASC')->get();

        return view('backend.settings.index', $data);
    }
    
    
    function create(Request $request){
        if($request->isMethod('POST')){
            $setting=new Settings();
            $setting->fill($request->all());
            $setting->save();
            session()->flash('success',trans('Update successfully'));
        }
        return view('backend.settings.create');
    }
    
    
}
