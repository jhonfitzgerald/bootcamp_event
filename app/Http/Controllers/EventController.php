<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\EventService;

class EventController extends Controller
{
    private $service;
    private $params;

    public function __construct(EventService $service=null){
        $this->service = $service == null? new EventService():$service;
        $this->params = $this->getPost();
    }

    public function index()
    {
        return view('event');
    }

    public function getAllEvents(){
        return $this->service->getAllEvents($this->params);
    }

    public function saveUpdateEvent(){
        return $this->service->saveUpdateEvent($this->params['item']);
    }

    public function deleteEvent(){
        return $this->service->deleteEvent($this->params['item']);
    }
}
