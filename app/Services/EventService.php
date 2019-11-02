<?php

namespace App\Services;

use App\Repository\EventRepository;

class EventService
{
    private $repository;

    public function __construct(EventRepository $repository=null){
        $this->repository = $repository==null?new EventRepository():$repository;
    }

    public function getAllEvents($params){
        return json_encode($this->repository->getAllEvents($params));
    }

    public function saveUpdateEvent($params){
        return json_encode($this->repository->saveUpdateEvent($params));
    }

    public function deleteEvent($params){
        return json_encode($this->repository->deleteEvent($params));
    }
}
