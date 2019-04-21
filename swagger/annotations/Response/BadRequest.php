<?php
namespace Docs\Response;

/**
 * @OA\Response(
 *      response="BadRequest",
 *      description="The request could not be understood due to malformed syntax.",
 *      @OA\JsonContent(ref="#/components/schemas/StandardError")
 * )
 */
abstract class BadRequest
{
    
}
