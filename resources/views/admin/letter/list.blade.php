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
                    <i class="fa fa-list" aria-hidden="true"></i> {{'Letter List'}}
                </div>
                <div class="col-xs-12 col-md-4">
                    <a class="btn btn-secondary float-right" href="{{route('letterCreate')}}"><i class="fa fa-plus"
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
                        <th>Subject</th>
                        <th>Description</th>
                        <th width="220px">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!empty($letterList))
                        <?php $count = 1; ?>
                        @foreach($letterList as $letter)
                            <?php
                            $id = !empty($letter->id) ? intval($letter->id) : 0;
                            $entryDate = !empty($letter->entry_date) ? ($letter->entry_date) : '';
                            $subject = !empty($letter->subject) ? ($letter->subject) : '';
                            $description = !empty($letter->description) ? ($letter->description) : '';
                            ?>
                            <tr>
                                <td>{{ $count++ }}</td>
                                <td>{{ $entryDate }}</td>
                                <td>{{ $subject }}</td>
                                <td>{{ $description }}</td>
                                <td>
                                    <a style="margin: 1%" class="btn btn-danger float-right"
                                       href="{{route('letterDelete', ['id' => $id])}}"><i
                                            class="fa fa-trash" aria-hidden="true"></i>Delete</a>
                                    <a style="margin: 1%" class="btn btn-secondary float-right"
                                       href="{{route('letterEdit', ['id' => $id])}}"><i class="fa fa-edit"
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
