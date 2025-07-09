<?php

namespace Mageserv\Yamm\Api;

interface CronRepositoryInterface
{
    /**
     * Create or update cron item.
     *
     * @param \Mageserv\Yamm\Api\Data\CronItemInterface $cronItem
     * @return \Mageserv\Yamm\Api\Data\CronItemInterface
     * @throws \Magento\Framework\Exception\InputException If bad input is provided
     * @throws \Magento\Framework\Exception\State\InputMismatchException If Entity already exist
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(\Mageserv\Yamm\Api\Data\CronItemInterface $cronItem);

    /**
     * Retrieve list of cron schedules by type.
     *
     * @param string $type
     * @param array|int $status
     * @return \Mageserv\Yamm\Api\Data\CronItemInterface[]
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getByType($type, $status = 0);

    /**
     * Get cron schedule by ID
     *
     * @param int $taskId
     * @return \Mageserv\Yamm\Api\Data\CronItemInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($taskId);

    /**
     * Delete Cron Schedule.
     *
     * @param \Mageserv\Yamm\Api\Data\CronItemInterface $task
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(\Mageserv\Yamm\Api\Data\CronItemInterface $task);

    /**
     * Delete task by task ID.
     *
     * @param int $taskId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($taskId);

    /**
     * @param string $eventType
     * @param string $entityId
     * @return \Mageserv\Yamm\Api\Data\CronItemInterface
     */
    public function getCronByEntityId($eventType, $entityId);
    /**
     * @param string $eventType
     * @param string $entityId
     * @return \Mageserv\Yamm\Api\Data\CronItemInterface
     */
    public function createOrUpdateCron($eventType, $entityId);
}
