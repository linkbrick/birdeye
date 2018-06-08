<?php
return [
    'invoices' => [
        "title" => "Invoices",
        "icon" => "assignment",
        "columns" => [
            [
                "label" => "Customer Code",
                "name" => "customer_code",
                "type" => "string"
            ],
            [
                "label" => "Customer Name",
                "name" => "customer_name",
                "type" => "string"
            ],
            [
                "label" => "Invoice Number",
                "name" => "invoice_number",
                "type" => "string"
            ],
            [
                "label" => "Invoice Date",
                "name" => "invoice_date",
                "type" => "date"
            ],
            [
                "label" => "Total Before Tax",
                "name" => "total_before_tax",
                "type" => "decimal"
            ],
            [
                "label" => "Tax",
                "name" => "tax",
                "type" => "decimal"
            ],
            [
                "label" => "Total",
                "name" => "total",
                "type" => "decimal"
            ],
        ]
    ],

    'account_receivables' => [
        "title" => "Account Receivables",
        "icon" => "exposure_plus_1",
        "columns" => [
            [
                "label" => "Invoice ID",
                "name" => "invoice_id",
                "type" => "string"
            ],
            [
                "label" => "Payment Amount",
                "name" => "payment_amount",
                "type" => "decimal"
            ],
            [
                "label" => "Payment Date",
                "name" => "payment_date",
                "type" => "date"
            ],
        ]
    ],

    'bills' => [
        "title" => "Bills",
        "icon" => "shop",
        "columns" => [
            [
                "label" => "Vendor Code",
                "name" => "vendor_code",
                "type" => "string"
            ],
            [
                "label" => "Vendor Name",
                "name" => "vendor_name",
                "type" => "string"
            ],
            [
                "label" => "Bill Number",
                "name" => "bill_number",
                "type" => "string"
            ],
            [
                "label" => "Bill Date",
                "name" => "bill_date",
                "type" => "date"
            ],
            [
                "label" => "Total Before Tax",
                "name" => "total_before_tax",
                "type" => "decimal"
            ],
            [
                "label" => "Tax",
                "name" => "tax",
                "type" => "decimal"
            ],
            [
                "label" => "Total",
                "name" => "total",
                "type" => "decimal"
            ],
        ]
    ],

    'account_payables' => [
        "title" => "Account Payables",
        "icon" => "exposure_neg_1",
        "columns" => [
            [
                "label" => "Bill ID",
                "name" => "bill_id",
                "type" => "string"
            ],
            [
                "label" => "Payment Amount",
                "name" => "payment_amount",
                "type" => "decimal"
            ],
            [
                "label" => "Payment Date",
                "name" => "payment_date",
                "type" => "date"
            ],
        ]
    ],
];
?>
