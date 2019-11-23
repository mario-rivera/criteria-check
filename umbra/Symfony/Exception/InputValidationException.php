<?php
namespace Umbra\Symfony\Exception;

use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\HttpFoundation\Response;
use Exception;

class InputValidationException extends Exception implements
    MultipleErrorsExceptionInterface,
    PublicExceptionInterface,
    HttpExceptionInterface
{
    protected $constraintList;

    public function __construct(ConstraintViolationListInterface $errors, $message = 'Input validation failed.', $code = 0, Exception $previous = null)
    {
        $this->setConstraintList($errors);
        parent::__construct($message, $code, $previous);
    }
    
    public function setConstraintList(ConstraintViolationListInterface $errors)
    {
        $this->constraintList = $errors;
        return $this;
    }
    
    public function getErrors(): array
    {

        return $this->mapConstraintList();
    }

    public function getStatusCode()
    {
        return Response::HTTP_BAD_REQUEST;
    }

    public function getHeaders()
    {
        return [];
    }

    protected function mapConstraintList()
    {
        $map = [];
        foreach ($this->constraintList as $constraintViolation) {
            $error = $this->formatConstraintViolation($constraintViolation);
            $map[] = $error;
        }

        return $map;
    }

    protected function formatConstraintViolation(ConstraintViolationInterface $constraintViolation)
    {
        $error = ['message' => $constraintViolation->getMessage(), 'parameter' => $constraintViolation->getPropertyPath()];

        if (!is_null($constraintViolation->getConstraint()->payload)) {
            $error['meta'] = $constraintViolation->getConstraint()->payload;
        }

        return $error;
    }
}
