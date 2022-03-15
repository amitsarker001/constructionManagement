<?php
/**
 * Created By: Amit Sarker
 * Created Date: 05-10-2020
 */
?>
<div class="w-100">
    <div class="card mb-4">
        <div class="card-header">
            <div class="row">
                <div class="col-xs-12 col-md-8 font-weight-bold">
                    <i class="fa fa-list" aria-hidden="true"></i> {{'User List'}}
                </div>
                <div class="col-xs-12 col-md-4">
                    <a class="btn btn-secondary float-right" href="{{route('adminUserCreate')}}"><i class="fa fa-plus"
                                                                                                    aria-hidden="true"></i>&nbsp;Create</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>SL</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>User Type</th>
                        <th>Address</th>
                        <th>Status</th>
                        <th width="130px">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!empty($userList))
                        <?php $count = 1; ?>
                        @foreach($userList as $userSingle)
                            <?php
                            $userType = '';
                            $userObj = new \App\User();
                            $userId = !empty($userSingle->id) ? $userSingle->id : 0;
                            $userName = !empty($userSingle->user_name) ? $userSingle->user_name : '';
                            $userEmail = !empty($userSingle->email) ? $userSingle->email : '';
                            $userMobile = !empty($userSingle->mobile) ? $userSingle->mobile : '';
                            $userTypeId = !empty($userSingle->user_type_id) ? intval($userSingle->user_type_id) : 0;
                            if ($userTypeId) {
                                $userType = getArrayValueByKey($userTypeId, $userObj->getUserTypeArray());
                            }
                            $userAddress = !empty($userSingle->address) ? $userSingle->address : '';
                            $isActive = !empty($userSingle->is_active) ? $userSingle->is_active : 0;
                            $isActiveText = ($isActive == 1) ? "Active" : "Inactive";
                            $isActiveTextClass = ($isActive == 1) ? "success" : "warning";
                            ?>
                            <tr>
                                <td>{{$count++}}</td>
                                <td>{{$userName}}</td>
                                <td>{{$userEmail}}</td>
                                <td>{{$userMobile}}</td>
                                <td>{{$userType}}</td>
                                <td>{{$userAddress}}</td>
                                <td>
                                    <span style="display:inline-block; width:70px;" class="badge badge-{{$isActiveTextClass}}">{{$isActiveText}}</span>
                                </td>
                                <td>
                                    {{--                                    <a style="margin: 1%" class="btn btn-danger float-right" href=""><i--}}
                                    {{--                                            class="fa fa-trash" aria-hidden="true"></i>Delete</a>--}}
                                    <a style="margin: 1%" class="btn btn-secondary float-right"
                                       href="{{route('adminUserEdit', ['id' => $userId])}}"><i
                                            class="fa fa-edit" aria-hidden="true"></i>Update</a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
