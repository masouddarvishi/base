<?php

namespace App\Models;

use Spatie\MediaLibrary\File;
use App\Utility\Rate\Rateable;
use App\Utility\Rate\Methods\Stars;
use Spatie\MediaLibrary\Models\Media;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Post extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait, HasMediaRelation, Rateable;

    protected $perPage = 10;

    protected $fillable = [
        'user_id', 'title', 'slug', 'image', 'abstract', 'body',
    ];

    protected $casts = [
        'deleted_at'    =>  'datetime',
        'published_at'  =>  'datetime',
        'created_at'    =>  'datetime',
        'updated_at'    =>  'datetime',
    ];

    //  =============================== Relationships =========================
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function banner(): MorphToMany
    {
        return $this->mediagroups()->where('media_relations.collection_name', enum('media.post.banner'));
    }

    public function attaches(): MorphToMany
    {
        return $this->mediagroups()->where('media_relations.collection_name', enum('media.post.attach'));
    }

    private function mediagroups(): MorphToMany
    {
        return $this->morphToMany(Media::class, 'model', 'media_relations');
    }

    //  =============================== End Relationships =====================

    public function registerMediaCollections()
    {
        //  Register media collection for avatar that only accepts images
        $this->addMediaCollection(enum('media.post.banner'))
            ->acceptsFile(function (File $file) {
                $allowedMimes = [
                    'image/jpeg', 'image/png', 'image/tiff', 'image/bmp',
                ];

                return in_array($file->mimeType, $allowedMimes);
            })
            ->singleFile();

        $this->addMediaCollection(enum('media.post.attach'));
    }

    public function getRateFormat(): RateFormat
    {
        return RateFormat::make([
            'name' => 'laptop',
            'slug' => 'laptop',
            'collection_name' => self::class,
            'description' => 'لپ تاپ ها',
            'values' => ['key' => 'star'],
            'type' => Stars::class,
        ]);
    }
}

//    public function banner(): HasManyThrough
//    {
//        return $this->hasManyThrough(
//            Media::class,
//            MediaRelation::class,
//            'model_id',
//            'id',
//            'id',
//            'media_id'
//        )
//            ->where('media_relations.model_type', self::class)
//            ->where('media_relations.collection_name', enum('media.post.banner'));
//    }
//
//    public function attaches(): HasManyThrough
//    {
//        return $this->hasManyThrough(
//            Media::class,
//            MediaRelation::class,
//            'model_id',
//            'id',
//            'id',
//            'media_id'
//        )
//            ->where('media_relations.model_type', self::class)
//            ->where('media_relations.collection_name', enum('media.post.attach'));
//    }
