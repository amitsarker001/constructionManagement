<?php
/**
 * Created By: Amit Sarker
 * Created Date: 20-05-2022
 */
?>
    <!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{getCompanyName()}}</title>
    @include('admin.letter.pdfDesign.customCssForPdf')
    <style>
        @media print {
            .pageBreak {
                page-break-after: always !important;
            }
        }
    </style>
</head>
<body>
@if(!empty($letterDetails))
    <?php
    $description = !empty($letterDetails->description) ? $letterDetails->description : '';
    //$description = htmlspecialchars_decode($description);
    //$description = html_entity_decode($description);
    $description = strip_tags($description);
    ?>
    <div style="height: 50px;"></div>
    <div class="w-100" style="margin-top: 20px; padding: 20px; height: 750px;">
        <div id="letterInfo" class="letterInfo w-100" style="">
            {!! $description !!}
        </div>
    </div>
@else
    <div>No Data Found</div>
@endif
</body>
</html>

