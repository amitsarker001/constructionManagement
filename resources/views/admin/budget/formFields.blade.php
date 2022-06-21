<?php
/**
 * Created By: Amit Sarker
 * Created Date: 06-10-2020
 */
?>
{{csrf_field()}}
<div class="form-row">
    <div class="col-md-6">
        <div class="form-group"><label class="small mb-1" for="cost_name">Cash Amount</label><input
                class="form-control" id="cash_amount" name="cash_amount" type="number" placeholder="Cash Amount"
                value="{{!empty($budgetInfo->cash_amount) ? getFloat($budgetInfo->cash_amount) : ''}}" required>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group"><label class="small mb-1" for="extra_amount_claimed">Extra Amount Claimed</label><input
                class="form-control" id="extra_amount_claimed" name="extra_amount_claimed" type="number"
                placeholder="Extra Amount Claimed"
                value="{{!empty($budgetInfo->extra_amount_claimed) ? getFloat($budgetInfo->extra_amount_claimed) : ''}}"
                required>
        </div>
    </div>
</div>
<div class="form-row">
    <div class="col-md-6">
        <div class="form-group"><label class="small mb-1" for="total_allocated_funds">Total Allocated
                Funds</label><input
                class="form-control" id="total_allocated_funds" name="total_allocated_funds" type="number"
                placeholder="Total Allocated Funds"
                value="{{!empty($budgetInfo->total_allocated_funds) ? getFloat($budgetInfo->total_allocated_funds) : ''}}"
                required>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group"><label class="small mb-1" for="funds_remaining">Funds Used To Date</label><input
                class="form-control" id="total_receive_amount" name="total_receive_amount" type="number"
                placeholder="Funds Used To Date"
                value="{{ getFloat($totalReceiveAmount) }}"
                required>
        </div>
    </div>
</div>
<div class="form-row">
    <div class="col-md-6">
        <div class="form-group"><label class="small mb-1" for="funds_remaining">Funds Remaining</label><input
                class="form-control" id="funds_remaining" name="funds_remaining" type="number"
                placeholder="Funds Remaining"
                value="{{!empty($budgetInfo->funds_remaining) ? getFloat($budgetInfo->funds_remaining) : ''}}"
                required>
        </div>
    </div>
    <div class="col-md-6">
        <div class="col-md-6 float-left">
            <div class="form-group"><label class="small mb-1" for="entry_date">Entry Date</label><input
                    class="form-control" id="entry_date" name="entry_date" type="date"
                    placeholder="entry_date"
                    value="{{!empty($budgetInfo->entry_date) ? getStringToDateFormat($budgetInfo->entry_date) : ''}}"
                    required>
            </div>
        </div>
        <div class="col-md-6 float-left">
            <div class="form-group mt-4 mb-0">
                <button id="" class="btn btn-primary">{{!empty($buttonText) ? $buttonText : 'Save'}}</button>
            </div>
        </div>
    </div>
</div>

