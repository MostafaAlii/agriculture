<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Front\FarmerAllDataInterface;

class FarmerAllDataController extends Controller
{
    protected $Data;
    public function __construct(FarmerAllDataInterface $Data) {
        $this->Data = $Data;
    }
    
     
    public function get_farmer()
    {
        return $this->Data->get_farmer();
    }
     
    public function farmer_detail($id)
    {
        return $this->Data->farmer_detail($id);
    }
}
?>