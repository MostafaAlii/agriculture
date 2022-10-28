<?php
namespace App\Traits;
use App\Models\Image;
trait HasImageLive {
    /*public static function bootHasImage() {
        static ::deleting(function ($model) {
            $model->deleteImage();
        });
    }*/

    public function image() {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function storeImage($filename) {
        $image = $this->image()->create([
            'filename' => $filename,
        ]);
        return $image;
    }

    public function updateImage($filename) {
        if ($this->image) {
            $this->image->delete();
        }
        $this->storeImage($filename);
    }

    public function deleteImage() {
        if ($this->image) {
            $this->image->delete();
        }
    }

    public function forceDeleteImage() {
        if ($this->image) {
            $this->image->forceDelete();
        }
    }

    public function getImagePathAttribute() {
        $image = $this->image;
        if (! $image) {
            return null;
        }
        return asset('storage/' . $this->image->filename);
    }

    public function bulkDelete($images) {
        foreach ($images as $image) {
            $image->delete();
        }
    }

    public function forceBulkDelete($images) {
        foreach ($images as $image) {
            $image->forceDelete();
        }
    }
}