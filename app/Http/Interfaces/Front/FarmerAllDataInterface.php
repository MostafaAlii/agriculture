<?php
namespace App\Http\Interfaces\Front;
interface FarmerAllDataInterface {
    public function get_farmer();
    public function farmer_detail($id);
}
?>