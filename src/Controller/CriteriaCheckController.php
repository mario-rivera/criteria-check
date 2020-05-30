<?php
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

use Umbra\Symfony\Exception\BadInputException;
use Umbra\Symfony\Exception\HttpException;

class CriteriaCheckController
{
    const PARAM_CITY = 'city';

    /**
     * @Route("/check/", methods={"GET"})
     */
    public function get(
        Request $request,
        \App\Request\Validation\CityCriteriaValidator $cityCriteriaValidator,
        \Service\CriteriaCheck\CityWeather\CriteriaManager $criteriaManager
    ) {
        // validate request
        $violations = $cityCriteriaValidator->validate($request->query);
        if ($violations->count() > 0) {
            throw new BadInputException($violations);
        }

        try {
            $city = $request->query->get(self::PARAM_CITY);
            $result = $criteriaManager->check($city);
        } catch(\Service\CriteriaCheck\Exception\CityNotFound $e) {
            throw new HttpException(JsonResponse::HTTP_NOT_FOUND, $e->getMessage());
        }

        return new JsonResponse($result, JsonResponse::HTTP_OK);
    }
}
