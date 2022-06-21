<?php
/**
 * Created By: Amit Sarker
 * Created Date: 06-10-2020
 */
?>
{{csrf_field()}}
<div class="form-row">
    <div class="col-md-12">
        <div class="form-group"><label class="small mb-1" for="cost_name">Cost Name</label><input
                class="form-control" id="cost_name" name="cost_name" type="text" placeholder="Name"
                value="{{!empty($miscellaneousInfo->cost_name) ?$miscellaneousInfo->cost_name : ''}}" required>
        </div>
    </div>
</div>
<div class="form-row">
    <div class="col-md-6">
        <div class="form-group"><label class="small mb-1" for="quantity">Quantity</label><input
                class="form-control" id="quantity" name="quantity" type="number" placeholder="Quantity"
                value="{{!empty($miscellaneousInfo->quantity) ?getFloat($miscellaneousInfo->quantity) : ''}}"
                required>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group"><label class="small mb-1" for="unit_price">Unit Price</label><input
                class="form-control" id="unit_price" name="unit_price" type="number" placeholder="Unit Price"
                value="{{!empty($miscellaneousInfo->unit_price) ?getFloat($miscellaneousInfo->unit_price) : ''}}">
        </div>
    </div>
</div>
<div class="form-row">
    <div class="col-md-6">
        <div class="form-group"><label class="small mb-1" for="total_cost">Total Cost</label><input
                class="form-control" id="total_cost" name="total_cost" type="number"
                placeholder="Total Cost"
                value="{{!empty($miscellaneousInfo->total_cost) ?getFloat($miscellaneousInfo->total_cost) : ''}}"
                required></div>
    </div>
    <div class="col-md-6">
        <div class="form-group"><label class="small mb-1" for="entry_date">Date</label><input
                class="form-control" id="entry_date" name="entry_date" type="date"
                placeholder="Date"
                value="{{!empty($miscellaneousInfo->entry_date) ?$miscellaneousInfo->entry_date : ''}}"
                required></div>
    </div>
</div>
<div class="form-row">
    <div class="col-md-12">
        <div class="form-group"><label class="small mb-1" for="remarks">Remarks</label>
            <textarea class="form-control" id="remarks" name="remarks"
                      rows="2">{{!empty($miscellaneousInfo->remarks) ?$miscellaneousInfo->remarks : ''}}</textarea>
        </div>
    </div>
</div>
<div class="form-group mt-4 mb-0">
    <button id="" class="btn btn-primary">{{!empty($buttonText) ? $buttonText : 'Save'}}</button>
</div>
