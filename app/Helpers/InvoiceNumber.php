<?php

namespace App\Helpers;

class InvoiceNumber{

    function invoice_num ($input,$prefix = null, $pad_len = 7) {
        // if ($pad_len <= strlen($input))
            // trigger_error('<strong>' .$pad_len. '</strong> cannot be less than or equal to the length of <strong>' .$input. '
            // </strong> to generate invoice number', E_USER_ERROR);
    
        if (is_string($prefix))
            return sprintf("%s%s", $prefix."-", str_pad($input, $pad_len, "0", STR_PAD_LEFT));
    
        return str_pad($input, $pad_len, "0", STR_PAD_LEFT);
    }
}