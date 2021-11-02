<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\SubscribeRepositoryInterface;
use Illuminate\Http\Request;

class NewsLetterController extends Controller
{
    //
    protected $subscribeRepository;

    public function __construct(SubscribeRepositoryInterface $subscribeRepository)
    {
        $this->subscribeRepository=$subscribeRepository;
    }

    public function index(){
        $subscribes=$this->subscribeRepository->getAll();
        return view('admin.subscribes.index',compact('subscribes'));
    }

    public function destroy($id){
        $this->subscribeRepository->delete($id);
        return  response()->json(['success' =>trans('local.deleted_success')
            ,'status'=> 200]);
    }
}
