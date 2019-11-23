<?php
namespace Umbra\Symfony\Http\Authorization;

class TokenValidator
{
    public function validate($token): bool
    {
        return ($token === getenv('AUTH_TOKEN'));
    }
}
