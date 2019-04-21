<?php
namespace Docs\Schema;

/**
 * @OA\Schema()
 */
abstract class InvalidParameterMessage
{
    /**
     * @OA\Property(type="string", description="Error message.")
     */
    public $message;

    /**
     * @OA\Property(type="string", description="Parameter that produced the error.")
     */
    public $parameter;

    /**
     * @OA\Property(type="object", description="Meta field is NOT always present and could be of any data type.")
     */
    public $meta;
}
