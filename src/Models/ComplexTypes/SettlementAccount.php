<?php

namespace Noldors\CommerceMLParser\Models\ComplexTypes;

/**
 * Тип расчетный счет.
 *
 * @package Noldors\CommerceMLParser\Models\ComplexTypes
 */
class SettlementAccount
{
    /**
     * Номер счета.
     *
     * @var string
     */
    protected $accountNumber;

    /**
     * Банк.
     *
     * @var \Noldors\CommerceMLParser\Models\ComplexTypes\Bank
     */
    protected $bank;

    /**
     * Банк корреспондент.
     *
     * @var \Noldors\CommerceMLParser\Models\ComplexTypes\Bank
     */
    protected $correspondentBank;

    /**
     * Комментарий.
     *
     * @var string
     */
    protected $comment;

    /**
     * SettlementAccount constructor.
     *
     * @param \SimpleXMLElement|null $xml
     */
    public function __construct(\SimpleXMLElement $xml = null)
    {
        if (is_null($xml)) {
            return;
        }

        $this->accountNumber = (string)$xml->НомерСчета;

        if ($xml->Банк) {
            $this->bank = new Bank($xml->Банк);
        }

        if ($xml->БанкКорреспондент) {
            $this->correspondentBank = new Bank($xml->БанкКорреспондент);
        }

        $this->comment = (string)$xml->Комментарий;
    }

    /**
     * Получить номер счета.
     *
     * @return string
     */
    public function getAccountNumber()
    {
        return $this->accountNumber;
    }

    /**
     * Получить информацию о банке.
     *
     * @return \Noldors\CommerceMLParser\Models\ComplexTypes\Bank
     */
    public function getBank()
    {
        return $this->bank;
    }

    /**
     * Получить информацию о банке корреспонденте.
     *
     * @return \Noldors\CommerceMLParser\Models\ComplexTypes\Bank
     */
    public function getCorrespondentBank()
    {
        return $this->correspondentBank;
    }

    /**
     * Получить комментарий.
     *
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }
}