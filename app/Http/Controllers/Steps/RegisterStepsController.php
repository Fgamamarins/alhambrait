<?php

namespace App\Http\Controllers\Steps;

use App\Http\Requests\StepOnePostRequest;
use App\Http\Requests\StepThreePostRequest;
use App\Http\Requests\StepTwoPostRequest;
use App\Repositories\LeadRepository;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

/**
 * Class RegisterStepsController
 * @package App\Http\Controllers\Steps
 */
class RegisterStepsController
{
    /**
     * @var LeadRepository
     */
    private $leadRepository;

    /**
     * RegisterStepsController constructor.
     * @param LeadRepository $leadRepository
     */
    public function __construct(LeadRepository $leadRepository)
    {
        $this->leadRepository = $leadRepository;
    }

    /**
     * @return Application|Factory|View
     */
    public function register()
    {
        $this->leadRepository->setIdentifier();
        $lead = $this->leadRepository->getLeadByIdentifier();

        $data = [
            'lead' => $lead,
        ];

        return view('auth.steps.register-steps', $data);
    }

    /**
     * @param StepOnePostRequest $request
     * @return JsonResponse
     */
    public function stepOne(StepOnePostRequest $request): JsonResponse
    {
        try {
            $this->leadRepository->createOrUpdate($request->validated());

            return response()->json(
                [
                    'message' => 'success',
                ], 200
            );
        } catch (Exception $ex) {
            return response()->json(
                [
                    'message' => 'error',
                ], 400
            );
        }
    }

    /**
     * @param StepTwoPostRequest $request
     * @return JsonResponse
     */
    public function stepTwo(StepTwoPostRequest $request): JsonResponse
    {
        try {
            $this->leadRepository->createOrUpdate($request->validated());

            return response()->json(
                [
                    'message' => 'success',
                ], 200
            );
        } catch (Exception $ex) {
            return response()->json(
                [
                    'message' => 'error',
                ], 400
            );
        }
    }

    /**
     * @param StepThreePostRequest $request
     * @return JsonResponse
     */
    public function stepThree(StepThreePostRequest $request): JsonResponse
    {
        try {
            $this->leadRepository->createOrUpdate($request->validated());

            return response()->json(
                [
                    'message' => 'success',
                ], 200
            );
        } catch (Exception $ex) {
            return response()->json(
                [
                    'message' => 'error',
                ], 400
            );
        }
    }
}
