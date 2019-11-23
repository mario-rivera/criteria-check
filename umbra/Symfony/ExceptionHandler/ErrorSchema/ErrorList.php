<?php
namespace Umbra\Symfony\ExceptionHandler\ErrorSchema;

use Throwable;

class ErrorList extends AbstractErrorList
{
    public function __construct(
        $errors = null
    ) {
        $this->setErrors($errors);
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

    public function add($error)
    {
        $item = ['message' => $error];

        switch ($error) {
            case $error instanceof Throwable:
                $item['message'] = $error->getMessage();
                break;

            case is_array($error) && array_key_exists('message', $error):
                $item = array_merge($item, $error);
                break;
        }

        $this->array[] = $item;
        return $this;
    }

    public function bulkAdd($errors)
    {
        foreach ($errors as $error) {
            $this->add($error);
        }

        return $this;
    }

    public function getErrors(): array
    {
        return $this->array;
    }
}
