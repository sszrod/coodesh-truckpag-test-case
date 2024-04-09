<?php

use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

if (! function_exists('uncompress_gzip_file')) {
    function uncompress_gzip_file(string $path, array $files)
    {
        foreach ($files as $file) {
            $parts = explode('/', $file);
            $fileName = $parts[count($parts)-1];

            $commandString = "cd storage/$path";
            $commandString .= " && gzip -d $fileName";

            $process = Process::fromShellCommandline($commandString);
            $process->run();

            if (!$process->isSuccessful()) {
                throw new ProcessFailedException($process);
            }
        }
    }
}

if (! function_exists('delete_trash_files')) {
    function delete_trash_files() {
        $process = Process::fromShellCommandline('rm -rf storage/app/public/openfoodsfacts');
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }
    }
}
