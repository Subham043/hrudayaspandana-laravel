<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>pdf</title>
    <style>
    @page { margin: 5px; }
    body {
        padding: 0px;
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        height: 100%;
        margin:0;
    }

    .container {
        border: 3px solid #000;
        padding:5px;
    }

    .page-break {
        page-break-after:avoid;
    }
    </style>
</head>

<body>
    <div class="container page-break">
        <table style="width:100%;">
            <tbody style="width:100%;">
                <tr>
                    <td style="text-align:left;width:70%;">
                        <h3 style="margin-bottom: 10px;color:#ffaa49;font-size:25px">{{ $donation->trust==1 ? 'Sai Mayee trust' : 'Sri Sai Meru Mathi Trust' }}</h3>
                        <h6 style="margin-top: 0;font-size:14px;font-weight: 200;">E601, Aishwarya Lakeview Apartments, 6th Cross,<br>
                            Kaggadasapura, Bengaluru - 560 093<br>
                            Email: saimerumathitrust@gmail.com</h6>
                    </td>
                    <td style="text-align:right;width:30%;"><img src="{{ public_path('round-logo.png') }}" style="width:35%;object-fit:contain;" /></td>
                </tr>
            </tbody>
        </table>
        <table style="width:100%;margin-top:5px;">
            <tbody style="width:100%;">
                <tr>
                    <td style="text-align:left;width:50%;">
                        <h6 style="margin-top: 0;font-size:18px;font-weight: normal;"><strong>Sl No:</strong> {{ $donation->id }}</h6>
                    </td>
                    <td style="text-align:right;width:50%;"><h6 style="margin-top: 0;font-size:18px;font-weight: normal;"><strong>Date:</strong> {{ date('d', strtotime($donation->created_at)) }}-{{ date('M', strtotime($donation->created_at)); }}-{{ date('Y', strtotime($donation->created_at)) }}</h6></td>
                </tr>
            </tbody>
        </table>
        <table style="width:100%;margin-top:5px;">
            <tbody style="width:100%;">
                <tr>
                    <td style="text-align:left;width:100%;">
                        <h6 style="margin-top: 0;font-size:18px;font-weight: normal;line-height:2;">Received with thanks from <span style="font-weight: 600;">Mr. {{ $donation->first_name }} {{ $donation->last_name }}</span>, a sum of Rupees <span style="font-weight: 600;">{{ $donation->amountWord() }} Only</span>, vide reference  <span style="font-weight: 600;">{{ $donation->payment_id }}</span>, towards <span style="font-weight: 600;">Various seva activities</span></h6>
                    </td>
                </tr>
            </tbody>
        </table>
        <table style="width:100%;margin-top:5px;">
            <tbody style="width:100%;">
                <tr>
                    <td style="text-align:left;width:100%;">
                        <h6 style="margin-top: 0;font-size:18px;font-weight: normal;line-height:2;">With support from benevolent participants like you, our Trust is able to continue with
different Seva activities. We sincerely thank you for your continued support and
encouragement.</h6>
                    </td>
                </tr>
            </tbody>
        </table>
        <table style="width:100%;margin-top:5px;">
            <tbody style="width:100%;">
                <tr>
                    <td style="text-align:left;width:100%;">
                        <h6 style="margin-top: 0;font-size:18px;font-weight: normal;"><strong>Amount:</strong> <span style="border-bottom:1px solid #000;font-weight: 500;text-align:center;">Rs. {{ $donation->amount }}</span></h6>
                    </td>
                </tr>
            </tbody>
        </table>
        <table style="width:100%;margin-top:5px;">
            <tbody style="width:100%;">
                <tr>
                    <td style="text-align:left;width:50%;">
                        <h6 style="margin-top: 0;font-size:20px;font-weight: 200;margin-bottom:0;"><strong style="border-bottom:1px solid #000;">Details of the Donor:</strong></h6>
                    </td>
                    <td style="text-align:center;width:50%;"><h6 style="margin-top: 0;font-size:20px;font-weight: 200;margin-bottom:0;"><strong style="border-bottom:1px solid #000;">For {{ $donation->trust==1 ? 'Sai Mayee trust' : 'Sri Sai Meru Mathi Trust' }}</strong></h6></td>
                </tr>
            </tbody>
        </table>
        <table style="width:100%;margin-top:5px;">
            <tbody style="width:100%;">
                <tr>
                    <td style="text-align:left;width:50%;">
                        <h6 style="margin-top: 0;font-size:18px;font-weight: normal;">E-Mail: {{ $donation->email }}<br>Mobile: {{ $donation->phone }}</h6>
                    </td>
                    <td style="text-align:center;width:50%;"><img src="{{ public_path('signature.png') }}"style="width:20%;" /><br><h6 style="margin-top: 0;font-size:20px;font-weight: normal;"><strong>A V S S Prasad</strong><br>(Authorised Signatory)</h6></td>
                </tr>
            </tbody>
        </table>
        @if($donation->trust==1)
        <table style="width:100%;margin-top:5px;">
            <tbody style="width:100%;">
                <tr>
                    <td style="text-align:left;width:100%;">
                        <h6 style="margin-top: 0;font-size:12px;font-weight: normal;">Donations made are exempted under section 80G of the income tax act 1961, Vide Order No.: ITBA/Exm/S/80G/2020-21/1031997080(1)</h6>
                    </td>
                </tr>
            </tbody>
        </table>
        @endif
    </div>
</body>

</html>