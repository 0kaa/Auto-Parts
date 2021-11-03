<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\FaqsRepositoryInterface;
use Illuminate\Http\Request;


class FaqsController extends Controller
{
    //

    protected $faqsRepository;



    public function __construct(FaqsRepositoryInterface $faqsRepository)
    {
        $this->faqsRepository = $faqsRepository;
    }

    public function index()
    {
        $faqs = $this->faqsRepository->getAll();
        return view('admin.faqs.index', compact('faqs'));
    }

    public function edit($id)
    {
        $faqs = $this->faqsRepository->findWhere([['id', $id]]);
        return view('admin.faqs.edit', compact('faqs'));
    }

    public function update($id, Request $request)
    {

        $this->faqsRepository->update($request->except('_method'), $id);
        return  response()->json(['success' => trans('admin.updated_success', ['field' => __('local.company-sectors')]), 200]);
        
    }
}
