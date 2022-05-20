<?php
/**
 * Created By: Amit Sarker
 * Created Date: 06-10-2020
 */
?>

<hr/>
<div class="table-responsive">
    <div class="font-weight-bold">Details:</div>
    <table class="table table-bordered" id="" width="100%" cellspacing="0">
        <thead>
        <tr>
            <th>SL</th>
            <th>Particulars</th>
            <th>Quantity</th>
            <th>Rate</th>
            <th>Amount</th>
            <th>Standard Rate</th>
            <th>Standard Amount</th>
            <th>Increase Rate (%)</th>
            <th>Increase Amount</th>
            <th width="50px">Action</th>
        </tr>
        </thead>
        <tbody>
        @php
            {{$costList = session()->get('arraydetailsSession');}}
        @endphp
        @if(!empty($costList))
            <?php $count = 1; ?>
            @foreach($costList as $cost)
                <?php
                $array_id = !empty($cost['array_id']) ? intval($cost['array_id']) : 0;
                $step = !empty($cost['step_name']) ? ($cost['step_name']) : '';
                $item = !empty($cost['item_name']) ? ($cost['item_name']) : '';
                $quantity = !empty($cost['quantity']) ? ($cost['quantity']) : 0;
                $rate = !empty($cost['rate']) ? ($cost['rate']) : 0;
                $amount = !empty($cost['amount']) ? ($cost['amount']) : 0;
                $standardRate = !empty($cost['standard_rate']) ? ($cost['standard_rate']) : 0;
                $standardAmount = !empty($cost['standard_amount']) ? ($cost['standard_amount']) : 0;
                $increaseRate = !empty($cost['increase_rate']) ? ($cost['increase_rate']) : 0;
                $increaseAmount = !empty($cost['increase_amount']) ? ($cost['increase_amount']) : 0;
                ?>
                <tr>
                    <td>{{ $count++ }}</td>
                    <td>{{ $item }}</td>
                    <td>{{ getFloat($quantity) }}</td>
                    <td>{{ getFloat($rate) }}</td>
                    <td>{{ getFloat($amount) }}</td>
                    <td>{{ getFloat($standardRate) }}</td>
                    <td>{{ getFloat($standardAmount) }}</td>
                    <td>{{ getFloat($increaseRate) }}</td>
                    <td>{{ getFloat($increaseAmount) }}</td>
                    <td>
                        <a style="margin: 1%" class="btn btn-danger float-right"
                           href="{{route('removeDetailsFromTable', ['id' => $array_id])}}"><i
                                class="fa fa-minus-circle" aria-hidden="true"></i></a>
                    <!-- <a style="margin: 1%" class="btn btn-secondary float-right"
                           href="{{route('costEdit', ['id' => $array_id])}}"><i class="fa fa-edit"
                                                                              aria-hidden="true"></i>Update</a> -->
                    </td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
</div>
