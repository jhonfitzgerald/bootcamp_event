<?php

namespace App\Repository;

use App\Models\Category;
use App\Utils\CommonUtil;
use Illuminate\Support\Facades\DB;

class CategoryRepository
{
    public static function getAllCategories($params){
        try{
            return Category::where('state','!=','REMOVED')->get(['id','name','state']);
        }catch(Exception $exc){
            return 'Error :=> '.$exc;
        }
    }

    public static function saveUpdateCategory($params){
        try{
            return DB::transaction(function() use ($params){
                if($params['id']>0){
                    if(self::updateCategory($params))
                        return CommonUtil::statusTrue();
                }else{
                    if(self::saveCategory($params))
                        return CommonUtil::statusTrue();
                }
                return CommonUtil::statusFalse();
            });
        }catch(Exception $exc){
            return 'Error :=> '.$exc;
        }
    }

    private static function saveCategory($params){
        try{
            return DB::transaction(function() use ($params){
                return Category::create([
                    'name'=>$params['name']
                ]);
            });
        }catch(Exception $exc){
            return 'Error :=> '.$exc;
        }
    }

    private static function updateCategory($params){
        try{
            return DB::transaction(function() use ($params){
                return Category::where('id',$params['id'])
                    ->update(['name'=>$params['name']]);
                });
        }catch(Exception $exc){
            return 'Error :=> '.$exc;
        }
    }

    public static function deleteCategory($params){
        try{
            return DB::transaction(function() use ($params){
                if(Category::where('id',$params['id'])
                    ->update(['state'=>0]))
                    return CommonUtil::statusTrue();
                return CommonUtil::statusFalse();
            });
        }catch(Exception $exc){
            return 'Error :=> '.$exc;
        }
    }
}

