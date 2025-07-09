<?php
/**
 * EntityObserver
 *
 * @copyright Copyright © 2024 Magerserv LTD.. All rights reserved.
 * @author    mageserv.ltd@gmail.com
 */

namespace Mageserv\Yamm\Observer;


use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Model\AbstractModel;
use Mageserv\Yamm\Api\CronRepositoryInterface;

class EntityObserver implements ObserverInterface
{
    protected $cronRepository;
    protected $action;
    public function __construct(
        CronRepositoryInterface $cronRepository,
        $action = null
    )
    {
        $this->cronRepository = $cronRepository;
        $this->action = $action;
    }

    public function execute(Observer $observer)
    {
        /** @var AbstractModel $model */
        $model = $observer->getEvent()->getDataObject();
        if($this->action){
            $event = $model->getEventPrefix() . '.' . $this->action;
        }else{
            $event = $model->getEventPrefix() . '.update';
            if($model->isObjectNew()){
                $event = $model->getEventPrefix() . '.create';
            }
        }
        $this->cronRepository->createOrUpdateCron($event, $model->getId());
    }
}
