<?php
namespace Docs\Response;

/**
 * @OA\Response(
 *      response="NotFound",
 *      description="Resource not found.",
 *      @OA\JsonContent(ref="#/components/schemas/StandardError")
 * )
 */
abstract class NotFound
{
    
}
