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
                        {{--                        <th>Description</th>--}}
                        <th width="310px">Action</th>
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
                                <td>{{ getStringToDateFromatDmy($entryDate) }}</td>
                                <td>{{ $subject }}</td>
                                {{--                                <td>{{ $description }}</td>--}}
                                <td>
                                    <a href="{{ route('letterDetailsPrint') }}"
                                       data-id="{{ $id }}" type="button"
                                       class="btn btn-secondary viewDetailsButton" data-toggle="tooltip"
                                       data-placement="bottom" title="View Details"><i class="fa fa-eye-slash"
                                                                                       aria-hidden="true"></i> View</a>
                                    <a href="{{route('letterPrintToPdf', ['id' => $id])}}"
                                       data-id="{{ $id }}" type="button"
                                       class="btn btn-primary letterPrintToPdf d-none" data-toggle="tooltip"
                                       data-placement="bottom" title="PDF"><i class="fas fa-file-pdf"
                                                                                       aria-hidden="true"></i> PDF</a>
                                    <a href="{{route('letterEdit', ['id' => $id])}}"
                                       data-id="{{ $id }}" type="button"
                                       class="btn btn-secondary editButton" data-toggle="tooltip"
                                       data-placement="bottom" title="Edit"><i class="fa fa-edit"
                                                                               aria-hidden="true"></i> Update</a>
                                    <a href="{{route('letterDelete', ['id' => $id])}}"
                                       data-id="{{ $id }}" type="button"
                                       class="btn btn-danger deleteButton" data-toggle="tooltip"
                                       data-placement="bottom" title="Delete"><i class="fa fa-trash"
                                                                                       aria-hidden="true"></i> Delete</a>
                                    <div class="viewLetterDetailsModalSection"></div>
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
    $(document).ready(function () {
        $(".deleteButton").click(function () {
            if (!confirm("Are you sure ?")) {
                return false;
            }
        });

        $('.viewDetailsButton').unbind("click").bind('click', function (e) {
            e.preventDefault();
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
                        $('.viewLetterDetailsModalSection').html('');
                        $('.viewLetterDetailsModalSection').html(data);
                        $('#letterDetailsModal').modal('show');
                    },
                    error: function () {

                    },
                });
            } else {
                alert('Error Occurred.');
                return false;
            }
        });
    });
</script>
