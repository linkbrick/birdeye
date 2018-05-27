<?php
return [
    'sale_invoices' => [
        //column name in excel => column name in db
        "customer_code" => "customer_code",
        "customer_name" => "customer_name",
        "invoice_number" => "invoice_number",
        "invoice_date" => "invoice_date",
        "total_before_tax" => "total_before_tax",
        "tax" => "tax",
        "total" => "total"
    ],

    'ar_payments' => [
        //column name in excel => column name in db
        "payment_number" => "payment_number",
        "payment_date" => "payment_date",
        "payment_amount" => "payment_amount",
        "invoice_number" => ""
    ],

    'purchases' => [
        //column name in excel => column name in db
        "vendor_code" => "vendor_code",
        "vendor_name" => "vendor_name",
        "purchase_order_number" => "purchase_order_number",
        "purchase_date" => "purchase_date",
        "total_before_tax" => "total_before_tax",
        "tax" => "tax",
        "total" => "total"
    ],

    'ap_payments' => [
        //column name in excel => column name in db
        "payment_number" => "payment_number",
        "payment_date" => "payment_date",
        "payment_amount" => "payment_amount",
        "purchase_order_number" => ""
    ],
];
?>
