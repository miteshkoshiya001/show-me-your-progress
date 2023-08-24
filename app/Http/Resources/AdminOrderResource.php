<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Product;
use App\Models\Category;

class AdminOrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // Get All Product's category list
        $orderItems = $this->orderItems ?? [];
        $color = '';
        $error = 'error';
        try {
            if (!empty($orderItems)) {
                $productIds = $orderItems->pluck('product_id');
                $categoryIds = Product::whereIn('id', $productIds)->pluck('category_id');
                $categoryColors = Category::select(['color'])->whereIn('id', $categoryIds)->where('is_important', 1)->pluck('color')->toArray();
                $color = current($categoryColors);
            }
        } catch (\Exception $e) {
            $error = $e->getMessage();
        }
        return [
            'id' => $this->id,
            'phone' => !empty($this->user) ? $this->user->phone : '',
            'name' => !empty($this->user) ? $this->user->name : '',
            'order_id' => $this->order_id,
            'order_total' => '₹'.$this->order_total,
            'status_label' => $this->status_label,
            'zipcode' => !empty($this->deliveryAddress) ? $this->deliveryAddress->zipcode : '',
            'address1' => !empty($this->deliveryAddress) ? $this->deliveryAddress->address1 : '',
            'assigned_id' => $this->assigned_id,
            'assigned_name' => $this->assigned != null ? $this->assigned->name : 'Unassigned',
            'error' => $error,
            'color' => $color != '' ? $this->hexToRGBA($color) : false,
            'orderItems' => $orderItems
        ];
    }
    
    public function hexToRGBA($hex) {
      // Remove "#" symbol if it exists
      $hex = str_replace("#", "", $hex);
    
      // Split the hexadecimal color code into its red, green, and blue components
      $red = hexdec(substr($hex, 0, 2));
      $green = hexdec(substr($hex, 2, 2));
      $blue = hexdec(substr($hex, 4, 2));
    
      // Set the alpha value to 255 (fully opaque)
      $alpha = 0.2;
    
      // Return the ARGB color code
      return "rgba($red, $green, $blue, $alpha)";
    }
}
