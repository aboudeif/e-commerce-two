<x-app-layout>
    {{-- choose payment method --}}
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Choose Payment Method</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Credit Card</h3>
                                    </div>
                                    <div class="card-body">
                                        <form action="{{ route('user.payment.store') }}" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <label for="card-number">Card Number</label>
                                                <input type="text" class="form-control" id="card-number" name="card_number" placeholder="Enter Card Number">
                                            </div>
                                            <div class="form-group">
                                                <label for="card-expiry-month">Expiration Date</label>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <input type="text" class="form-control" id="card-expiry-month" name="card_expiry_month" placeholder="MM">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="text" class="form-control" id="card-expiry-year" name="card_expiry_year" placeholder="YYYY">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="card-cvc">CVC</label>
                                                <input type="text" class="form-control" id="card-cvc" name="card_cvc" placeholder="Enter CVC">
                                            </div>
                                            <button type="submit" class="btn btn-primary">Pay</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Paypal</h3>
                                    </div>
                                    <div class="card-body">
                                        <form action="{{ route('user.payment.store') }}" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <label for="card-number">Card Number</label>
                                                <input type="text" class="form-control" id="card-number" name="card_number" placeholder="Enter Card Number">
                                            </div>
                                            <div class="form-group">
                                                <label for="card-expiry-month">Expiration Date</label>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <input type="text" class="form-control" id="card-expiry-month" name="card_expiry_month" placeholder="MM">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="text" class="form-control" id="card-expiry-year" name="card_expiry_year" placeholder="YYYY">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="card-cvc">CVC</label>
                                                <input type="text" class="form-control" id="card-cvc" name="card_cvc" placeholder="Enter CVC">
                                            </div>
                                            <button type="submit" class="btn btn-primary">Pay</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
