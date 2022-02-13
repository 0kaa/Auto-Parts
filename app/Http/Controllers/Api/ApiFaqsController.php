<?php


namespace App\Http\Controllers\Api;

use App\Models\Faqs;
use Illuminate\Http\Request;
use App\Repositories\FaqsRepositoryInterface;
use App\Http\Controllers\Api\Traits\ApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\FaqsResource;
use App\Models\Setting;

class ApiFaqsController extends Controller
{

    use ApiResponseTrait;
    protected $faqsRepository;

    public function __construct(FaqsRepositoryInterface $faqsRepository)
    {

        $this->faqsRepository  = $faqsRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faqs = $this->faqsRepository->getAll();
        return $this->ApiResponse([
            'faqs' => FaqsResource::collection($faqs),
            'email' => Setting::where('key', 'email')->first()->value,
            'website' => Setting::where('key', 'website')->first()->value,
        ], null, 200);
    }
}
