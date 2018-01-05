<?php

declare(strict_types=1);

namespace AppBundle\Manager;

use Symfony\Component\Cache\Adapter\AdapterInterface;

class GlobalStatistics
{
    private $cache;

    public function __construct(AdapterInterface $cache)
    {
        $this->cache = $cache;
    }

    public function getStatistics()
    {
        $item = $this->cache->getItem('statistics_players');

        if ($item->isHit()) {
            return $item->get();
        }

        $item->set(99);
        $this->cache->save($item);

        $item = $this->cache->getItem('statistics_players');
        dump($item);

        return $item->get();
    }
}
