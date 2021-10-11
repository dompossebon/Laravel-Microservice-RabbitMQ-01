<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateCompany;
use App\Http\Resources\CompanyResource;
use App\Models\Company;
use App\Services\EvaluationService;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    protected $evaluationService;
//    protected $companyService;

        protected $repository;

//    public function __construct(EvaluationService $evaluationService, CompanyService $companyService)
//    {
//        $this->evaluationService = $evaluationService;
//        $this->companyService = $companyService;
//    }

    public function __construct(Company $model, EvaluationService $evaluationService)
    {
        $this->evaluationService = $evaluationService;
        $this->repository = $model;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
//    public function index(Request $request)
//    {
//        $companies = $this->companyService->getCompanies($request->get('filter', ''));
//
//        return CompanyResource::collection($companies);
//    }
    public function index(Request $request)
    {
        $companies = $this->repository->getCompanies($request->get('filter', ''));

        return CompanyResource::collection($companies);
    }

    /**
     * @param StoreUpdateCompany $request
     * @return CompanyResource
     */
    public function store(StoreUpdateCompany $request)
    {

        $company = $this->repository->create($request->validated());

//        CompanyCreated::dispatch($company->email)
//            ->onQueue('queue_email');


        return new CompanyResource($company);
    }

    /**
     * @param $uuid
     * @return CompanyResource
     */
    public function show($uuid)
    {
        $company = $this->repository->where('uuid', $uuid)->firstOrFail();

//        $evaluations = $this->evaluationService->getEvaluationsCompany($uuid);

        return new CompanyResource($company);
    }

    /**
     * @param StoreUpdateCompany $request
     * @param $uuid
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(StoreUpdateCompany $request, $uuid)
    {

        $company = $this->repository->where('uuid', $uuid)->firstOrFail();

        $company->update($request->validated());

        return response()->json([
            'message' => 'Updated'
        ]);
    }

    /**
     * @param $uuid
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($uuid)
    {

        $company = $this->repository->where('uuid', $uuid)->firstOrFail();

        $company->delete();

        return response()->json([], 204);
    }

}
