<?php

namespace SamedayCourier\Shipping\Helper;

use SamedayCourier\Shipping\Api\PickupPointRepositoryInterface;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use SamedayCourier\Shipping\Api\ServiceRepositoryInterface;

class StoredDataHelper extends AbstractHelper
{
    private $pickupPointRepository;
    private $serviceRepository;

    public function __construct(Context $context,
                                PickupPointRepositoryInterface $pickupPointRepository,
                                ServiceRepositoryInterface $serviceRepository)
    {
        parent::__construct($context);

        $this->pickupPointRepository = $pickupPointRepository;
        $this->serviceRepository = $serviceRepository;
    }

    private function isTesting()
    {
        return (bool) $this->scopeConfig->getValue('carriers/samedaycourier/testing');
    }

    public function getPickupPoints()
    {
        return $this->pickupPointRepository->getListByTesting($this->isTesting());
    }

    public function getServices()
    {
        return $this->serviceRepository->getAllActiveByTesting($this->isTesting());
    }
}
