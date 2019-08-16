<?php

namespace NotaFiscalSP\Entities;

/**
 * Class PeriodQueryInformation
 * @package NotaFiscalSP\Entities
 */
class PeriodQueryInformation
{
    /**
     * @var
     * Format YYYY-mm-dd
     */
    private $startDate;
    /**
     * @var
     * Format YYYY-mm-dd
     */
    private $endDate;
    /**
     * @var
     */
    private $cnpj;

    /**
     * @var
     */
    private $page;

    /**
     * @return mixed
     */
    public function getPage()
    {
        return $this->page ? $this->page : 1;
    }

    /**
     * @param mixed $page
     */
    public function setPage($page)
    {
        $this->page = $page;
    }

    /**
     * @return mixed
     */
    public function getStartDate()
    {
        return $this->startDate ? $this->startDate : date('Y-m-d');;
    }

    /**
     * @param mixed $startDate
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;
    }

    /**
     * @return mixed
     */
    public function getEndDate()
    {
        return $this->endDate ? $this->endDate : date('Y-m-d');
    }

    /**
     * @param mixed $endDate
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;
    }

    /**
     * @return mixed
     */
    public function getCnpj()
    {
        return $this->cnpj;
    }

    /**
     * @param mixed $cnpj
     */
    public function setCnpj($cnpj)
    {
        $this->cnpj = $cnpj;
    }
}