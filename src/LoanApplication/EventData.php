<?php
declare(strict_types=1);


namespace LoanApplication;

class EventData
{
    /**
     * @var string
     */
    private $id;
    /**
     * @var \DateTime
     */
    private $created;
    /**
     * @var string
     */
    private $aggregateType;
    /**
     * @var string
     */
    private $aggregateId;
    /**
     * @var int
     */
    private $version;
    /**
     * @var string
     */
    private $event;
    /**
     * @var string
     */
    private $metadata;

    /**
     * EventData constructor.
     * @param string $id
     * @param \DateTime $created
     * @param string $aggregateType
     * @param string $aggregateId
     * @param int $version
     * @param string $event
     * @param string $metadata
     */
    public function __construct(
        string $id,
        \DateTime $created,
        string $aggregateType,
        string $aggregateId,
        int $version,
        string $event,
        string $metadata
    ) {
        $this->id = $id;
        $this->created = $created;
        $this->aggregateType = $aggregateType;
        $this->aggregateId = $aggregateId;
        $this->version = $version;
        $this->event = $event;
        $this->metadata = $metadata;
    }
}