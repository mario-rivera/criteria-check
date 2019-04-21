<?php
namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\KernelEvent;

use Umbra\Symfony\Http\Request\JsonExtractorInterface;

class JsonInput implements EventSubscriberInterface
{
    /**
     * @var JsonExtractorInterface
     */
    private $jsonExtractor;

    public function __construct(JsonExtractorInterface $jsonExtractor)
    {
        $this->jsonExtractor = $jsonExtractor;
    }

    public static function getSubscribedEvents()
    {
        return array(
            KernelEvents::REQUEST => 'onRequest',
        );
    }

    public function onRequest(KernelEvent $event)
    {
        $request = $event->getRequest();

        if ($request->getContentType() != 'json' || !$request->getContent()) {
            return;
        }

        $data = $this->jsonExtractor->getJson($request);
        $request->request->replace($data);
    }
}
