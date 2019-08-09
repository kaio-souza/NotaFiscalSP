<?php
namespace NotaFiscalSP\Entities;

/**
 * Class WsdlBase
 * @package NotaFiscalSP\Entities
 */
class WsdlBase{
    /**
     * @var
     */
    private $wsdl;
    /**
     * @var
     */
    private  $endPoint;

    /**
     * @return mixed
     */
    public function getWsdl()
    {
        return $this->wsdl;
    }

    /**
     * @param mixed $wsdl
     */
    public function setWsdl($wsdl)
    {
        $this->wsdl = $wsdl;
    }

    /**
     * @return mixed
     */
    public function getEndPoint()
    {
        return $this->endPoint;
    }

    /**
     * @param mixed $endPoint
     */
    public function setEndPoint($endPoint)
    {
        $this->endPoint = $endPoint;
        $this->wsdl = $endPoint.'?WSDL';
    }


}