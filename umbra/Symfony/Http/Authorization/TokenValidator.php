<?php
namespace Umbra\Symfony\Http\Authorization;

class TokenValidator implements TokenValidatorInterface
{
    public function validate($token): bool
    {
        return ($token === getenv('APP_SECRET'));
    }
}
