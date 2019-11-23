<?php
namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\KernelEvent;

use Umbra\Symfony\Http\Request\JsonExtractor;

class OnRequest implements EventSubscriberInterface
{
    /**
     * @var JsonExtractor
     */
    private $jsonExtractor;

    public function __construct(JsonExtractor $jsonExtractor)
    {
        $this->jsonExtractor = $jsonExtractor;
    }

    public static function getSubscribedEvents()
    {
        return array(
            KernelEvents::REQUEST => [
                ['collectJson', 10],
                ['mergeAllParameters', -10]
            ],
        );
    }

    public function collectJson(KernelEvent $event)
    {
        $request = $event->getRequest();

        if ($request->getContentType() != 'json' || !$request->getContent()) {
            return;
        }

        $data = $this->jsonExtractor->getJson($request);
        $request->request->add($data);
    }

    public function mergeAllParameters(KernelEvent $event)
    {
        $request = $event->getRequest();

        $request->attributes->add($request->query->all());
        $request->attributes->add($request->request->all());
    }
}
