<?php
/**
 * Created By: Amit Sarker
 * Created Date: 05-10-2020
 */
?>

<?php
//$costList = !empty($data['costList']) ? $data['costList'] : '';
?>
<div id="reportTableSection" class="w-100 report-table">
    <div class="table-responsive">
        <table class="table table-bordered" id="" width="100%" cellspacing="0">
            <thead>
            <tr>
                <th>SL</th>
                <th>Step Name</th>
                <th class="text-right">Amount Total</th>
                <th class="text-right">Increase Amount Total</th>
                @if(session()->get('userSession')->user_type_id == 1)
{{--                    <th>User</th>--}}
                @endif
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
{{--                            <td>{{ $userName }}</td>--}}
                        @endif
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
</div>

<div id="DivIdToPrint" style="display: none;">
    <style>
        .print-table, th, td {
            border: 1px solid;
        }

        .text-right {
            text-align: right !important;
        }

        .font-weight-bold {
            font-weight: bold;
        }
    </style>
    <div id="" class="w-100">
        <div class="font-weight-bold">
            Cost Summary Report
        </div>
        <hr>
        <div class="table-responsive">
            <table class="table table-bordered" id="" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>SL</th>
                    <th>Step Name</th>
                    <th class="text-right">Amount Total</th>
                    <th class="text-right">Increase Amount Total</th>
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
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

<script type="text/javascript">

    $('#printButton').click(function (e) {
        e.preventDefault();
        printDivById('DivIdToPrint')
    });

</script>
