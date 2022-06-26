<?php
namespace App\Observers;
use App\Models\Product;
class ProductObserver {
    public function created(Product $product) {
        //
    }

    public function updated(Product $product) {
        $product->update(['status']);
    }

    public function deleted(Product $product) {
        //
    }

    public function restored(Product $product) {
        //
    }

    public function forceDeleted(Product $product) {
        //
    }
}
