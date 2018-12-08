<?php
/**
 * Created by PhpStorm.
 * User: stanciuvalentin
 * Date: 08/12/2018
 * Time: 09:35
 */

namespace LoanApplication;


class AcceptOfferCommand
{
    /**
     * @var Int
     */
    private $applicationId;
    /**
     * @var Int
     */
    private $offerId;

    /**
     * AcceptOfferCommand constructor.
     * @param Int $applicationId
     * @param Int $offerId
     */
    public function __construct(Int $applicationId, Int $offerId)
    {

        $this->applicationId = $applicationId;
        $this->offerId = $offerId;
    }

    public function getId() {
        return $this->applicationId;
    }


    public function getOfferId()
    {
        return $this->offerId;
    }
}