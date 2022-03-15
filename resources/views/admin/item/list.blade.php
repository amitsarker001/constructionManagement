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
                    <i class="fa fa-list" aria-hidden="true"></i> {{'Item List'}}
                </div>
                <div class="col-xs-12 col-md-4">
                    <a class="btn btn-secondary float-right" href="{{route('itemCreate')}}"><i class="fa fa-plus"
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
                        <th>Name</th>
                        <th>unit</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th width="220px">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!empty($itemList))
                        <?php $count = 1; ?>
                        @foreach($itemList as $item)
                            <?php
                            $id = !empty($item->id) ? intval($item->id) : 0;
                            $itemName = !empty($item->item_name) ? $item->item_name : '';
                            $unit = !empty($item->unit) ? $item->unit : '';
                            $description = !empty($item->item_description) ? $item->item_description : '';
                            $isActive = !empty($item->is_active) ? $item->is_active : 0;
                            $isActiveText = ($isActive == 1) ? "Active" : "Inactive";
                            $isActiveTextClass = ($isActive == 1) ? "success" : "warning";
                            ?>
                            <tr>
                                <td>{{$count++}}</td>
                                <td>{{$itemName}}</td>
                                <td>{{$unit}}</td>
                                <td>{{$description}}</td>
                                <td>
                                    <span style="display:inline-block; width:70px;"
                                          class="badge badge-{{$isActiveTextClass}}">{{$isActiveText}}</span>
                                </td>
                                <td>
                                    <a style="margin: 1%" class="btn btn-danger float-right" href="{{route('itemDelete', ['id' => $id])}}"><i
                                            class="fa fa-trash" aria-hidden="true"></i>Delete</a>
                                    <a style="margin: 1%" class="btn btn-secondary float-right"
                                       href="{{route('itemEdit', ['id' => $id])}}"><i class="fa fa-edit"
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
