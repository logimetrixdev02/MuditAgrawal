<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParSaleReport extends Model
{
    protected $fillable = ['Customer_No', 'Customer_Name', 'Dealer_Location_City', 'Invoice_No','Billing_Type',
    'Invoice_Date','Division','Description','Material_Type','Quantity'];
    use HasFactory;
    protected $table = 'psr_sale_report';
  
}
