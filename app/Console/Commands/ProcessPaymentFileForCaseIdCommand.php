<?php

namespace App\Console\Commands;

use App\Services\SFTPService;
use App\Traits\FileUploadParse;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProcessPaymentFileForCaseIdCommand extends Command
{

    use FileUploadParse;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:process-payment-file-for-case-id-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     * @throws \Exception
     */
    public function handle()
    {
        $sftp_host = config('app.sftp_host');
        $sftp_port = config('app.sftp_port');
        $sftp_username = config('app.sftp_username');
        $sftp_password = config('app.sftp_password');
        $sftpService = new SFTPService(
            $sftp_host,
            $sftp_port,
            $sftp_username,
            $sftp_password
        );

        $sftp_path = config('app.sftp_path');

        $fileLists = $sftpService->listFiles($sftp_path);

        foreach ($fileLists as $file) {
            $mimeType = explode('.', $file);
            if (isset($mimeType[1]) && $mimeType[1] === 'txt') {
                $this->makeDir(public_path('app/Admin/FileUpload/Incoming/'));

                $content = Storage::get($file);
                Storage::put(public_path('app/Admin/FileUpload/Incoming/'), $content);

                $f = $sftpService->downloadFile($sftp_path.'/'.$file, public_path('app/Admin/FileUpload/Incoming/'));
                //$sftpService->uploadFile($sftp_path, '');
                dd($file, $fileLists, $mimeType, $f, $file, public_path('app/Admin/FileUpload/Incoming/'));
            }
        }
    }
}
