<?php
/**
 * Created By: Amit Sarker
 * Created Date: 28-08-2020
 */
?>

<div id="letterDetailsModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog"
     aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Letter</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                @if(!empty($letterDetails))
                    <?php
                    $description = !empty($letterDetails->description) ? $letterDetails->description : '';
                    ?>
                    <div id="DivIdToPrint">
                        {!! $description !!}
                    </div>

                @else
                    <div>No Data Found</div>
                @endif
            </div>
            <div class="modal-footer">
                <button id="printButton" type="button" class="btn btn-info" onclick='printDiv();'><i class="fa fa-print" aria-hidden="true"></i> Print</button>
                <button id="closeButton" type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Close</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function printDiv() {
        var divToPrint = document.getElementById('DivIdToPrint');
        var newWin = window.open('', 'Print-Window');
        newWin.document.open();
        newWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</body></html>');
        newWin.document.close();
        setTimeout(function () {
            newWin.close();
        }, 10);
    }
</script>
