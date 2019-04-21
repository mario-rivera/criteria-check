<?php
namespace Umbra\Symfony\Http\Request;

use Symfony\Component\HttpFoundation\Request;

use Umbra\Symfony\Exception\BadRequestHttpException;

class JsonExtractor implements JsonExtractorInterface
{
    /**
     * @throws BadRequestHttpException
     */
    public function getJson(Request $request): array
    {
        $data = json_decode($request->getContent(), true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new BadRequestHttpException('invalid json body: ' . json_last_error_msg());
        }

        return is_array($data) ? $data : array();
    }
}
