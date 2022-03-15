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
                    <i class="fa fa-list" aria-hidden="true"></i> {{'Step List'}}
                </div>
                <div class="col-xs-12 col-md-4">
                    <a class="btn btn-secondary float-right" href="{{route('stepCreate')}}"><i class="fa fa-plus"
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
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Description</th>
                        <th width="220px">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!empty($stepList))
                        <?php $count = 1; ?>
                        @foreach($stepList as $step)
                            <?php
                            $id = !empty($step->id) ? intval($step->id) : 0;
                            $stepName = !empty($step->step_name) ? $step->step_name : '';
                            $startDate = !empty($step->start_date) ? ($step->start_date) : '';
                            $endDate = !empty($step->end_date) ? ($step->end_date) : '';
                            $description = !empty($step->description) ? ($step->description) : '';
                            ?>
                            <tr>
                                <td>{{$count++}}</td>
                                <td>{{$stepName}}</td>
                                <td>{{$startDate}}</td>
                                <td>{{$endDate}}</td>
                                <td>{{$description}}</td>
                                <td>
                                    <a style="margin: 1%" class="btn btn-danger float-right" href="{{route('stepDelete', ['id' => $id])}}"><i
                                            class="fa fa-trash" aria-hidden="true"></i>Delete</a>
                                    <a style="margin: 1%" class="btn btn-secondary float-right"
                                       href="{{route('stepEdit', ['id' => $id])}}"><i class="fa fa-edit"
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
