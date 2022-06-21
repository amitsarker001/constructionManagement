<?php
/**
 * Created By: Amit Sarker
 * Created Date: 05-10-2020
 */
?>
@extends('admin.layouts.admin')
@section('content')
    {{--    <h1 class="mt-4">{{$pageTitle}}</h1>--}}
    <div class="w-100">
        <div class="w-100">
            <div class="card mb-4">
                <div class="card-header">
                    <div class="row">
                        <div class="col-xs-12 col-md-8 font-weight-bold">
                            <i class="fa fa-list" aria-hidden="true"></i> {{ $pageTitle }}
                        </div>
                        <div class="col-xs-12 col-md-4">
                            <button id="printButton" type="button" class="btn btn-info float-right"><i class="fa fa-print" aria-hidden="true"></i> Print</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form id="reportForm" name="reportForm" class="reportForm"
                          method="POST"
                          action="{{route('itemwiseCostReportView')}}">
                        {{csrf_field()}}
                        <div class="form-row">
                            <div class="col-md-4">
                                <div class="form-group"><label class="small mb-1" for="supplier_id">Item</label>
                                    <select class="form-control" id="item_id" name="item_id" required>
                                        <option value="">Please Select</option>
                                        <?php $item_id = 0; ?>
                                        @if(!empty($itemList))
                                            @foreach($itemList as $item)
                                                <option
                                                    value="{{$item->id}}" {{($item_id == $item->id) ? 'selected' : ''}}>{{$item->item_name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" style="margin-top: 7%;" id=""
                                        class="btn btn-secondary addDetailsButton">
                                    <i class="fa fa-eye" aria-hidden="true"></i>Show
                                </button>
                            </div>
                        </div>
                    </form>
                    @include('admin.reports.itemwise_cost.list')
                </div>
            </div>
        </div>
    </div>
@endsection

