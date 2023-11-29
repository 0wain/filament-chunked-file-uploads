# Filament Chunked File Upload

This packages allows for chunking file uploads. It's VERY hacky and messy, but it works (I think). I wrote this package to work around the 100MB Cloudflare limit. 

## How to use
1. Install the package using `composer require owainjones74/filament-file-upload-chunked`
2. Import the package inside your Filament Resouce with `use OwainJones74\FilamentFileUploadChunked\Forms\Components\FileUploadChunked;`
3. If required, publish the javascript file `php artisan filament:assets`.
4. Replace the built in file upload with the `FileUploadChunked` class.

## Docs
The only additional chained method you can add when defining this component in your schema is `->chunkSize(int|closure)`. This will allow you to set the chunk size in bytes. The default is 50MB.

## Things that don't work
- The file name is not preserved, it becomes a hash. It shows in the UI as the original file name, but once the form is submitted/saved, it shows as the hash.
- Only a single file is allowed to be uploaded for each UI component.
- The method for pulling the file type is not ideal, some file types may not be supported. `.dmg` files for example just don't work.

## Credits
- This is based on the existing file upload component in Filament, I just added the chunking functionality.

**Read the code at your own risk**
