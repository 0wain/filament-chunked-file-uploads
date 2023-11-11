<?php

namespace OwainJones74\FilamentFileUploadChunked\Forms\Components;

use Closure;
use Filament\Forms\Components\FileUpload;
use Illuminate\Support\Facades\Storage;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class FileUploadChunked extends FileUpload
{

    protected int | Closure $chunkSize = 50000000; // 50MB

    protected string $view = 'filament-file-upload-chunked::forms.components.file-upload-chunked';

    public string $file_name = '';

    public function chunkSize(int | Closure | null $chunkSize)
    {
        $this->chunkSize = $chunkSize;

        return $this;
    }

    public function getChunkSize()
    {
        return $this->evaluate($this->chunkSize);
    }

    public function callAfterStateUpdated(): static
    {
        $tempName = null;
        $tempFile = null; // = collect($this->getState())->first();


        foreach($this->getState() as $key => $file) {
            $tempName = $key;
            $tempFile = $file;

            break;
        }

        $finalPath = Storage::path('/livewire-tmp/' . $tempName);
        $tmpPath = Storage::path('/livewire-tmp/' . $tempFile->getFileName());
        $tempSize = $tempFile->getSize();

        $file = fopen($tmpPath, 'rb');
        $buff = fread($file, $this->chunkSize);
        fclose($file);

        $final = fopen($finalPath, 'ab');
        fwrite($final, $buff);
        fclose($final);
        unlink($tmpPath);

        if ($this->chunkSize > $tempSize) {
            $mimes = (new \Mimey\MimeTypes)->getExtension(mime_content_type($finalPath));

            Storage::move('/livewire-tmp/' . $tempName, '/livewire-tmp/' . $tempName . '.' . $mimes);

            $this->state([
                TemporaryUploadedFile::createFromLivewire('/' . $tempName . '.' . $mimes)
            ]);
        }

        return $this;
    }


    // Multiple upload is just too complicated, sue me.
    public function multiple(bool | Closure $condition = true): static
    {
        $this->isMultiple = false;

        return $this;
    }
}
