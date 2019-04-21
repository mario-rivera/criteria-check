<?php
namespace Docs\Schema;

/**
 * @OA\Schema()
 */
abstract class ParameterValidationError
{
    /**
     * @OA\Property(
     *      type="array",
     *      description="An array of objects",
     *      @OA\Items(
     *          properties={
     *              @OA\Property(property="message", type="object", ref="#/components/schemas/InvalidParameterMessage"),
     *              @OA\Property(property="code", type="integer")
     *          }
     *      )
     * )
     */
    public $errors;
}
