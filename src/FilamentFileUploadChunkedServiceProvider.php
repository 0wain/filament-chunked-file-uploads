<?php

namespace OwainJones74\FilamentFileUploadChunked;

use Filament\Support\Assets\AlpineComponent;
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
            AlpineComponent::make('file-upload-chunked',  __DIR__ . '/../dist/file-upload-chunked.js'),
        ], 'owainjones74/filament-file-upload-chunked');
    }
}
