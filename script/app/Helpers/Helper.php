<?php

namespace App\Helpers;
use Session;
use DB;
use Cache;
use App\Models\Subscription;
use App\Models\Roll;
use App\Models\Permission;
use App\Models\Organization;
use Illuminate\Support\Facades\Http;
class Helper
{
    protected static $position;
    public static function Menu($position,$ul='',$li='',$a='',$icon_position='top',$lang=false)
 {
    Helper::$position=$position;
    if ($lang==false) {
        $menus=cache()->remember($position.Session::get('locale'),200,function(){
        return Adminmenu::where('position',Helper::$position)->where('status','1')->where('lang','en')->first();
        });
    }
    else{
       // echo Session::get('locale');
     $menus=cache()->remember($position.Session::get('locale'),200,function(){
     return $menus=Adminmenu::where('position',Helper::$position)->where('status','1')->where('lang',Session::get('locale'))->first();
     });
    }
 	return $menus;
 }
    public static function imageConvert($abb,$path="",$data)
    {
      if ($data!=null) {
        $image = $data;
        //$new_file_name = $abb.time().'.jpg';
        $new_file_name = $abb.rand('0000','9999').'_'.time().'.'.$image->getClientOriginalExtension();
        $destinationPath = 'public/images/'.$path;
         if ( !file_exists( $destinationPath ) && !is_dir( $destinationPath ) ) {
            mkdir( $destinationPath );
        }
        $image->move($destinationPath,$new_file_name);
         return $new_file_name;
         }
    }

    public static function slugGenarate($url)
    {
        $slug = preg_replace('/[^a-z0-9]+/i', '-', trim(strtolower($url)));
        return $slug;
    }

    public static function OrgslugGenarate($url)
    {
        $pattern = '/[^a-z0-9]+/i';
        $replacement = '';
        $slug = preg_replace($pattern, $replacement, trim(strtolower($url)));
        return $slug;
    }

    public static function RandID()
    {

       return rand('111','999');
    }

    public static function Subscription($id)
    {
       $data=Subscription::find($id);
       return (!empty($data->id)) ? $data->subscription_name : '';
    }

    public static function Roll($id)
    {
       $data=Roll::find($id);
       return (!empty($data->id)) ? $data->roll_name : '';
    }
    public static function roll_state($id)
    {
       $data=Roll::find($id);
       return (!empty($data->id)) ? $data->roll : '';
    }

    public static function Organization($id)
    {
       $data=Organization::find($id);
       return (!empty($data->id)) ? $data->org_name : '';
    }

    public static function Permission($id)
    {
       $data=Permission::find($id);
       return (!empty($data->id)) ? $data->permis_name : 'No';
    }
    public static function commaVal($data,$helper)
    {
        $data_arr=explode(',',$data);
        $new_arr=[];
        foreach ($data_arr as $value) {
           $reval=Self::$helper($value);
          if(!empty($reval)) array_push($new_arr,$reval);
        }
        return implode(', ',$new_arr);

    }

    public static function PermissionRoute($id)
    {
       $data=Permission::find($id);
       return (!empty($data->id)) ? $data->permis_route : '';
    }

    public static function OrgSubRoll($id)
    {
       $data=Permission::find($id);
       return (!empty($data->id)) ? $data->permis_route : '';
    }

    public static function SubDomain($data)
    {
       echo $data;
    }

    public static function weekDays($id)
    {
        $week=[
            "1"=>"Mon",
            "2"=>"Tue",
            "3"=>"Wed",
            "4"=>"Thu",
            "5"=>"Fri",
            "6"=>"Sat",
            "7"=>"Sun",
        ];
        return $week[$id];
    }

    public static function months($id)
    {
        $month=[
            "1"=>"Jan",
            "2"=>"Feb",
            "3"=>"Mar",
            "4"=>"Apr",
            "5"=>"May",
            "6"=>"Jun",
            "7"=>"Jul",
            "8"=>"Aug",
            "9"=>"Sep",
            "10"=>"Oct",
            "11"=>"Nov",
            "12"=>"Dec",
        ];
        return $month[$id];
    }
}
