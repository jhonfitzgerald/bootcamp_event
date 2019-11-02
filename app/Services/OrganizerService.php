<?php

namespace App\Services;

use App\Repository\OrganizerRepository;

class OrganizerService
{
    private $repository;

    public function __construct(OrganizerRepository $repository=null){
        $this->repository = $repository==null?new OrganizerRepository():$repository;
    }

    public function getAllOrganizers($params){
        return json_encode($this->repository->getAllOrganizers($params));
    }

    public function saveUpdateOrganizer($params){
        return json_encode($this->repository->saveUpdateOrganizer($params));
    }

    public function deleteOrganizer($params){
        return json_encode($this->repository->deleteOrganizer($params));
    }
}
