<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <meta http-equiv="content-language" content="{{ str_replace('_', '-', app()->getLocale()) }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Invoice</title>

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,600;0,700;1,400;1,600&display=swap" rel="stylesheet">

    <style>
        * {
            font-family: DejaVu Sans;
        }

        body {
            background: #fff none;
            font-size: 12px;
        }

        h2 {
            font-size: 28px;
            color: #ccc;
        }

        .container {
            padding-top: 30px;
        }

        .invoice-head td {
            padding: 0 8px;
        }

        .table th {
            vertical-align: bottom;
            font-weight: bold;
            padding: 8px;
            line-height: 20px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .table tr.row td {
            border-bottom: 1px solid #ddd;
        }

        .table td {
            padding: 8px;
            line-height: 20px;
            text-align: left;
            vertical-align: top;
        }
    </style>
</head>
<body>
<div class="container">
    <table style="margin-left: auto; margin-right: auto;" width="550">
        <tr>
            <td width="160">
                &nbsp;
            </td>

            <!-- Organization Name / Image -->
            <td align="right">
                <img src="file://{{ public_path('images/Logo.png') }}" alt="{{ $vendor }}" width="150">
            </td>
        </tr>
        <tr valign="top">
            <td style="font-size: 28px; color: #ccc;">
                {{ __('Receipt') }}
            </td>

            <!-- Organization Name / Date -->
            <td>
                <br><br>
                <strong>{{ __('To:') }}</strong> {{ $owner->stripeEmail() ?: $owner->name }}
                <br>
                <strong>{{ __('Date:') }}</strong> {{ $invoice->date()->toFormattedDateString() }}
            </td>
        </tr>
        <tr valign="top">
            <!-- Organization Details -->
            <td style="font-size:9px;">
                {{ $vendor }}<br>

                @if (isset($street))
                    {{ $street }}<br>
                @endif

                @if (isset($location))
                    {{ $location }}<br>
                @endif

                @if (isset($phone))
                    <strong>T</strong> {{ $phone }}<br>
                @endif

                @if (isset($vendorVat))
                    {{ $vendorVat }}<br>
                @endif

                @if (isset($url))
                    <a href="{{ $url }}">{{ $url }}</a>
                @endif
            </td>
            <td>
                <!-- Invoice Info -->
                <p>
                    <strong>{{ __('Product:') }}</strong> {{ $product }}<br>
                    <strong>{{ __('Invoice Number:') }}</strong> {{ $id ?? $invoice->number }}<br>
                </p>

                <!-- Extra / VAT Information -->
                @if (isset($vat))
                    <p>
                        {{ $vat }}
                    </p>
                @endif

                <br><br>

                <!-- Invoice Table -->
                <table width="100%" class="table" border="0">
                    <tr>
                        <th align="left">{{ __('Description') }}</th>
                        <th align="right">{{ __('Date') }}</th>

                        @if ($invoice->hasTax())
                            <th align="right">{{ __('Tax') }}</th>
                        @endif

                        <th align="right">{{ __('Amount') }}</th>
                    </tr>

                    <!-- Display The Invoice Items -->
                    @foreach ($invoice->invoiceItems() as $item)
                        <tr class="row">
                            <td colspan="2">{{ $item->description }}</td>

                            @if ($invoice->hasTax())
                                <td>
                                    @if ($inclusiveTaxPercentage = $item->inclusiveTaxPercentage())
                                        {{ $inclusiveTaxPercentage }}% incl.
                                    @endif

                                    @if ($item->hasBothInclusiveAndExclusiveTax())
                                        +
                                    @endif

                                    @if ($exclusiveTaxPercentage = $item->exclusiveTaxPercentage())
                                        {{ $exclusiveTaxPercentage }}%
                                    @endif
                                </td>
                            @endif

                            <td>{{ $item->total() }}</td>
                        </tr>
                    @endforeach

                    <!-- Display The Subscriptions -->
                    @foreach ($invoice->subscriptions() as $subscription)
                        <tr class="row">
                            <td>{{ __('Subscription') }} ({{ $subscription->quantity }})</td>
                            <td>
                                {{ strftime("%B %e, %Y", strtotime($subscription->startDateAsCarbon())) }} -
                                {{ strftime("%B %e, %Y", strtotime($subscription->endDateAsCarbon())) }}
                            </td>

                            @if ($invoice->hasTax())
                                <td>
                                    @if ($inclusiveTaxPercentage = $subscription->inclusiveTaxPercentage())
                                        {{ $inclusiveTaxPercentage }}% incl.
                                    @endif

                                    @if ($subscription->hasBothInclusiveAndExclusiveTax())
                                        +
                                    @endif

                                    @if ($exclusiveTaxPercentage = $subscription->exclusiveTaxPercentage())
                                        {{ $exclusiveTaxPercentage }}%
                                    @endif
                                </td>
                            @endif

                            <td>{{ $subscription->total() }}</td>
                        </tr>
                    @endforeach

                    <!-- Display The Subtotal -->
                    @if ($invoice->hasDiscount() || $invoice->hasTax() || $invoice->hasStartingBalance())
                        <tr>
                            <td colspan="{{ $invoice->hasTax() ? 3 : 2 }}" style="text-align: right;">{{ __('Subtotal') }}</td>
                            <td>{{ $invoice->subtotal() }}</td>
                        </tr>
                    @endif

                    <!-- Display The Discount -->
                    @if ($invoice->hasDiscount())
                        <tr>
                            <td colspan="{{ $invoice->hasTax() ? 3 : 2 }}" style="text-align: right;">
                                @if ($invoice->discountIsPercentage())
                                    {{ $invoice->coupon() }} ({{ $invoice->percentOff() }}% {{ __('Off') }})
                                @else
                                    {{ $invoice->coupon() }} ({{ $invoice->amountOff() }} {{ __('Off') }})
                                @endif
                            </td>

                            <td>-{{ $invoice->discount() }}</td>
                        </tr>
                    @endif

                    <!-- Display The Taxes -->
                    @unless ($invoice->isNotTaxExempt())
                        <tr>
                            <td colspan="{{ $invoice->hasTax() ? 3 : 2 }}" style="text-align: right;">
                                @if ($invoice->isTaxExempt())
                                    {{ __('Tax is exempted') }}
                                @else
                                    {{ __('Tax to be paid on reverse charge basis') }}
                                @endif
                            </td>
                            <td></td>
                        </tr>
                    @else
                        @foreach ($invoice->taxes() as $tax)
                            <tr>
                                <td colspan="3" style="text-align: right;">
                                    {{ $tax->display_name }} {{ $tax->jurisdiction ? ' - '.$tax->jurisdiction : '' }}
                                    ({{ $tax->percentage }}%{{ $tax->isInclusive() ? ' incl.' : '' }})
                                </td>
                                <td>{{ $tax->amount() }}</td>
                            </tr>
                        @endforeach
                    @endunless

                    <!-- Starting Balance -->
                    @if ($invoice->hasStartingBalance())
                        <tr>
                            <td colspan="{{ $invoice->hasTax() ? 3 : 2 }}" style="text-align: right;">
                                {{ __('Customer Balance') }}
                            </td>
                            <td>{{ $invoice->startingBalance() }}</td>
                        </tr>
                    @endif

                    <!-- Display The Final Total -->
                    <tr>
                        <td colspan="{{ $invoice->hasTax() ? 3 : 2 }}" style="text-align: right;">
                            <strong>{{ __('Total') }}</strong>
                        </td>
                        <td>
                            <strong>{{ $invoice->total() }}</strong>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</div>
</body>
</html>
