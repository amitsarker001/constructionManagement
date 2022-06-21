<?php
/**
 * Created By: Amit Sarker
 * Created Date: 21-06-2022
 */
?>
<div class="w-100">
    <div class="card mb-4">
        <div class="card-header">
            <div class="row">
                <div class="col-xs-12 col-md-8 font-weight-bold">
                    <i class="fa fa-list" aria-hidden="true"></i> {{'Receive Details'}}
                </div>
                <div class="col-xs-12 col-md-4">
                    <a class="btn btn-secondary float-right" href="{{route('receiveDetailsCreate')}}"><i class="fa fa-plus"
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
                        <th>Entry Date</th>
                        <th>Money Receipt No</th>
                        <th>Amount</th>
                        <th>Remarks</th>
                        <th width="220px">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!empty($receiveDetailsList))
                        <?php
                        $count = 1;
                        $totalReceiveAmount = 0;
                        ?>
                        @foreach($receiveDetailsList as $receiveDetailsInfo)
                            <?php
                            $id = !empty($receiveDetailsInfo->id) ? intval($receiveDetailsInfo->id) : 0;
                            $entryDate = !empty($receiveDetailsInfo->entry_date) ? getStringToDateFormatDmy($receiveDetailsInfo->entry_date) : '';
							$moneyReceiptNo = !empty($receiveDetailsInfo->money_receipt_no) ? ($receiveDetailsInfo->money_receipt_no) : '';
							$receiveAmount = !empty($receiveDetailsInfo->receive_amount) ? getFloat($receiveDetailsInfo->receive_amount) : getFloat(0);
                            $remarks = !empty($receiveDetailsInfo->remarks) ? ($receiveDetailsInfo->remarks) : '';
                            $totalReceiveAmount += $receiveAmount
                            ?>
                            <tr>
                                <td>{{$count++}}</td>
                                <td>{{$entryDate}}</td>
                                <td>{{$moneyReceiptNo}}</td>
                                <td>{{$receiveAmount}}</td>
                                <td>{{$remarks}}</td>
                                <td>
                                    <a style="margin: 1%" class="btn btn-danger float-right deleteButton" href="{{route('receiveDetailsDelete', ['id' => $id])}}"><i
                                            class="fa fa-trash" aria-hidden="true"></i>Delete</a>
                                    <a style="margin: 1%" class="btn btn-secondary float-right"
                                       href="{{route('receiveDetailsEdit', ['id' => $id])}}"><i class="fa fa-edit"
                                                                                          aria-hidden="true"></i>Update</a>
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>{{getFloat($totalReceiveAmount)}}</td>
                            <td></td>
                            <td></td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(".deleteButton").click(function () {
        if (!confirm("Are you sure ?")) {
            return false;
        }
    });
</script>
