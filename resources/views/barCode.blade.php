<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laravel Generate Barcode</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"/>

    <style>
        @media print {
            /* @page {
                size: 1in 0.7in;
                margin: 0;
            } */
            @page {
                    background-color: #ffffff;
                    size: 1in 0.7in;
                    /* size: auto; */
                    /* background-color: azure; */
                    vertical-align: top;
                    margin-top: 0;
                    /* <any of the usual CSS values for margins> */
                    margin-left: 1mm;
                    /* <any of the usual CSS values for margins> */
                    margin-right: 1mm;
                    /* <any of the usual CSS values for margins> */
                    margin-bottom: 0;
                    /* <any of the usual CSS values for margins> */
                    margin-header: 0;
                    /* <any of the usual CSS values for margins> */
                    margin-footer: 0;
                    /* <any of the usual CSS values for margins> */
                    marks: cross;
                    /*crop | cross | none*/

                }
            body {
                margin: 0;
            }
        }

    </style>
</head>
<body>
    <div class="container mt-2">
        {{-- <div class="mb-3">{!! DNS2D::getBarcodeHTML('4445645656', 'QRCODE') !!}</div> --}}
        <div class="">{!! DNS1D::getBarcodeHTML('4445645656', 'PHARMA') !!}</div>
        {{-- <div class="mb-3">{!! DNS1D::getBarcodeHTML('4445645656', 'PHARMA2T') !!}</div> --}}
        {{-- <div class="mb-3">{!! DNS1D::getBarcodeHTML('4445645656', 'CODABAR') !!}</div> --}}
        {{-- <div class="mb-3">{!! DNS1D::getBarcodeHTML('4445645656', 'KIX') !!}</div> --}}
        {{-- <div class="mb-3">{!! DNS1D::getBarcodeHTML('4445645656', 'RMS4CC') !!}</div> --}}
        {{-- <div class="mb-3">{!! DNS1D::getBarcodeHTML('4445645656', 'UPCA') !!}</div> --}}
        {{-- <img src="data:image/png;base64,{{ DNS2D::getBarcodePNG('#Al-Afiyah-Dialysis-Center#'. 1, 'QRCODE')}}" alt="barcode"style="width: 100px;" /> --}}
    </div>
</body>
</html>
<script>
    //javascript print window
    window.print();
    // window().print();
</script>
