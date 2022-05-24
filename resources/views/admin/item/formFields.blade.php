<?php
/**
 * Created By: Amit Sarker
 * Created Date: 06-10-2020
 */
?>
{{csrf_field()}}
<div class="form-row">
    <div class="col-md-6">
        <div class="form-group"><label class="small mb-1" for="item_name">Item Name</label><input
                class="form-control" id="item_name" name="item_name" type="text" placeholder="Name"
                value="{{!empty($itemInfo->item_name) ?$itemInfo->item_name : ''}}" required>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group"><label class="small mb-1" for="item_code">Item Code</label><input
                class="form-control" id="item_code" name="item_code" type="text" placeholder="Code"
                value="{{!empty($itemInfo->item_code) ?$itemInfo->item_code : ''}}">
        </div>
    </div>
</div>
<div class="form-row">
    <div class="col-md-6">
        <div class="form-group"><label class="small mb-1" for="unit_price">Unit Price</label><input
                class="form-control" id="unit_price" name="unit_price" type="number"
                placeholder="Unit Price" value="{{!empty($itemInfo->unit_price) ?getFloat($itemInfo->unit_price) : ''}}"
                required></div>
    </div>
    <div class="col-md-6">
        <div class="form-group"><label class="small mb-1" for="unit">Unit</label>
            <select class="form-control" id="unit" name="unit" required>
                <option value="">Please select</option>
                <?php $unit = !empty($itemInfo->unit) ? $itemInfo->unit : ''; ?>
                @if(!empty($unitArray))
                    @foreach($unitArray as $value)
                        <option value="{{$value}}" {{($value) ? 'selected' : ''}}>{{$value}}</option>
                    @endforeach
                @endif
            </select>
        </div>
    </div>
</div>
<div class="form-row">
    <div class="col-md-6">
        <div class="form-group"><label class="small mb-1" for="standard_rate">Standard Rate</label><input
                class="form-control" id="standard_rate" name="standard_rate" type="number" placeholder="Standard Rate"
                value="{{!empty($itemInfo->standard_rate) ?$itemInfo->standard_rate : ''}}" required>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group"><label class="small mb-1" for="standard_amount">Standard Amount</label><input
                class="form-control" id="standard_amount" name="standard_amount" type="number" placeholder="Standard Amount"
                value="{{!empty($itemInfo->standard_amount) ?$itemInfo->standard_amount : ''}}" required>
        </div>
    </div>
</div>
<div class="form-row">
    <div class="col-md-6">
        <div class="form-group"><label class="small mb-1" for="item_description">Description</label>
            <textarea class="form-control" id="item_description" name="item_description"
                      rows="2">{{!empty($itemInfo->item_description) ?$itemInfo->item_description : ''}}</textarea>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group"><label class="small mb-1" for="mobile">Item Status</label>
            <select class="form-control" id="isActive" name="is_active" required>
                <?php
                if (!empty($itemInfo)) {  ?>
                <?php $isActive = !empty($itemInfo->is_active) ? $itemInfo->is_active : ''; ?>
                <option value="">Please select</option>
                <option value="1" {{($isActive==1) ? 'selected' : ''}}>Active</option>
                <option value="0" {{($isActive==0) ? 'selected' : ''}}>Inactive</option>
                <?php } else { ?>
                <option value="">Please select</option>
                <option value="1" selected>Active</option>
                <option value="0">Inactive</option>
                <?php }
                ?>
            </select>
        </div>
    </div>
</div>
<div class="form-group mt-4 mb-0">
    <button id="" class="btn btn-primary">{{!empty($buttonText) ? $buttonText : 'Save'}}</button>
</div>
