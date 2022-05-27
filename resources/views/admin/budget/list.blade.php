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
                    <i class="fa fa-list" aria-hidden="true"></i> {{'Budget'}}
                </div>
                <div class="col-xs-12 col-md-4">
                    @if($budgetList->isEmpty())
                        <a class="btn btn-secondary float-right" href="{{route('budgetCreate')}}"><i class="fa fa-plus"
                                                                                                     aria-hidden="true"></i>&nbsp;Create</a>
                    @endif
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>SL</th>
                        <th class="text-right">Cash Amount</th>
                        <th class="text-right">Extra Amount Claimed</th>
                        <th class="text-right">Total Allocated Funds</th>
                        <th class="text-right">Funds Remaining</th>
                        <th>Entry Date</th>
                        <th width="220px">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!empty($budgetList))
                        <?php $count = 1; ?>
                        @foreach($budgetList as $budget)
                            <?php
                            $id = !empty($budget->id) ? intval($budget->id) : 0;
                            $cash_amount = !empty($budget->cash_amount) ? $budget->cash_amount : 0;
                            $extra_amount_claimed = !empty($budget->extra_amount_claimed) ? $budget->extra_amount_claimed : 0;
                            $total_allocated_funds = !empty($budget->total_allocated_funds) ? $budget->total_allocated_funds : 0;
                            $funds_remaining = !empty($budget->funds_remaining) ? $budget->funds_remaining : 0;
                            $entry_date = !empty($budget->entry_date) ? $budget->entry_date : '';
                            ?>
                            <tr>
                                <td>{{ $count++ }}</td>
                                <td class="text-right">{{ getFloat($cash_amount) }}</td>
                                <td class="text-right">{{ getFloat($extra_amount_claimed) }}</td>
                                <td class="text-right">{{ getFloat($total_allocated_funds) }}</td>
                                <td class="text-right">{{ getFloat($funds_remaining) }}</td>
                                <td class="text-right">{{ getStringToDateFormatDmy($entry_date) }}</td>
                                <td>
                                    <a style="margin: 1%" class="btn btn-danger float-right deleteButton"
                                       href="{{route('budgetDelete', ['id' => $id])}}"><i
                                            class="fa fa-trash" aria-hidden="true"></i>Delete</a>
                                    <a style="margin: 1%" class="btn btn-secondary float-right"
                                       href="{{route('budgetEdit', ['id' => $id])}}"><i class="fa fa-edit"
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
<script type="text/javascript">
    $(".deleteButton").click(function () {
        if (!confirm("Are you sure ?")) {
            return false;
        }
    });
</script>
