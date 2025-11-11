<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bulk Print QR Codes</title>
    <style>
        body, h1, h2, h3, h4, h5, h6 {
            font-family: Arial, sans-serif;
        }
        body { background-color: #FAFAFA; font-size: 10pt; }
        .page {
            width: 210mm;
            height: 297mm;
            margin: 0 auto;
            font-family: Arial,Helvetica Neue,Helvetica,sans-serif;
            background: white;
            page-break-after: always;
            display: block;
            padding-top: 1.3cm;
            margin-bottom: 20px;
        }
        a {
            color: #50A8E7;
            text-decoration: none;
        }
        label {
            margin: 0;
        }
        p {
            margin: 0;
            line-height: 1.3rem;
            font-size: 9px;
        }
        @page {
            size: A4;
            margin: 0 auto;
        }
        @media print {
            @page {
                size: A4;
                margin: 0 auto;
            }
        }
    </style>
</head>
<body>
    @php
        $assetsCount = count($assets);
        $perPage = 12;
        $pages = ceil($assetsCount / $perPage);
        $chunks = array_chunk($assets->toArray(), $perPage);
    @endphp

    @for ($page = 0; $page < $pages; $page++)
    <div class="page">
        <div class="wrapper" style="display: flex; flex-flow: row wrap;">
            @foreach($chunks[$page] as $asset)
                @if ($assets->isEmpty())
                    <div style="display: flex; height: 6.8cm; width: 7.0cm; overflow: hidden;">
                        <div style="padding: 10px 25px;">
                            <div class="row">
                                <h2>No data found!</h2>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="content" style="display: flex; height: 6.8cm; width: 7.0cm;">
                        <div style="padding: 10px 25px; overflow: hidden;">
                            @if ($asset['serial_number'])
                            <div class="row">
                                <div style="margin-left: 5px; margin-top: -5px;">
                                {!! QrCode::size(190)->generate(route('shareDevice', ['id' => $asset['serial_number']])) !!}
                                </div>
                            </div>
                            <div class="row" style="margin-top: 10px; width: 100%; text-align: center;">
                                <p style="width: 100%; font-size: 12px;">Serial no.</p>
                                <label style="font-size: 15px; font-weight: 700;">{{$asset['serial_number']}}</label>
                            </div>
                            @endif
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
    @endfor
</body>
</html>
