<?php
namespace Docs\Schema;

/**
 * @OA\Schema()
 */
abstract class StandardError
{
    /**
     * @OA\Property(
     *      type="array",
     *      description="An array of objects",
     *      @OA\Items(
     *          properties={
     *              @OA\Property(property="message", type="string", description="Message could also be an object|array."),
     *              @OA\Property(property="code", type="integer")
     *          }
     *      )
     * )
     */
    public $errors;
}
