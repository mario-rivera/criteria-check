<?php
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

use OpenApi\Annotations as OA;

class SampleController
{
    /**
     * @Route("/v1/", methods={"GET"})
     *
     * @OA\Get(
     *      path="/v1/",
     *      @OA\Response(response=204, ref="#/components/responses/NoContent"),
     *      @OA\Response(response=400, ref="#/components/responses/BadRequest"),
     *      @OA\Response(response=500, ref="#/components/responses/InternalError")
     * )
     */
    public function get()
    {
        return new JsonResponse('OK', JsonResponse::HTTP_OK);
    }
}
