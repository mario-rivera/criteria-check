<?php
namespace Docs\Response;

/**
 * @OA\Response(
 *      response="InternalError",
 *      description="Application Error",
 *      @OA\JsonContent(ref="#/components/schemas/StandardError")
 * )
 */
abstract class InternalError
{
    
}
