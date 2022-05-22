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
                    <i class="fa fa-list" aria-hidden="true"></i> {{'Miscellaneous List'}}
                </div>
                <div class="col-xs-12 col-md-4">
                    <a class="btn btn-secondary float-right" href="{{route('miscellaneousCreate')}}"><i
                            class="fa fa-plus"
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
                        <th>Date</th>
                        <th>Name</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th>Total Cost</th>
                        <th>Remarks</th>
                        @if(session()->get('userSession')->user_type_id == 1)
                            <th>User</th>
                        @endif
                        <th width="220px">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!empty($miscellaneousList))
                        <?php
                        $count = 1;
                        $userObj = new \App\User();
                        ?>
                        @foreach($miscellaneousList as $miscellaneous)
                            <?php
                            $id = !empty($miscellaneous->id) ? intval($miscellaneous->id) : 0;
                            $costName = !empty($miscellaneous->cost_name) ? $miscellaneous->cost_name : '';
                            $quantity = !empty($miscellaneous->quantity) ? getFloat($miscellaneous->quantity) : getFloat(0);
                            $unitPrice = !empty($miscellaneous->unit_price) ? getFloat($miscellaneous->unit_price) : getFloat(0);
                            $totalCost = !empty($miscellaneous->total_cost) ? getFloat($miscellaneous->total_cost) : getFloat(0);

                            $remarks = !empty($miscellaneous->remarks) ? $miscellaneous->remarks : '';
                            $entryDate = !empty($miscellaneous->entry_date) ? getStringToDateFromatDmy($miscellaneous->entry_date) : '';
                            $userId = !empty($miscellaneous->user_id) ? intval($miscellaneous->user_id) : 0;
                            $userInfo = $userObj->getById($userId);
                            $userName = !empty($userInfo->user_name) ? $userInfo->user_name : '';
                            ?>
                            <tr>
                                <td>{{ $count++ }}</td>
                                <td>{{ $entryDate }}</td>
                                <td>{{ $costName }}</td>
                                <td>{{ $quantity }}</td>
                                <td>{{ $unitPrice }}</td>
                                <td>{{ $totalCost }}</td>
                                <td>{{ $remarks }}</td>
                                @if(session()->get('userSession')->user_type_id == 1)
                                    <td>{{ $userName }}</td>
                                @endif
                                <td>
                                    <a style="margin: 1%" class="btn btn-danger float-right"
                                       href="{{route('miscellaneousDelete', ['id' => $id])}}"><i
                                            class="fa fa-trash" aria-hidden="true"></i>Delete</a>
                                    <a style="margin: 1%" class="btn btn-secondary float-right"
                                       href="{{route('miscellaneousEdit', ['id' => $id])}}"><i class="fa fa-edit"
                                                                                               aria-hidden="true"></i>Update</a>
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
