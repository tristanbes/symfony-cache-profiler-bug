<?php

declare(strict_types=1);

namespace AppBundle\Manager;

use Symfony\Component\Cache\Adapter\TagAwareAdapter;

class GlobalStatistics
{
    private $cache;

    public function __construct(TagAwareAdapter $cache)
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
        $item->tag(['tag1', 'tag2']);

        $this->cache->save($item);

        $item = $this->cache->getItem('statistics_players');

        return $item->get();
    }
}
