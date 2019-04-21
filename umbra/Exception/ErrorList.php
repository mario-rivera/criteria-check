<?php
namespace Umbra\Exception;

use Umbra\Exception\ErrorCodes;
use Throwable;

class ErrorList extends AbstractErrorList
{
    protected $defaultErrorCode;

    public function __construct($errors = null, $defaultErrorCode = null)
    {
        $this->setDefaultErrorCode($defaultErrorCode);
        $this->setErrors($errors);
    }

    public function setDefaultErrorCode($errorCode)
    {
        if (!is_int($errorCode)) {
            $errorCode = ErrorCodes::$general;
        }
        $this->defaultErrorCode = $errorCode;

        return $this;
    }

    public function getDefaultErrorCode()
    {
        return $this->defaultErrorCode;
    }

    public function setErrors($errors)
    {
        $this->reset();

        if (is_iterable($errors)) {
            return $this->bulkAdd($errors);
        }

        if (!empty($errors)) {
            return $this->add($errors);
        }

        return $this;
    }

    public function add($error, $code = null)
    {
        $message = ($error instanceof Throwable) ? $error->getMessage() : $error;
        $item = [
            'message' => $message,
            'code' => is_int($code) ? $code : $this->getDefaultErrorCode()
        ];

        $this->array[] = $item;

        return $this;
    }

    public function bulkAdd($errors, $code = null)
    {
        foreach ($errors as $error) {
            $this->add($error, $code);
        }

        return $this;
    }

    public function getErrors(): array
    {
        return $this->array;
    }
}
