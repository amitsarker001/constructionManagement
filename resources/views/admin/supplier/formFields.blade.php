<?php
/**
 * Created By: Amit Sarker
 * Created Date: 06-10-2020
 */
?>
{{csrf_field()}}
<div class="form-row">
    <div class="col-md-12">
        <div class="form-group"><label class="small mb-1" for="supplier_name">Supplier Name</label><input
                class="form-control" id="supplier_name" name="supplier_name" type="text" placeholder="Name"
                value="{{!empty($supplierInfo->supplier_name) ?$supplierInfo->supplier_name : ''}}" required>
        </div>
    </div>
    <div class="col-md-6">

    </div>
</div>
<div class="form-row">
    <div class="col-md-12">
        <div class="form-group"><label class="small mb-1" for="address">Address</label>
            <textarea class="form-control" id="address" name="address"
                      rows="2">{{!empty($supplierInfo->address) ?$supplierInfo->address : ''}}</textarea>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group"><label class="small mb-1" for="mobile">supplier Status</label>
            <select class="form-control" id="isActive" name="is_active" required>
                <?php
                if (!empty($supplierInfo)) {  ?>
                <?php $isActive = !empty($supplierInfo->is_active) ? $supplierInfo->is_active : ''; ?>
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
