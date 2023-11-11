# Filament Chunked File Upload

This packages allows for chunking file uploads. It's VERY hacky and messy, but it works (I think).

## How to use
1. Install the package using `composer require owainjones74/filament-file-upload-chunke`
2. Import the package inside your Filament Resouce with `use OwainJones74\FilamentFileUploadChunked\Forms\Components\FileUploadChunked;`
3. Replace the built in file upload with the `FileUploadChunked` class.

## Things that don't work
- The file name is not preserved, it becomes a hash. It shows in the UI as the original file name, but once the form is submitted/saved, it shows as the hash.
- Only a single file is allowed to be uploaded for each UI component.
- The method for pulling the file type is not ideal, some file types may not be supported. `.dmg` files for example just don't work.

## Credits
- This is based on the existing file upload component in Filament, I just added the chunking functionality.

**Read the code at your own risk**