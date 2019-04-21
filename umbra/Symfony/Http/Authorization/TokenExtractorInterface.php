<?php
namespace Umbra\Symfony\Http\Authorization;

use Symfony\Component\HttpFoundation\HeaderBag;

interface TokenExtractorInterface
{
    public function getTokenFromHeaders(HeaderBag $headers);
}
