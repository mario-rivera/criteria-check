<?php
namespace Umbra\Symfony\Http\Authorization;

interface TokenValidatorInterface
{
    public function validate($token): bool;
}
