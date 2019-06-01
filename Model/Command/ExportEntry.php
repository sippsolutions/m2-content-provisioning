<?php
declare(strict_types=1);

namespace Firegento\ContentProvisioning\Model\Command;

use Firegento\ContentProvisioning\Api\Data\EntryInterface;
use Firegento\ContentProvisioning\Api\ExportInterface;
use Firegento\ContentProvisioning\Api\StrategyInterface;
use Firegento\ContentProvisioning\Model\Config\GenerateConfig;

class ExportEntry implements ExportInterface
{
    /**
     * @var GenerateConfig
     */
    private $generateConfig;

    /**
     * @param GenerateConfig $generateConfig
     */
    public function __construct(
        GenerateConfig $generateConfig
    ) {
        $this->generateConfig = $generateConfig;
    }

    /**
     * @inheritdoc
     */
    public function execute(StrategyInterface $strategy, EntryInterface $entry): void
    {
        $xmlContent = $this->generateConfig->toXml([$entry]);
        file_put_contents($strategy->getXmlPath(), $xmlContent);
    }
}