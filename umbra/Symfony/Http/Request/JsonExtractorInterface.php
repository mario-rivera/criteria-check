<?php
namespace Umbra\Symfony\Http\Request;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

interface JsonExtractorInterface
{
    /**
     * @throws BadRequestHttpException
     */
    public function getJson(Request $request): array;
}
