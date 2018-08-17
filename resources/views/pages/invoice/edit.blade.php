@extends('main')

@section('title')
    Manage Invoices
@stop

@section('content')
    @if(\Session::has('feedback'))
        <p>{{ Session::get('feedback') }}</p>
    @endif
    <a href="{{ URL::previous() }}"><<<< Back</a>
    <div class="row">
        <div class="col-md-6">
            <h2>Edit Invoice</h2>
            {{ Form::model($invoice, ['route' => ['invoice.update', $invoice->invoice_id], 'method' => 'POST', 'id'=>'invoice-builder-form']) }}
                <input type="hidden" name="_method" value="PUT">
                {{ method_field('PUT') }}
                {{-- {{ csrf_field() }} --}}
                @include('pages.invoice.form')

                <hr>


    <div class="form-row">
        {{-- <input type="text" name='loltest' id='loltest'> --}}
            <div class="col-md-12">
        <table id="line-item-list">
                <thead>
                    <tr>
                        <th style="text-align: center">Item Name</th>
                        <th style="text-align: center">Price</th>
                        <th style="text-align: center">Quantity</th>
                        <th style="text-align: center">Unit</th>
                        <th style="text-align: right">Total</th>
                    </tr>
                </thead>
            {{-- </div> --}}


            {{-- <div class="col-md-12"> --}}
            <tbody>
            <span id="add-new-item" class="fake-button fake-button-a" >Add New</span>

            @foreach($invoice_details as $detail)
                <tr>
                    <td><input type="text" value="{{$detail["item"]}}" name='invoice-line-item-name[]'></td>
                    <td><input type="text" value="{{$detail["price"]}}" class="price-line" name='invoice-line-item-price[]'></td>
                    <td><input type="text" value="{{$detail["quantity"]}}" class="quantity-line" name='invoice-line-item-quantity[]'></td>
                    <td><input type="text" value="{{$detail["unit"]}}" name='invoice-line-item-unit[]'></td>
                    <td><span id='invoice-line-item-total'>${{$detail["total_value"]}}</span></td>
                </tr>
            @endforeach
                
            </tbody>
            <tfoot>
                <tr style="height: 50px">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td id="subtotal-label"><strong>Subtotal</strong></td>
                    <td id="subtotal-number"></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td id="tax-label"><strong>Taxes</strong></td>
                    <td id="tax-number"></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td id="shipping-label"><strong>Shipping</strong></td>
                    <td id="shipping-number"></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td id="total-label"><strong>Total</strong></td>
                    <td id="total-number"></td>
                </tr>
            </tfoot>
        </table>

        {{-- <table id="line-item-totals">
            <thead>
                
            </thead>
            <tbody style="width: 100%; display: inline-block; align-items: flex-end; flex-direction:column">
                <tr>
                    <th>Subtotal</th>
                    <td>Ahh</td>
                </tr>
                <tr>
                    <th>Taxes</th>
                    <td>123</td>
                </tr>
                <tr>
                    <th>Total</th>
                    <td>1234</td>
                </tr>
            </tbody>
        </table> --}}
        </div>
    </div>
    <div class="form-row">
        <div class="col-md-12">
            
            {{ Form::submit('Submit') }}
        </div>

    </div>
            {{ Form::close() }}
        </div>
        
    </div>

@stop

@section('scripts')
    <script src="/js/modules/customer-preview.js"></script>
    <script src="/js/invoice.js"></script>
@stop
