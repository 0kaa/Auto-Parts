<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Traits\ApiResponseTrait;
use App\Http\Resources\Api\AttributeResource;
use App\Http\Resources\Api\SubActivitiesResource;
use App\Repositories\AttributeRepositoryInterface;
use App\Repositories\SubActivityTypeRepositoryInterface;


class ApiAttributeController extends Controller
{

    use ApiResponseTrait;
    private $attributeRepository;
    private $subActivityTypeRepository;
    public function __construct(AttributeRepositoryInterface $attributeRepository, SubActivityTypeRepositoryInterface $subActivityTypeRepository)
    {
        $this->attributeRepository = $attributeRepository;
        $this->subActivityTypeRepository = $subActivityTypeRepository;
    }

    
    public function getSubAttributes($id)
    {
        $subActivity = $this->subActivityTypeRepository->findOne($id);
        
        return $this->ApiResponse(AttributeResource::collection($subActivity->attributes), null, 200);
    }
}
