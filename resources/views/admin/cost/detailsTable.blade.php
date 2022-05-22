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
            <th>Supplier</th>
            <th>Status</th>
            <th>Notes</th>
            <th width="50px">Action</th>
        </tr>
        </thead>
        <tbody>
        @php
            {{ $costList = session()->get('arraydetailsSession'); }}
        @endphp
        <?php
        $count = 1;
        $amountSum = 0;
        $increaseAmountSum = 0;
        ?>
        @if(!empty($costList))
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
                $supplierName = !empty($cost['supplier_name']) ? ($cost['supplier_name']) : '';
                $status = !empty($cost['status']) ? ($cost['status']) : '';
                $notes = !empty($cost['notes']) ? ($cost['notes']) : '';
                $amountSum += $amount;
                $increaseAmountSum += $increaseAmount;
                ?>
                <tr>
                    <td>{{ $count++ }}</td>
                    <td class="text-right">{{ $item }}</td>
                    <td class="text-right">{{ getFloat($quantity) }}</td>
                    <td class="text-right">{{ getFloat($rate) }}</td>
                    <td class="text-right">{{ getFloat($amount) }}</td>
                    <td class="text-right">{{ getFloat($standardRate) }}</td>
                    <td class="text-right">{{ getFloat($standardAmount) }}</td>
                    <td class="text-right">{{ getFloat($increaseRate) }}</td>
                    <td class="text-right">{{ getFloat($increaseAmount) }}</td>
                    <td class="text-right">{{ ($supplierName) }}</td>
                    <td class="text-right">{{ ($status) }}</td>
                    <td class="text-right">{{ ($notes) }}</td>
                    <td>
                        <a data-toggle="tooltip" data-placement="bottom" title="View Details"
                           type="button" style="margin: 1%" class="btn btn-danger float-right removeDetailsButton"
                           data-id="{{ $array_id }}"
                           href="{{route('removeDetailsFromTable', ['id' => $array_id])}}"><i
                                class="fa fa-minus-circle" aria-hidden="true"></i></a>
                    </td>
                </tr>
            @endforeach
        @endif
        </tbody>
        <tfoot>
        <tr>
            <td colspan="4" class="font-weight-bold text-right">Total</td>
            <td class="font-weight-bold text-right">{{  getFloat($amountSum)  }}</td>
            <td class="font-weight-bold text-right"></td>
            <td class="font-weight-bold text-right"></td>
            <td class="font-weight-bold text-right"></td>
            <td class="font-weight-bold text-right">{{  getFloat($increaseAmountSum)  }}</td>
            <td class="font-weight-bold text-right"></td>
            <td class="font-weight-bold text-right"></td>
            <td class="font-weight-bold text-right"></td>
            <td class="font-weight-bold text-right"></td>
        </tr>
        </tfoot>
    </table>
</div>
<script>

    $('.removeDetailsButton').unbind("click").bind('click', function (e) {
        e.preventDefault();
        {{--var baseUrl = {!! json_encode(url('/')) !!};--}}
        // var url = baseUrl + '/getTaxInterestAmount';
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
                    $('#detailsTableSection').html(data);
                },
                error: function () {

                },
            });
        } else {
            alert('Error Occurred.');
            return false;
        }
    });
</script>
