<?php

namespace App\Imports;
use App\Helpers\Qs;
use App\Models\ParSaleReport;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        $invoice = new Qs();
        // formateExcelDate();
// $subscribers = $service->formateExcelDate();
        return new ParSaleReport([
            'Customer_No'     => $row['customer_no'],
            'Customer_Name'    => $row['customer_name'], 
            'Dealer_Location_City'    => $row['dealer_location_city'], 
            'Invoice_No'    => $row['invoice_no'], 
            'Billing_Type'    => $row['billing_type'], 
            // 'Invoice_Date'    => $row['invoice_date'], 
                 'Invoice_Date'  => $invoice->formateExcelDate($row['invoice_date']),
            'Division'    => $row['division'], 
            'Description'    => $row['description'], 
            'Material_Type'    => $row['material_type'], 
            'Quantity'    => $row['quantity'], 
           
            
        ]);
    }
}
