
<div class="container">
    <div class="row">
        <div class="col-md-12">
    		<div class="invoice-title">
    			<h2>Invoice</h2>
                <h3 class="pull-right"> Order # {{$invoice['invoice_id']}}</h3>
    		</div>
    		<hr>
    		<div class="row">
    			<div class="col-md-6">
    				<address>
    				<strong>Billed To:</strong><br>
    					{{$invoice['name']}}<br>
    					{{$invoice['address']}}<br>
    					Line 2<br>
    					{{$customer_details['city']}}, {{$customer_details['state']}} {{$customer_details['zip']}}
    				</address>
    			</div>
    			<div class="col-md-6 text-right">
    				<address>
        			<strong>Shipped To:</strong><br>
    					{{$invoice['name']}}<br>
                        {{$invoice['address']}}<br>
                        Line 2<br>
                        {{$customer_details['city']}}, {{$customer_details['state']}} {{$customer_details['zip']}}
    				</address>
    			</div>
    		</div>
    		<div class="row">
    			<div class="col-md-6">
    				<address>
    					<strong>Payment Method:</strong><br>
    					Visa ending **** 4242<br>
    					{{$customer_details['email']}}
    				</address>
    			</div>
    			<div class="col-md-6 text-right">
    				<address>
    					<strong>Order Date:</strong><br>
    					{{$invoice['date']}}<br><br>
    				</address>
    			</div>
    		</div>
    	</div>
    </div>
    
    <div class="row">
    	<div class="col-md-12">
    		<div class="panel panel-default">
    			<div class="panel-heading">
    				<h3 class="panel-title"><strong>Order summary</strong></h3>
    			</div>
    			<div class="panel-body">
    				<div class="table-responsive">
    					<table class="table table-condensed">
    						<thead>
                                <tr>
        							<td><strong>Item</strong></td>
        							<td style="text-align: center"><strong>Price</strong></td>
        							<td style="text-align: center"><strong>Quantity</strong></td>
                                    <td style="text-align: center"><strong>Unit</strong></td>
        							<td style="text-align: right"><strong>Totals</strong></td>
                                </tr>
    						</thead>
    						<tbody>
    							<!-- foreach ($order->lineItems as $line) or some such thing here -->
                                @foreach($invoice_details as $detail)
                                <tr>
                                    <td>{{$detail['item']}}</td>
                                    <td style="text-align: center">${{$detail['price']}}</td>
                                    <td style="text-align: center">{{$detail['quantity']}}</td>
                                    <td style="text-align: center">{{$detail['unit']}}</td>
                                    <td style="text-align: right">${{$detail['total_value']}}</td>
                                </tr>
                                @endforeach
    							<tr>
                                    <td class="thick-line"></td>
    								<td class="thick-line"></td>
    								<td class="thick-line"></td>
    								<td class="thick-line text-center"><strong>Subtotal</strong></td>
    								<td class="thick-line text-right">${{$invoice['amount'] - $invoice['taxes']}}</td>
    							</tr>
    							<tr>
                                    <td class="no-line"></td>
                                    <td class="no-line"></td>
                                    <td class="no-line"></td>
                                    <td class="no-line text-center"><strong>Taxes</strong></td>
                                    <td class="no-line text-right">${{$invoice['taxes']}}</td>
                                </tr>
                                <tr>
                                    <td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line text-center"><strong>Shipping</strong></td>
    								<td class="no-line text-right">$@if($invoice['shipping']){{$invoice['shipping']}} @else 0.00 @endif</td>
    							</tr>
    							<tr>
                                    <td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line text-center"><strong>Total</strong></td>
    								<td class="no-line text-right">${{$invoice['amount']}}</td>
    							</tr>
    						</tbody>
    					</table>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
</div>
