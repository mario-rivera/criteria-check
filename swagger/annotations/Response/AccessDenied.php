<?php
namespace Docs\Response;

/**
 * @OA\Response(
 *      response="AccessDenied",
 *      description="The endpoint requires authentication.",
 *      @OA\JsonContent(ref="#/components/schemas/StandardError")
 * )
 */
abstract class AccessDenied
{
    
}
