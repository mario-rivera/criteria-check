<?php
namespace Umbra\Symfony\Http\Authorization;

use Symfony\Component\HttpFoundation\HeaderBag;

class TokenExtractor
{
    protected static $headerName = 'Authorization';

    public function getTokenFromHeaders(HeaderBag $headers)
    {
        $value = $headers->get(self::$headerName);
        $exploded = explode(' ', $value, 2);

        return (count($exploded) === 2) ? trim($exploded[1]) : null;
    }
}
