<?php

namespace App\Services;

use App\Repository\CategoryRepository;

class CategoryService
{
    private $repository;

    public function __construct(CategoryRepository $repository=null){
        $this->repository = $repository==null?new CategoryRepository():$repository;
    }

    public function getAllCategories($params){
        return json_encode($this->repository->getAllCategories($params));
    }

    public function saveUpdateCategory($params){
        return json_encode($this->repository->saveUpdateCategory($params));
    }

    public function deleteCategory($params){
        return json_encode($this->repository->deleteCategory($params));
    }
}
