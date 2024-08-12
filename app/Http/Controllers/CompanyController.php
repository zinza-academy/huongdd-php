<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyRequest;
use App\Repositories\CompanyRepository;
use App\Services\CompanyService;
use Illuminate\Support\Facades\Session;

class CompanyController extends Controller
{
    protected $companyService, $companyRepository;

    public function __construct(CompanyService $service, CompanyRepository $repository) {
        $this->companyService = $service;
        $this->companyRepository = $repository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index() {
        $companies = $this->companyService->getCompanies();
        return view('company.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('company.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CompanyRequest $request)
    {
        $this->companyService->create($request);
        Session::flash('success', 'Company created');
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $company = $this->companyRepository->getCompanyById($id);
        return view('company.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CompanyRequest $request, string $id)
    {
        $this->companyService->update($request, $id);
        Session::flash('success', 'Company updated!');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->companyService->delete($id);
        Session::flash('success', 'Company deleted!');
        return redirect()->back();
    }
}
