<?php
namespace Docs\Schema;

/**
 * @OA\Schema(description="A flat object with a free number of properties and values.")
 */
abstract class PlainObject
{
     /**
     * @OA\Property(type="string", example="baz")
     */
    public $foo;

     /**
     * @OA\Property(type="string", example="bat")
     */
    public $bar;
}
