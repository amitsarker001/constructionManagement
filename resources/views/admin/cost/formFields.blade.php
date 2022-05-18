<?php
/**
 * Created By: Amit Sarker
 * Created Date: 06-10-2020
 */
?>

{{csrf_field()}}
<div class="form-row">
<div class="col-md-4">
        <div class="form-group"><label class="small mb-1" for="item_id">Item Name</label>
        <select class="form-control" id="item_id" name="item_id" required>
                <option value="">Please select</option>
                <?php $item_id = !empty($costInfo->item_id) ? $costInfo->item_id : 0; ?>
                @if(!empty($itemList))
                    @foreach($itemList as $item)
                        <option value="{{$item->id}}" {{($item_id == $item->id) ? 'selected' : ''}}>{{$item->item_name}}</option>
                    @endforeach
                @endif
            </select>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group"><label class="small mb-1" for="quantity">Quantity</label><input
                class="form-control" id="quantity" name="quantity" type="number"
                placeholder="Quantity" value="{{!empty($costInfo->quantity) ?getFloat($costInfo->quantity) : ''}}"
                required></div>
    </div>
    <div class="col-md-4">
        <div class="form-group"><label class="small mb-1" for="rate">Rate</label><input
                class="form-control" id="rate" name="rate" type="number"
                placeholder="Rate" value="{{!empty($costInfo->rate) ?getFloat($costInfo->rate) : ''}}"
                required></div>
    </div>
</div>
<div class="form-row">
<div class="col-md-4">
        <div class="form-group"><label class="small mb-1" for="amount">Amount</label><input
                class="form-control" id="amount" name="amount" type="number"
                placeholder="Amount" value="{{!empty($costInfo->amount) ?getFloat($costInfo->amount) : ''}}"
                required>
        </div>
    </div>
    <div class="col-md-4">
    <div class="form-group"><label class="small mb-1" for="standard_rate">Standard Rate</label>
        <input
                class="form-control" id="standard_rate" name="standard_rate" type="number"
                placeholder="Standard Rate" value="{{!empty($costInfo->standard_rate) ?getFloat($costInfo->standard_rate) : ''}}"
                required>
        </div>
    </div>
<div class="col-md-4">
        <div class="form-group"><label class="small mb-1" for="standard_amount">Standard Amount</label><input
                class="form-control" id="standard_amount" name="standard_amount" type="number"
                placeholder="Standard Amount" value="{{!empty($costInfo->standard_amount) ?getFloat($costInfo->standard_amount) : ''}}"
                required>
        </div>
    </div>
</div>
<div class="form-row">

</div>
<div class="form-row">
    <div class="col-md-4">
    <div class="form-group"><label class="small mb-1" for="increase_rate">Increase Rate</label>
        <input
                class="form-control" id="increase_rate" name="increase_rate" type="number"
                placeholder="Increase Rate" value="{{!empty($costInfo->increase_rate) ?getFloat($costInfo->increase_rate) : ''}}"
                required>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group"><label class="small mb-1" for="increase_amount">Increase Amount</label>
        <input
                class="form-control" id="increase_amount" name="increase_amount" type="number"
                placeholder="Increase Amount" value="{{!empty($costInfo->increase_amount) ?getFloat($costInfo->increase_amount) : ''}}"
                required>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <button style="margin-top: 7%;" id="" class="btn btn-secondary"><i class="fa fa-plus" aria-hidden="true"></i> Add</button>
        </div>
</div>
</div>
<div class="form-group mt-4 mb-0">
    <a style="margin: 1%" class="btn btn-danger float-right" href="{{route('clearDetailsFromTable')}}"><i
                                class="fa fa-trash" aria-hidden="true"></i>Clear Table</a>
</div>
@include('admin.cost.detailsTable')