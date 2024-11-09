<?php

namespace App\Services;


use phpseclib3\Net\SFTP;

class SFTPService
{
    protected $sftp;

    public function __construct($host, $port, $username, $password)
    {
        $this->sftp = new SFTP($host, $port);

        if (!$this->sftp->login($username, $password)) {
            throw new \Exception('Login Failed');
        }
    }

    public function uploadFile($localFilePath, $remoteFilePath)
    {
        return $this->sftp->put($remoteFilePath, $localFilePath, SFTP::SOURCE_LOCAL_FILE);
    }

    public function downloadFile($remoteFilePath, $localFilePath)
    {
        return $this->sftp->get($remoteFilePath, $localFilePath);
    }

    public function listFiles($directory = '.')
    {
        return $this->sftp->nlist($directory);
    }

    public function deleteFile($remoteFilePath)
    {
        return $this->sftp->delete($remoteFilePath);
    }
}
