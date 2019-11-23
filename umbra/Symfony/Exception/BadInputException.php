<?php
namespace Umbra\Symfony\Exception;

use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\ConstraintViolation;
use ArrayAccess;

class BadInputException extends BadRequestHttpException implements
    PublicExceptionInterface,
    MultipleErrorsExceptionInterface
{
    /**
     * @var ArrayAccess
     */
    protected $errors;

    /**
     * @param string     $message  The internal exception message
     * @param \Throwable $previous The previous exception
     * @param int        $code     The internal exception code
     */
    public function __construct(ArrayAccess $errors, \Throwable $previous = null, int $code = 0, array $headers = [])
    {
        $this->errors = $errors;
        parent::__construct('Input validation failed.', $previous, $code, $headers);
    }

    public function getErrors(): array
    {
        $errors = [];
        foreach ($this->errors as $error) {
            $errors[] = $this->formatError($error);
        }

        return $errors;
    }

    /**
     * @param mixed $error
     */
    public function formatError($error)
    {
        $formatted = ['message' => null];

        if ($error instanceof ConstraintViolationInterface) {
            $formatted['message'] = $error->getMessage();
            $formatted['parameter'] = $error->getPropertyPath();

            if ($error instanceof ConstraintViolation) {
                $formatted['meta'] = $error->getConstraint()->payload;
            }
        } else {
            $formatted['message'] = $error;
        }

        return $formatted;
    }
}
