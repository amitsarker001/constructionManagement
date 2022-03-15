<?php
/**
 * Created By: Amit Sarker
 * Created Date: 06-10-2020
 */
?>
{{csrf_field()}}
<div class="form-row">
    <div class="col-md-6">
        <div class="form-group"><label class="small mb-1" for="userName">Name</label><input
                class="form-control" id="userName" name="user_name" type="text" placeholder="Name"
                value="{{!empty($userInfo->user_name) ?$userInfo->user_name : ''}}" required>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group"><label class="small mb-1" for="email">Email</label><input
                class="form-control" id="email" name="email" type="email" placeholder="Email"
                value="{{!empty($userInfo->email) ?$userInfo->email : ''}}" required>
        </div>
    </div>
</div>
<div class="form-row">
    <div class="col-md-6">
        <div class="form-group"><label class="small mb-1" for="mobile">Mobile</label><input
                class="form-control" id="mobile" name="mobile" type="text"
                placeholder="Mobile" value="{{!empty($userInfo->mobile) ?$userInfo->mobile : ''}}" required></div>
    </div>
    <div class="col-md-6">
        <div class="form-group"><label class="small mb-1" for="mobile">User Type</label>
            <select class="form-control" id="userTypeId" name="user_type_id" required>
                <option value="">Please select</option>
                <?php $userTypeId = !empty($userInfo->user_type_id) ? $userInfo->user_type_id : ''; ?>
                @if(!empty($userTypeArray))
                    @foreach($userTypeArray as $key => $value)
                        @if($key != 3)
                            <option value="{{$key}}" {{($userTypeId==$key) ? 'selected' : ''}}>{{$value}}</option>
                        @endif
                    @endforeach
                @endif
            </select>
        </div>
    </div>
</div>
<div class="form-row">
    <div class="col-md-6">
        <div class="form-group"><label class="small mb-1" for="password">Password</label><input
                class="form-control" id="password" name="password" type="password"
                placeholder="Enter password" {{(!empty($userInfo->id) && $userInfo->id<=0) ? 'required' : ''}}>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group"><label class="small mb-1" for="confirmPassword">Confirm
                Password</label><input class="form-control" id="confirmPassword"
                                       name="confirm_password" type="password"
                                       placeholder="Confirm password" {{(!empty($userInfo->id) && $userInfo->id<=0) ? 'required' : ''}}>
        </div>
    </div>
</div>
<div class="form-row">
    <div class="col-md-6">
        <div class="form-group"><label class="small mb-1" for="address">Address</label>
            <textarea class="form-control" id="address" name="address" rows="2"
                      required>{{!empty($userInfo->address) ?$userInfo->address : ''}}</textarea>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group"><label class="small mb-1" for="mobile">User Status</label>
            <select class="form-control" id="isActive" name="is_active" required>
                <?php $isActive = !empty($userInfo->is_active) ? $userInfo->is_active : ''; ?>
                <option value="">Please select</option>
                <option value="1" {{($isActive==1) ? 'selected' : ''}}>Active</option>
                <option value="0" {{($isActive==0) ? 'selected' : ''}}>Inactive</option>
            </select>
        </div>
    </div>
</div>
<div class="form-group mt-4 mb-0">
    <button id="" class="btn btn-primary">{{!empty($buttonText) ? $buttonText : 'Save'}}</button>
</div>
