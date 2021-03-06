<?php
/**
 * NewRelic2 plugin for Magento
 *
 * @package     Yireo_NewRelic2
 * @author      Yireo (https://www.yireo.com/)
 * @copyright   Copyright 2015 Yireo (https://www.yireo.com/)
 * @license     Simplified BSD License
 */

namespace Yireo\NewRelic2\Model\Observer;

/**
 * Class Crontab
 *
 * @package Yireo\NewRelic2\Model\Observer
 */
class Crontab implements \Magento\Framework\Event\ObserverInterface
{
    /**
     * @var \Yireo\NewRelic2\Model\Service\Agent
     */
    protected $agent;

    /**
     * @var \Yireo\NewRelic2\Helper\Data
     */
    protected $helper;

    /**
     * @param \Yireo\NewRelic2\Model\Service\Agent $agent
     * @param \Yireo\NewRelic2\Helper\Data $helper
     */
    public function __construct(
        \Yireo\NewRelic2\Model\Service\Agent $agent,
        \Yireo\NewRelic2\Helper\Data $helper
    )
    {
        $this->agent = $agent;
        $this->helper = $helper;
    }

    /**
     * Listen to the cron event always
     *
     * @param \Magento\Framework\Event\Observer $observer
     * @return $this
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        if (!$this->helper->isEnabled()) {
            return $this;
        }

        $this->agent->setBackgroundJob(true);
    }
}