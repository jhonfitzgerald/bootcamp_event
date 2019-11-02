<?php

namespace App\Repository;

use App\Models\Event;
use App\Utils\CommonUtil;
use Illuminate\Support\Facades\DB;

class EventRepository
{
    public static function getAllEvents($params){
        try{
            return Event::where('state','!=',0)->get(['id','name','state']);
        }catch(Exception $exc){
            return 'Error :=> '.$exc;
        }
    }

    public static function saveUpdateEvent($params){
        try{
            return DB::transaction(function() use ($params){
                if($params['id']>0){
                    if(self::updateEvent($params))
                        return CommonUtil::statusTrue();
                }else{
                    if(self::saveEvent($params))
                        return CommonUtil::statusTrue();
                }
                return CommonUtil::statusFalse();
            });
        }catch(Exception $exc){
            return 'Error :=> '.$exc;
        }
    }

    private static function saveEvent($params){
        try{
            return DB::transaction(function() use ($params){
                return Event::create([
                    'organizer_id'=>$params['organizer_id'],
                    'category_id'=>$params['category_id'],
                    'name'=>$params['name'],
                    'description'=>$params['description'],
                    'url_image'=>$params['url_image'],
                    'origin_city'=>$params['origin_city'],
                    'country'=>$params['country'],
                    'latitude'=>$params['latitude'],
                    'longitude'=>$params['longitude']
                ]);
            });
        }catch(Exception $exc){
            return 'Error :=> '.$exc;
        }
    }

    private static function updateEvent($params){
        try{
            return DB::transaction(function() use ($params){
                return Event::where('id',$params['id'])
                    ->update(['organizer_id'=>$params['organizer_id'],
                    'category_id'=>$params['category_id'],
                    'name'=>$params['name'],
                    'description'=>$params['description'],
                    'url_image'=>$params['url_image'],
                    'origin_city'=>$params['origin_city'],
                    'country'=>$params['country'],
                    'latitude'=>$params['latitude'],
                    'longitude'=>$params['longitude']]);
                });
        }catch(Exception $exc){
            return 'Error :=> '.$exc;
        }
    }

    public static function deleteEvent($params){
        try{
            return DB::transaction(function() use ($params){
                if(Event::where('id',$params['id'])
                    ->update(['state'=>0]))
                    return CommonUtil::statusTrue();
                return CommonUtil::statusFalse();
            });
        }catch(Exception $exc){
            return 'Error :=> '.$exc;
        }
    }
}

