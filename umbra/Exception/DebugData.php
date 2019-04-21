<?php
namespace Umbra\Exception;

use Umbra\Exception\ErrorAbstractionInterface;

use JsonSerializable;
use Throwable;

class DebugData implements JsonSerializable
{
    /**
     * @var Throwable
     */
    private $error;

    public function __construct(Throwable $e)
    {
        $this->error = $e;
    }

    public function jsonSerialize()
    {
        $data = [
            'file' => $this->error->getFile(),
            'line' => $this->error->getLine(),
            'trace' => ($this->error instanceof ErrorAbstractionInterface) ?
                $this->error->getOriginalTrace() : $this->error->getTrace()
        ];

        return $data;
    }
}
