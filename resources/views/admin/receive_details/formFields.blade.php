<?php
/**
 * Created By: Amit Sarker
 * Created Date: 21-06-2022
 */
?>
{{csrf_field()}}
<div class="form-row">
    <div class="col-md-6">
        <div class="form-group"><label class="small mb-1" for="entry_date">Entry Date</label><input
                class="form-control" id="entry_date" name="entry_date" type="date" placeholder="Entry Date"
                value="{{!empty($receiveDetailsInfo->entry_date) ? getStringToDateFormat($receiveDetailsInfo->entry_date) : ''}}">
        </div>
    </div>
	<div class="col-md-6">
        <div class="form-group"><label class="small mb-1" for="receive_amount">Receive Amount</label><input
                class="form-control" min="0" id="receive_amount" name="receive_amount" type="number" placeholder="Amount"
                value="{{!empty($receiveDetailsInfo->receive_amount) ?$receiveDetailsInfo->receive_amount : ''}}" required>
        </div>
    </div>
</div>
<div class="form-row">
    <div class="col-md-6">
        <div class="form-group"><label class="small mb-1" for="money_receipt_no">Money Receipt No</label><input
                class="form-control" id="money_receipt_no" name="money_receipt_no" type="text" placeholder="Money Receipt No"
                value="{{!empty($receiveDetailsInfo->money_receipt_no) ?$receiveDetailsInfo->money_receipt_no : ''}}" required>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group"><label class="small mb-1" for="remarks">Remarks</label>
            <textarea class="form-control" id="remarks" name="remarks" placeholder="Remarks"
                      rows="2">{{!empty($receiveDetailsInfo->remarks) ?$receiveDetailsInfo->remarks : ''}}</textarea>
        </div>
    </div>
</div>
<div class="form-group mt-4 mb-0">
    <button id="" class="btn btn-primary">{{!empty($buttonText) ? $buttonText : 'Save'}}</button>
</div>
