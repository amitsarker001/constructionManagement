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
                    <i class="fa fa-list" aria-hidden="true"></i> {{'Cost List'}}
                </div>
                <div class="col-xs-12 col-md-4">
                    <a class="btn btn-secondary float-right" href="{{route('costCreate')}}"><i class="fa fa-plus"
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
                        <th>Step Name</th>
                        <th class="text-right">Amount Total</th>
                        <th class="text-right">Increase Amount Total</th>
                        @if(session()->get('userSession')->user_type_id == 1)
                            <th>User</th>
                        @endif
                        <th width="200px">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!empty($costList))
                        <?php
                        $count = 1;
                        $stepObj = new \App\Step();
                        $userObj = new \App\User();
                        ?>
                        @foreach($costList as $cost)
                            <?php
                            $id = !empty($cost->id) ? intval($cost->id) : 0;
                            $stepId = !empty($cost->step_id) ? intval($cost->step_id) : 0;
                            $stepInfo = $stepObj->getById($stepId);
                            $stepName = !empty($stepInfo->step_name) ? $stepInfo->step_name : '';
                            $amountTotal = !empty($cost->amount_total) ? ($cost->amount_total) : 0;
                            $increaseAmountTotal = !empty($cost->increase_amount_total) ? ($cost->increase_amount_total) : 0;
                            $userId = !empty($cost->user_id) ? intval($cost->user_id) : 0;
                            $userInfo = $userObj->getById($userId);
                            $userName = !empty($userInfo->user_name) ? $userInfo->user_name : '';
                            ?>
                            <tr>
                                <td>{{ $count++ }}</td>
                                <td>{{ $stepName }}</td>
                                <td class="text-right">{{ getFloat($amountTotal) }}</td>
                                <td class="text-right">{{ getFloat($increaseAmountTotal) }}</td>
                                @if(session()->get('userSession')->user_type_id == 1)
                                    <td>{{ $userName }}</td>
                                @endif
                                <td>
                                    <a href="{{ route('stepWiseCostDetails') }}"
                                       data-id="{{ $id }}" type="button"
                                       class="btn btn-secondary viewDetailsButton" data-toggle="tooltip"
                                       data-placement="bottom" title="View Details"><i class="fa fa-eye-slash"
                                                                                       aria-hidden="true"></i> View</a>
                                    <a class="btn btn-danger float-right deleteButton"
                                       href="{{route('costDelete', ['id' => $id])}}"><i
                                            class="fa fa-trash" aria-hidden="true"></i>Delete</a>
                                    <a class="btn btn-secondary float-right d-none"
                                       href="{{route('costEdit', ['id' => $id])}}"><i class="fa fa-edit"
                                                                                      aria-hidden="true"></i>Update</a>
                                    <div class="viewDetailsDetailsModalSection"></div>
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
<script type="text/javascript">
    $(document).ready(function () {

        $(".deleteButton").click(function () {
            if (!confirm("Are you sure ?")) {
                return false;
            }
        });

        $('.viewDetailsButton').unbind("click").bind('click', function (e) {
            e.preventDefault();
            var id = 0;
            var thisButton = $(this);
            id = thisButton.attr('data-id');
            id = (id == '' || isNaN(id)) ? 0 : parseInt(id);
            if (id > 0) {
                $.ajax({
                    type: "GET",
                    url: thisButton.attr('href'),
                    data: {'id': id},
                    beforeSend: function () {
                        $('.viewDetailsButton').addClass('disabled');
                    },
                    complete: function () {
                        $('.viewDetailsButton').removeClass('disabled');
                    },
                    success: function (data) {
                        $('.viewDetailsDetailsModalSection').html('');
                        $('.viewDetailsDetailsModalSection').html(data);
                        $('#costDetailsModal').modal('show');
                    },
                    error: function () {

                    },
                });
            } else {
                alert('Error Occurred.');
                return false;
            }
        });
    });
</script>
