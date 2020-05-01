<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Оплата</h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"
                    data-toggle="tooltip" title="Collapse">
                <i class="fas fa-minus"></i></button>
        </div>
    </div>
    <div class="card-body">
        <div class="form-group">
            <div class="custom-control custom-radio">
                <input class="custom-control-input" type="radio" id="method_pay_1" name="method_pay" value="receipt"
                       @if (old('method_pay', 'receipt') == 'receipt') checked @endif>
                <label for="method_pay_1" class="custom-control-label">Оплата при отриманні замовлення</label>
            </div>
            <div class="custom-control custom-radio">
                <input class="custom-control-input" type="radio" id="method_pay_2" name="method_pay" value="google-pay"
                       @if (old('method_pay') == 'google-pay') checked @endif>
                <label for="method_pay_2" class="custom-control-label">Google Pay</label>
            </div>
            <div class="custom-control custom-radio">
                <input class="custom-control-input" type="radio" id="method_pay_3" name="method_pay" value="card"
                       @if (old('method_pay') == 'card') checked @endif>
                <label for="method_pay_3" class="custom-control-label">Оплатити зараз карткою Visa/Mastercard</label>
            </div>
        </div>
        <div class="form-group">
            <div class="custom-control custom-radio">
                <input class="custom-control-input" type="radio" id="pay-status-yes" name="paid" value="1" @if (old('paid')) checked @endif>
                <label for="pay-status-yes" class="custom-control-label">Оплачено</label>
            </div>
            <div class="custom-control custom-radio">
                <input class="custom-control-input" type="radio" id="pay-status-no" name="paid" value="0" @if (!old('paid')) checked @endif>
                <label for="pay-status-no" class="custom-control-label">Не оплачено</label>
            </div>
        </div>
    </div>
</div>
