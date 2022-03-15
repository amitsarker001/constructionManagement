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
                    <i class="fa fa-list" aria-hidden="true"></i> {{'Supplier List'}}
                </div>
                <div class="col-xs-12 col-md-4">
                    <a class="btn btn-secondary float-right" href="{{route('supplierCreate')}}"><i class="fa fa-plus"
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
                        <th>Address</th>
                        <th>Status</th>
                        <th width="220px">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!empty($supplierList))
                        <?php $count = 1; ?>
                        @foreach($supplierList as $supplier)
                            <?php
                            $id = !empty($supplier->id) ? intval($supplier->id) : 0;
                            $supplierName = !empty($supplier->supplier_name) ? $supplier->supplier_name : '';
                            $address = !empty($supplier->address) ? $supplier->address : '';
                            $isActive = !empty($supplier->is_active) ? $supplier->is_active : 0;
                            $isActiveText = ($isActive == 1) ? "Active" : "Inactive";
                            $isActiveTextClass = ($isActive == 1) ? "success" : "warning";
                            ?>
                            <tr>
                                <td>{{$count++}}</td>
                                <td>{{$supplierName}}</td>
                                <td>{{$address}}</td>
                                <td>
                                    <span style="display:inline-block; width:70px;"
                                          class="badge badge-{{$isActiveTextClass}}">{{$isActiveText}}</span>
                                </td>
                                <td>
                                    <a style="margin: 1%" class="btn btn-danger float-right" href="{{route('supplierDelete', ['id' => $id])}}"><i
                                            class="fa fa-trash" aria-hidden="true"></i>Delete</a>
                                    <a style="margin: 1%" class="btn btn-secondary float-right"
                                       href="{{route('supplierEdit', ['id' => $id])}}"><i class="fa fa-edit"
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
