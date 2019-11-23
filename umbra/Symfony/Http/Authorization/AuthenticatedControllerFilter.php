<?php
namespace Umbra\Symfony\Http\Authorization;

use Symfony\Component\HttpKernel\Event\ControllerEvent;

use Umbra\Symfony\Controller\TokenAuthenticatedInterface;
use Umbra\Symfony\Http\Authorization\TokenExtractorInterface;
use Umbra\Symfony\Http\Authorization\TokenValidatorInterface;

use Umbra\Symfony\Exception\AccessDeniedHttpException;

class AuthenticatedControllerFilter implements AuthenticatedControllerFilterInterface
{
    /**
     * @var TokenExtractorInterface
     */
    private $tokenExtractor;

    /**
     * @var TokenValidatorInterface
     */
    private $tokenValidator;

    public function __construct(
        TokenExtractorInterface $tokenExtractor,
        TokenValidatorInterface $tokenValidator
    ) {
        $this->tokenExtractor = $tokenExtractor;
        $this->tokenValidator = $tokenValidator;
    }

    /**
     * @throws AccessDeniedHttpException
     */
    public function filter(ControllerEvent $event)
    {
        if ($this->needsAuthorization($event->getController())) {
            $token = $this->tokenExtractor->getTokenFromHeaders($event->getRequest()->headers);
            if (!$this->tokenValidator->validate($token)) {
                throw new AccessDeniedHttpException('This action needs a valid api token.');
            }
        }
    }

    private function needsAuthorization($controller): bool
    {
        /*
        * $controller passed can be either a class or a Closure.
        * This is not usual in Symfony but it may happen.
        * If it is a class, it comes in array format
        */
        return (
            is_array($controller) &&
            $controller[0] instanceof TokenAuthenticatedInterface
        );
    }
}
