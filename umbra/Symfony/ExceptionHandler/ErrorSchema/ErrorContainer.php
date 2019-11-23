<?php
namespace Umbra\Symfony\ExceptionHandler\ErrorSchema;

use JsonSerializable;
use Throwable;

class ErrorContainer implements JsonSerializable
{
    private $debugData;
    private $errorList;

    public function __construct($errors = null)
    {
        $this->setErrors($errors);
    }

    public function setErrors($errors)
    {
        if (!$errors instanceof ErrorList) {
            $errors = new ErrorList($errors);
        }

        $this->errorList = $errors;

        return $this;
    }

    public function setDebugData(Throwable $e)
    {
        $this->debugData = [
            'file' => $e->getFile(),
            'line' => $e->getLine()
        ];

        $this->debugData['trace'] = ($e instanceof ErrorAbstractionInterface) ?
            $e->getOriginalTrace() : $e->getTrace();

        return $this;
    }

    public function jsonSerialize()
    {
        $data = ['errors' => $this->errorList->getErrors()];

        if (!empty($this->debugData)) {
            $data['debug'] = $this->debugData;
        }

        return $data;
    }
}
