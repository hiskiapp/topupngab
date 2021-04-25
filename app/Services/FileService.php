<?php

namespace Services;

use Illuminate\Support\Facades\Storage;

class FileService
{
    public function upload($file, $path = null)
    {
        if (!is_null($file)) {
            is_null($path) ?? $this->delete($path);

            $path = 'public/uploads/' . auth()->user()->id . '/';

            Storage::disk('local')->makeDirectory($path);

            $name = time() . '.' . $file->getClientOriginalExtension();

            Storage::putFileAs($path, $file, $name);

            return $path . $name;
        }

        return $path;
    }

    public function delete($path)
    {
        return Storage::delete($path);
    }
}
