<?php

namespace OwainJones74\FilamentFileUploadChunked;

use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentFileUploadChunkedServiceProvider extends PackageServiceProvider
{

    public function configurePackage(Package $package): void
    {
        $package
            ->name('filament-file-upload-chunked')
            ->hasViews();
    }

    public function packageBooted()
    {
        FilamentAsset::register([
            Js::make('file-upload-chunked', __DIR__ . '/../resources/js/file-upload-chunked.js'),
        ], 'owainjones74/filament-file-upload-chunked');
    }
}
