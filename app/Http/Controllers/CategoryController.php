<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\CategoryService;

class CategoryController extends Controller
{
    private $service;
    private $params;

    public function __construct(CategoryService $service=null){
        $this->service = $service == null? new CategoryService():$service;
        $this->params = $this->getPost();
    }

    public function index()
    {
        return view('category');
    }

    public function getAllCategories(){
        return $this->service->getAllCategories($this->params);
    }

    public function saveUpdateCategory(){
        return $this->service->saveUpdateCategory($this->params['item']);
    }

    public function deleteCategory(){
        return $this->service->deleteCategory($this->params['item']);
    }
}
