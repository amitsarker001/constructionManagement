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
                    <form id="supplierwiseReportForm" name="supplierwiseReportForm" class="supplierwiseReportForm"
                          method="POST"
                          action="{{route('supplierwiseReportView')}}">
                        {{csrf_field()}}
                        <div class="form-row d-none">
                            <div class="col-md-4">
                                <div class="form-group"><label class="small mb-1" for="supplier_id">Supplier
                                        Name</label>
                                    <select class="form-control" id="supplier_id" name="supplier_id" required>
                                        <option value="0">All</option>
                                        <?php $supplier_id = !empty($costInfo->supplier_id) ? $costInfo->supplier_id : 0; ?>
                                        @if(!empty($supplierList))
                                            @foreach($supplierList as $supplier)
                                                <option
                                                    value="{{$supplier->id}}" {{($supplier_id == $supplier->id) ? 'selected' : ''}}>{{$supplier->supplier_name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"><label class="small mb-1" for="supplier_id">Supplier
                                        Name</label>
                                    <select class="form-control" id="status" name="status" required>
                                        <?php $status = !empty($costInfo->status) ? $costInfo->status : ''; ?>
                                        <option value="{{'All'}}">{{'All'}}</option>
                                        @if(!empty(getCostStatusArray()))
                                            @foreach(getCostStatusArray() as $value)
                                                <option
                                                    value="{{$value}}" {{($status == $value) ? 'selected' : ''}}>{{$value}}</option>
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
                    @include('admin.reports.cost_summary.list')
                </div>
            </div>
        </div>
    </div>
@endsection

