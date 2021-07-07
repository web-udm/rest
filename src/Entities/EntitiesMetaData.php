<?php

namespace App\Entities;

/**
 * Class MetaData
 * @package App\Entities
 */
class EntitiesMetaData
{
    private int $pageTotalCount;
    private int $limit;
    private int $totalCount;
    private int $page;

    /**
     * EntitiesMetaData constructor.
     *
     * @param int $pageTotalCount
     * @param int $limit
     * @param int $totalCount
     * @param int $page
     */
    public function __construct(int $pageTotalCount, int $limit, int $totalCount, int $page)
    {
        $this->pageTotalCount = $pageTotalCount;
        $this->limit          = $limit;
        $this->totalCount     = $totalCount;
        $this->page           = $page;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'page'               => $this->page,
            'page_total_count'   => $this->pageTotalCount,
            'entity_limit'       => $this->limit,
            'entity_total_count' => $this->totalCount,
        ];
    }
}
