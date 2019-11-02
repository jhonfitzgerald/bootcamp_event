<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\OrganizerService;

class OrganizerController extends Controller
{
    private $service;
    private $params;

    public function __construct(OrganizerService $service=null){
        $this->service = $service == null? new OrganizerService():$service;
        $this->params = $this->getPost();
    }

    public function index()
    {
        return view('backend.dashboard');
    }

    public function getAllOrganizers(){
        return $this->service->getAllOrganizers($this->params);
    }

    public function saveUpdateOrganizer(){
        return $this->service->saveUpdateOrganizer($this->params['item']);
    }

    public function deleteOrganizer(){
        return $this->service->deleteOrganizer($this->params['item']);
    }
}
