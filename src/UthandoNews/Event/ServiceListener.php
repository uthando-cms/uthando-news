<?php
namespace UthandoNews\Event;

use Zend\EventManager\Event;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;
use Zend\EventManager\ListenerAggregateTrait;

class ServiceListener implements ListenerAggregateInterface
{
    use ListenerAggregateTrait;
    
    public function attach(EventManagerInterface $events)
    {
        $events = $events->getSharedManager();
        
        $this->listeners[] = $events->attach([
            'UthandoNews\Service\News'
        ], ['pre.form'], [$this, 'setSlug']);
    }
    
    public function setSlug(Event $e)
    {
        $data = $e->getParam('data');

        if (!$data['slug']) {
            $data['slug'] = $data['title'];
        }

        $e->setParam('data', $data);
    }
}
