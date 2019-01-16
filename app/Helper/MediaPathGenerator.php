<?php

namespace App\Helpers;

use Spatie\MediaLibrary\Models\Media;
use Spatie\MediaLibrary\PathGenerator\PathGenerator;

class MediaPathGenerator implements PathGenerator
{
    public function getPath(Media $media) : string
    {
        return  "media/{$media->collection_name}/".jdate($media->created_at)->format('Ym')."$media->id/";
    }

    public function getPathForConversions(Media $media) : string
    {
        return $this->getPath($media).'conversion/';
    }

    public function getPathForResponsiveImages(Media $media): string
    {
        return $this->getPath($media).'responsive/';
    }
}
