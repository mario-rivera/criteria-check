<?php
namespace App\Request\Validation;

use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Constraints;

use Symfony\Component\HttpFoundation\ParameterBag;

class CityCriteriaValidator
{
    /**
     * @var ValidatorInterface
     */
    private $validator;

    public function __construct(
        ValidatorInterface $validator
    ) {
        $this->validator = $validator;
    }

    /**
     * @param ParameterBag $params
     * @return ConstraintViolationListInterface
     */
    public function validate(ParameterBag $params): ConstraintViolationListInterface
    {
        $violations = $this->validator->validate($params->all(), new Constraints\Collection([
            'allowExtraFields' => true,
            'fields' => [
                \App\Controller\CriteriaCheckController::PARAM_CITY => [
                    new Constraints\NotBlank()
                ],
            ]
        ]));

        return $violations;
    }
}
