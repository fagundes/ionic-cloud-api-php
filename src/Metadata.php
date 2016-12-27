<?php

namespace Ionic;

class Metadata extends Model
{
    /**
     * @var string
     */
    protected $request_id;

    /**
     * @var int
     */
    protected $status;

    /**
     * @var string
     */
    protected $version;

    /**
     * @return string
     */
    public function getRequestId()
    {
        return $this->request_id;
    }

    /**
     * @param string $request_id
     */
    public function setRequestId($request_id)
    {
        $this->request_id = $request_id;
    }

    /**
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @param string $version
     */
    public function setVersion($version)
    {
        $this->version = $version;
    }
}