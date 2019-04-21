<?php
namespace Umbra\Serializer;

interface JsonSerializerInterface
{
    public function serialize($input): array;
}
