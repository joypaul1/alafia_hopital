<?php

namespace App\Helpers;

class InvoiceNumber{

    function invoice_num ($input,$prefix = null, $pad_len = 7) {
        if (is_string($prefix))
            return sprintf("%s%s", $prefix."-", str_pad($input, $pad_len, "0", STR_PAD_LEFT));

        return str_pad($input, $pad_len, "0", STR_PAD_LEFT);
    }
}
