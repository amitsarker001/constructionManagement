<?php
/**
 * Created By: Amit Sarker
 * Created Date: 06-10-2020
 */
?>

<hr/>
<div class="table-responsive">
    <div class="font-weight-bold">Item Details:</div>
    <table class="table table-bordered" id="" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>SL</th>
                <th>Step</th>
                <th>Item</th>
                <th>Quantity</th>
                <th width="120px">Action</th>
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
            ?>
            <tr>
                <td>{{$count++}}</td>
                <td>{{$step }}</td>
                <td>{{$item }}</td>
                <td>{{$quantity }}</td>
                <td>
                        <a style="margin: 1%" class="btn btn-danger float-right" href="{{route('removeDetailsFromTable', ['id' => $array_id])}}"><i
                                class="fa fa-trash" aria-hidden="true"></i>Delete</a>
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