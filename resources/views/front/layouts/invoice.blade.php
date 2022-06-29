<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>{{$order->user->firstname . '_' .  $order->user->lastname . ' '. $order->referance_id }}</title>

		<style>
            body{
                font-family: 'almarai', sans-serif;
            }
			.invoice-box {
				max-width: 800px;
				margin: auto;
				padding: 30px;
				font-size: 16px;
				line-height: 24px;
				font-family: 'almarai', sans-serif;
				color: #555;
			}

			.invoice-box table {
				width: 100%;
				line-height: inherit;
				text-align: left;
			}

			.invoice-box table td {
				padding: 5px;
				vertical-align: top;
			}

			.invoice-box table tr td:nth-child(2),
            .invoice-box table tr td:nth-child(3){
				text-align: right;
			}

			.invoice-box table tr.top table td {
				padding-bottom: 20px;
			}

			.invoice-box table tr.top table td.title {
				font-size: 45px;
				line-height: 45px;
				color: #333;
			}

			.invoice-box table tr.information table td {
				padding-bottom: 40px;
			}

			.invoice-box table tr.heading td {
				background: #eee;
				border-bottom: 1px solid #ddd;
				font-weight: bold;
			}

			.invoice-box table tr.details td {
				padding-bottom: 20px;
			}

			.invoice-box table tr.item td {
				border-bottom: 1px solid #eee;
			}

			.invoice-box table tr.item.last td {
				border-bottom: none;
			}

			.invoice-box table tr.total td:nth-child(2),
            .invoice-box table tr.total td:nth-child(3) {
				border-top: 2px solid #eee;
				font-weight: bold;
			}

			@media only screen and (max-width: 600px) {
				.invoice-box table tr.top table td {
					width: 100%;
					display: block;
					text-align: center;
				}

				.invoice-box table tr.information table td {
					width: 100%;
					display: block;
					text-align: center;
				}
			}

			/** RTL **/
			.invoice-box.rtl {
				direction: rtl;
				font-family: 'almarai', sans-serif;
			}

			.invoice-box.rtl table {
				text-align: right;
			}

			.invoice-box.rtl table tr td:nth-child(2),
            .invoice-box.rtl table tr td:nth-child(3) {
				text-align: left;
			}
            @page {
                header: page-header;
                footer: page-footer;
            }
		</style>
	</head>

	<body>
		<div class="invoice-box">
			<table cellpadding="0" cellspacing="0">
				<tr class="top">
					<td colspan="3">
						<table>
							<tr>
								<td class="title">
                                    @if(app()->getLocale()=='ar')
                                        <img class="" style="width: 100%; max-width: 70px"
                                            src="{{ setting()->ar_site_logo ?
                                            URL::asset('Dashboard/img/settingArLogo/'.setting()->ar_site_logo) :
                                            URL::asset('Dashboard/img/Default/logo_ar.png')}}"/>
                                    @elseif(app()->getLocale()=='ku')
                                        <img class="" style="width: 100%; max-width: 70px"
                                            src="{{setting()->ku_site_logo ?
                                            URL::asset('Dashboard/img/settingKuLogo/'.setting()->ku_site_logo) :
                                            URL::asset('Dashboard/img/Default/logo_ku.png')}}"/>
                                    @elseif(app()->getLocale()=='en')
                                        <img class="" style="width: 100%; max-width: 70px"
                                            src="{{setting()->en_site_logo ?
                                            URL::asset('Dashboard/img/settingEnLogo/'.setting()->en_site_logo) :
                                            URL::asset('Dashboard/img/Default/logo_en.png')}}"/>

                                    @endif
                                </td>
                                <td></td>
								<td>
									Invoice #: {{ $order->referance_id }}<br />
									Created: {{ $order->created_at }}<br />
									Due: {{ $order->created_at }}
								</td>
							</tr>
						</table>
					</td>
				</tr>

				<tr class="information">
					<td colspan="3">
						<table>
							<tr>
								<td>
									{{ \App\Models\setting::first()->site_name }}<br />
									{{ \App\Models\setting::first()->address }}<br />
									{{ \App\Models\setting::first()->support_mail }}
								</td>
                                <td></td>
								<td>
									{{ $order->user->firstname . ' ' .  $order->user->lastname}}<br />
									{{ $order->user->email }}<br />
									{{ $order->user->phone }}
								</td>
							</tr>
						</table>
					</td>
				</tr>

				<tr class="heading">
					<td>Payment Method</td>
                    <td></td>
					<td>Check #</td>
				</tr>

				<tr class="details">
					<td>{!! $order->transaction->getTransactionForPrint() !!}</td>
                    <td></td>
					<td>{{ config('app.currency') . number_format($order->total , 2) }}</td>
				</tr>

				<tr class="heading">
					<td>Item</td>
                    <td>Quantity</td>
					<td>Price</td>
				</tr>
                @foreach($order->orderItems as $orderItem)
                    <tr class="item">
                        <td>{{ $orderItem->product->name }}</td>
                        <td>{{ $orderItem->quantity }}</td>
                        <td>{{ config('app.currency') . number_format($orderItem->quantity * $orderItem->price , 2) }}</td>
                    </tr>
                @endforeach

				<tr class="total">
					<td></td>
                    <td>SubTotal</td>
					<td>{{ config('app.currency') . number_format($order->subtotal , 2) }}</td>
				</tr>
                <tr class="total">
                    <td></td>
                    <td>Discount</td>
					<td>{{ config('app.currency') . number_format($order->discount , 2) }}</td>
				</tr>
                <tr class="total">
                    <td></td>
                    <td>Tax</td>
					<td>{{ config('app.currency') . number_format($order->tax , 2) }}</td>
				</tr>
                <tr class="total">
                    <td></td>
                    <td>Total</td>
					<td>{{ config('app.currency') . number_format($order->total , 2) }}</td>
				</tr>
                <br>
            </table>
		</div>
	</body>
</html>
