<?php
namespace Umbra\Api;

use Umbra\Exception\ErrorList;
use Umbra\Exception\DebugData;

use JsonSerializable;
use Throwable;

class ErrorResponseData implements JsonSerializable
{
    /**
     * @var DebugData
     */
    private $debugData;

    /**
     * @var ErrorList
     */
    protected $errorList;

    public function __construct($errors = null)
    {
        $this->setErrors($errors);
    }

    public function setErrors($errors)
    {
        if (!$errors instanceof ErrorList) {
            $errors = new ErrorList($errors);
        }
        
        return $this->setErrorList($errors);
    }

    public function setErrorList(ErrorList $list)
    {
        $this->errorList = $list;
        return $this;
    }

    public function getErrorList(): ErrorList
    {
        return $this->errorList;
    }

    public function setDebugData(Throwable $e)
    {
        $this->debugData = new DebugData($e);
        return $this;
    }

    public function getDebugData(): DebugData
    {
        return $this->debugData;
    }

    public function jsonSerialize()
    {
        $data = ['errors' => $this->errorList->getErrors()];

        if (!empty($this->getDebugData())) {
            $data['debug'] = $this->getDebugData();
        }

        return $data;
    }
}
