<?php
/**
 * Created By: Amit Sarker
 * Created Date: 06-10-2020
 */
?>
{{csrf_field()}}
<div class="form-row">
{{--    <div class="col-md-12">--}}
{{--        <div class="form-group"><label class="small mb-1" for="supplier_id">Supplier</label><input--}}
{{--                class="form-control" id="supplier_id" name="supplier_id" type="text" placeholder="Name"--}}
{{--                value="{{!empty($letterInfo->supplier_id) ?$letterInfo->supplier_id : ''}}" required>--}}
{{--        </div>--}}
{{--    </div>--}}
    <div class="col-md-12">
        <div class="form-group"><label class="small mb-1" for="entry_date">Entry Date</label><input
                class="form-control" id="entry_date" name="entry_date" type="date" placeholder="Entry Date"
                value="{{!empty($letterInfo->entry_date) ?getFloat($letterInfo->entry_date) : ''}}">
        </div>
    </div>
</div>
<div class="form-row">
    <div class="col-md-12">
        <div class="form-group"><label class="small mb-1" for="subject">Subject</label><input
                class="form-control" id="subject" name="subject" type="text" placeholder="Subject"
                value="{{!empty($letterInfo->subject) ?$letterInfo->subject : ''}}" required>
        </div>
    </div>
</div>
<div class="form-row">
    <div class="col-md-12">
        <div class="form-group"><label class="small mb-1" for="description">Description</label>
            <textarea class="form-control ckeditor" id="description" name="description" placeholder="description"
                      rows="2">{{!empty($letterInfo->description) ?$letterInfo->description : ''}}</textarea>
        </div>
    </div>
</div>
<div class="form-group mt-4 mb-0">
    <button id="" class="btn btn-primary">{{!empty($buttonText) ? $buttonText : 'Save'}}</button>
</div>

<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.ckeditor').ckeditor();
    });
</script>
