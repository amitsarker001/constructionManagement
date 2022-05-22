<?php
/**
 * Created By: Amit Sarker
 * Created Date: 06-10-2020
 */
?>
{{csrf_field()}}
<div class="form-row">
    <div class="col-md-12">
        <div class="form-group"><label class="small mb-1" for="cost_name">Step Name</label><input
                class="form-control" id="step_name" name="step_name" type="text" placeholder="Name"
                value="{{!empty($stepInfo->step_name) ?$stepInfo->step_name : ''}}" required>
        </div>
    </div>
</div>
<div class="form-row">
    <div class="col-md-6">
        <div class="form-group"><label class="small mb-1" for="start_date">Start Date</label><input
                class="form-control" id="start_date" name="start_date" type="date" placeholder="Start Date"
                value="{{!empty($stepInfo->start_date) ?getFloat($stepInfo->start_date) : ''}}"
                required>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group"><label class="small mb-1" for="end_date">End Date</label><input
                class="form-control" id="end_date" name="end_date" type="date" placeholder="End Date"
                value="{{!empty($stepInfo->end_date) ?getFloat($stepInfo->end_date) : ''}}">
        </div>
    </div>
</div>
<div class="form-row">
    <div class="col-md-12">
        <div class="form-group"><label class="small mb-1" for="remarks">Description</label>
            <textarea class="form-control" id="description" name="description" placeholder="description"
                      rows="2">{{!empty($stepInfo->description) ?$stepInfo->description : ''}}</textarea>
        </div>
    </div>
</div>
<div class="form-group mt-4 mb-0">
    <button id="" class="btn btn-primary">{{!empty($buttonText) ? $buttonText : 'Save'}}</button>
</div>
