<?php
namespace NotaFiscalSP\Responses;

/**
 * Class BaseResponse
 * @package NotaFiscalSP\Responses
 */
abstract class BaseResponse{
    /**
     * @var
     */
    private $success;
    /**
     * @var
     */
    private $xmlInput;
    /**
     * @var
     */
    private $xmlOutput;

    /**
     * @return mixed
     */
    public function getSuccess()
    {
        return $this->success;
    }

    /**
     * @param mixed $success
     */
    public function setSuccess($success)
    {
        $this->success = $success;
    }

    /**
     * @return mixed
     */
    public function getXmlInput()
    {
        return $this->xmlInput;
    }

    /**
     * @param mixed $xmlInput
     */
    public function setXmlInput($xmlInput)
    {
        $this->xmlInput = $xmlInput;
    }

    /**
     * @return mixed
     */
    public function getXmlOutput()
    {
        return $this->xmlOutput;
    }

    /**
     * @param mixed $xmlOutput
     */
    public function setXmlOutput($xmlOutput)
    {
        $this->xmlOutput = $xmlOutput;
    }


}