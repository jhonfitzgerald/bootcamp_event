<?php

namespace App\Repository;

use App\Models\Organizer;
use App\Utils\CommonUtil;
use Illuminate\Support\Facades\DB;

class OrganizerRepository
{
    public static function getAllOrganizers($params){
        try{
            return Organizer::where('state','!=',0)->get(['id','name','state']);
        }catch(Exception $exc){
            return 'Error :=> '.$exc;
        }
    }

    public static function saveUpdateOrganizer($params){
        try{
            return DB::transaction(function() use ($params){
                if($params['id']>0){
                    if(self::updateOrganizer($params))
                        return CommonUtil::statusTrue();
                }else{
                    if(self::saveOrganizer($params))
                        return CommonUtil::statusTrue();
                }
                return CommonUtil::statusFalse();
            });
        }catch(Exception $exc){
            return 'Error :=> '.$exc;
        }
    }

    private static function saveOrganizer($params){
        try{
            return DB::transaction(function() use ($params){
                return Organizer::create([
                    'name'=>$params['name']
                ]);
            });
        }catch(Exception $exc){
            return 'Error :=> '.$exc;
        }
    }

    private static function updateOrganizer($params){
        try{
            return DB::transaction(function() use ($params){
                return Organizer::where('id',$params['id'])
                    ->update(['name'=>$params['name']]);
                });
        }catch(Exception $exc){
            return 'Error :=> '.$exc;
        }
    }

    public static function deleteOrganizer($params){
        try{
            return DB::transaction(function() use ($params){
                if(Organizer::where('id',$params['id'])
                    ->update(['state'=>0]))
                    return CommonUtil::statusTrue();
                return CommonUtil::statusFalse();
            });
        }catch(Exception $exc){
            return 'Error :=> '.$exc;
        }
    }
}

