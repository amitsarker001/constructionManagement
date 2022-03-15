<?php
/**
 * Created By: Amit Sarker
 * Created Date: 02-09-2020
 */
?>

<style type="text/css">

    .w-5 {
        width: 5%
    }

    .w-10 {
        width: 10%
    }

    .w-20 {
        width: 20%
    }

    .w-30 {
        width: 30%
    }

    .w-40 {
        width: 40%
    }

    .w-50 {
        width: 50%
    }

    .w-60 {
        width: 60%
    }

    .w-70 {
        width: 70%
    }

    .w-80 {
        width: 80%
    }

    .w-90 {
        width: 90%
    }

    .w-100 {
        width: 100%;
    }

    .float-left {
        float: left;
    }

    .float-right {
        float: right;
    }

    .text-left {
        text-align: left;
    }

    .text-right {
        text-align: right;
    }

    .text-center {
        text-align: center;
    }

    .text-justify {
        text-align: justify;
    }

    .error {
        color: red;
    }

    .success {
        color: green;
    }

    .border-0 {
        border: none;
    }

    .border-1 {
        border: 1px solid black;
    }

    .d-none {
        display: none;
    }

    .display-inline {
        display: inline;
    }

    .col,
    .col-1,
    .col-10,
    .col-11,
    .col-12,
    .col-2,
    .col-3,
    .col-4,
    .col-5,
    .col-6,
    .col-7,
    .col-8,
    .col-9,
    .col-auto,
    .col-lg,
    .col-lg-1,
    .col-lg-10,
    .col-lg-11,
    .col-lg-12,
    .col-lg-2,
    .col-lg-3,
    .col-lg-4,
    .col-lg-5,
    .col-lg-6,
    .col-lg-7,
    .col-lg-8,
    .col-lg-9,
    .col-lg-auto,
    .col-md,
    .col-md-1,
    .col-md-10,
    .col-md-11,
    .col-md-12,
    .col-md-2,
    .col-md-3,
    .col-md-4,
    .col-md-5,
    .col-md-6,
    .col-md-7,
    .col-md-8,
    .col-md-9,
    .col-md-auto,
    .col-sm,
    .col-sm-1,
    .col-sm-10,
    .col-sm-11,
    .col-sm-12,
    .col-sm-2,
    .col-sm-3,
    .col-sm-4,
    .col-sm-5,
    .col-sm-6,
    .col-sm-7,
    .col-sm-8,
    .col-sm-9,
    .col-sm-auto,
    .col-xl,
    .col-xl-1,
    .col-xl-10,
    .col-xl-11,
    .col-xl-12,
    .col-xl-2,
    .col-xl-3,
    .col-xl-4,
    .col-xl-5,
    .col-xl-6,
    .col-xl-7,
    .col-xl-8,
    .col-xl-9,
    .col-xl-auto {
        position: relative;
        width: 100%;
        padding-right: 15px;
        padding-left: 15px;
    }

    .col {
        -ms-flex-preferred-size: 0;
        flex-basis: 0;
        -ms-flex-positive: 1;
        flex-grow: 1;
        max-width: 100%;
    }

    .col-auto {
        -ms-flex: 0 0 auto;
        flex: 0 0 auto;
        width: auto;
        max-width: 100%;
    }

    .col-1 {
        -ms-flex: 0 0 8.333333%;
        flex: 0 0 8.333333%;
        max-width: 8.333333%;
    }

    .col-2 {
        -ms-flex: 0 0 16.666667%;
        flex: 0 0 16.666667%;
        max-width: 16.666667%;
    }

    .col-3 {
        -ms-flex: 0 0 25%;
        flex: 0 0 25%;
        max-width: 25%;
    }

    .col-4 {
        -ms-flex: 0 0 33.333333%;
        flex: 0 0 33.333333%;
        max-width: 33.333333%;
    }

    .col-5 {
        -ms-flex: 0 0 41.666667%;
        flex: 0 0 41.666667%;
        max-width: 41.666667%;
    }

    .col-6 {
        -ms-flex: 0 0 50%;
        flex: 0 0 50%;
        max-width: 50%;
    }

    .col-7 {
        -ms-flex: 0 0 58.333333%;
        flex: 0 0 58.333333%;
        max-width: 58.333333%;
    }

    .col-8 {
        -ms-flex: 0 0 66.666667%;
        flex: 0 0 66.666667%;
        max-width: 66.666667%;
    }

    .col-9 {
        -ms-flex: 0 0 75%;
        flex: 0 0 75%;
        max-width: 75%;
    }

    .col-10 {
        -ms-flex: 0 0 83.333333%;
        flex: 0 0 83.333333%;
        max-width: 83.333333%;
    }

    .col-11 {
        -ms-flex: 0 0 91.666667%;
        flex: 0 0 91.666667%;
        max-width: 91.666667%;
    }

    .col-12 {
        -ms-flex: 0 0 100%;
        flex: 0 0 100%;
        max-width: 100%;
    }

    .order-first {
        -ms-flex-order: -1;
        order: -1;
    }

    .order-last {
        -ms-flex-order: 13;
        order: 13;
    }

    .order-0 {
        -ms-flex-order: 0;
        order: 0;
    }

    .order-1 {
        -ms-flex-order: 1;
        order: 1;
    }

    .order-2 {
        -ms-flex-order: 2;
        order: 2;
    }

    .order-3 {
        -ms-flex-order: 3;
        order: 3;
    }

    .order-4 {
        -ms-flex-order: 4;
        order: 4;
    }

    .order-5 {
        -ms-flex-order: 5;
        order: 5;
    }

    .order-6 {
        -ms-flex-order: 6;
        order: 6;
    }

    .order-7 {
        -ms-flex-order: 7;
        order: 7;
    }

    .order-8 {
        -ms-flex-order: 8;
        order: 8;
    }

    .order-9 {
        -ms-flex-order: 9;
        order: 9;
    }

    .order-10 {
        -ms-flex-order: 10;
        order: 10;
    }

    .order-11 {
        -ms-flex-order: 11;
        order: 11;
    }

    .order-12 {
        -ms-flex-order: 12;
        order: 12;
    }

    .offset-1 {
        margin-left: 8.333333%;
    }

    .offset-2 {
        margin-left: 16.666667%;
    }

    .offset-3 {
        margin-left: 25%;
    }

    .offset-4 {
        margin-left: 33.333333%;
    }

    .offset-5 {
        margin-left: 41.666667%;
    }

    .offset-6 {
        margin-left: 50%;
    }

    .offset-7 {
        margin-left: 58.333333%;
    }

    .offset-8 {
        margin-left: 66.666667%;
    }

    .offset-9 {
        margin-left: 75%;
    }

    .offset-10 {
        margin-left: 83.333333%;
    }

    .offset-11 {
        margin-left: 91.666667%;
    }

    .col-sm {
        -ms-flex-preferred-size: 0;
        flex-basis: 0;
        -ms-flex-positive: 1;
        flex-grow: 1;
        max-width: 100%;
    }

    .col-sm-auto {
        -ms-flex: 0 0 auto;
        flex: 0 0 auto;
        width: auto;
        max-width: 100%;
    }

    .col-sm-1 {
        -ms-flex: 0 0 8.333333%;
        flex: 0 0 8.333333%;
        max-width: 8.333333%;
    }

    .col-sm-2 {
        -ms-flex: 0 0 16.666667%;
        flex: 0 0 16.666667%;
        max-width: 16.666667%;
    }

    .col-sm-3 {
        -ms-flex: 0 0 25%;
        flex: 0 0 25%;
        max-width: 25%;
    }

    .col-sm-4 {
        -ms-flex: 0 0 33.333333%;
        flex: 0 0 33.333333%;
        max-width: 33.333333%;
    }

    .col-sm-5 {
        -ms-flex: 0 0 41.666667%;
        flex: 0 0 41.666667%;
        max-width: 41.666667%;
    }

    .col-sm-6 {
        -ms-flex: 0 0 50%;
        flex: 0 0 50%;
        max-width: 50%;
    }

    .col-sm-7 {
        -ms-flex: 0 0 58.333333%;
        flex: 0 0 58.333333%;
        max-width: 58.333333%;
    }

    .col-sm-8 {
        -ms-flex: 0 0 66.666667%;
        flex: 0 0 66.666667%;
        max-width: 66.666667%;
    }

    .col-sm-9 {
        -ms-flex: 0 0 75%;
        flex: 0 0 75%;
        max-width: 75%;
    }

    .col-sm-10 {
        -ms-flex: 0 0 83.333333%;
        flex: 0 0 83.333333%;
        max-width: 83.333333%;
    }

    .col-sm-11 {
        -ms-flex: 0 0 91.666667%;
        flex: 0 0 91.666667%;
        max-width: 91.666667%;
    }

    .col-sm-12 {
        -ms-flex: 0 0 100%;
        flex: 0 0 100%;
        max-width: 100%;
    }

    .order-sm-first {
        -ms-flex-order: -1;
        order: -1;
    }

    .order-sm-last {
        -ms-flex-order: 13;
        order: 13;
    }

    .order-sm-0 {
        -ms-flex-order: 0;
        order: 0;
    }

    .order-sm-1 {
        -ms-flex-order: 1;
        order: 1;
    }

    .order-sm-2 {
        -ms-flex-order: 2;
        order: 2;
    }

    .order-sm-3 {
        -ms-flex-order: 3;
        order: 3;
    }

    .order-sm-4 {
        -ms-flex-order: 4;
        order: 4;
    }

    .order-sm-5 {
        -ms-flex-order: 5;
        order: 5;
    }

    .order-sm-6 {
        -ms-flex-order: 6;
        order: 6;
    }

    .order-sm-7 {
        -ms-flex-order: 7;
        order: 7;
    }

    .order-sm-8 {
        -ms-flex-order: 8;
        order: 8;
    }

    .order-sm-9 {
        -ms-flex-order: 9;
        order: 9;
    }

    .order-sm-10 {
        -ms-flex-order: 10;
        order: 10;
    }

    .order-sm-11 {
        -ms-flex-order: 11;
        order: 11;
    }

    .order-sm-12 {
        -ms-flex-order: 12;
        order: 12;
    }

    .offset-sm-0 {
        margin-left: 0;
    }

    .offset-sm-1 {
        margin-left: 8.333333%;
    }

    .offset-sm-2 {
        margin-left: 16.666667%;
    }

    .offset-sm-3 {
        margin-left: 25%;
    }

    .offset-sm-4 {
        margin-left: 33.333333%;
    }

    .offset-sm-5 {
        margin-left: 41.666667%;
    }

    .offset-sm-6 {
        margin-left: 50%;
    }

    .offset-sm-7 {
        margin-left: 58.333333%;
    }

    .offset-sm-8 {
        margin-left: 66.666667%;
    }

    .offset-sm-9 {
        margin-left: 75%;
    }

    .offset-sm-10 {
        margin-left: 83.333333%;
    }

    .offset-sm-11 {
        margin-left: 91.666667%;
    }

    .form-group {
        margin-bottom: 1rem;
    }

    .row {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;
        margin-right: -15px;
        margin-left: -15px;
    }

    .font-weight-bold {
        font-weight: bold;
    }

    .col-form-label {
        padding-top: calc(0.375rem + 1px);
        padding-bottom: calc(0.375rem + 1px);
        margin-bottom: 0;
        font-size: inherit;
        line-height: 1.5;
    }

    .table-bordered {
        border: 1px solid black;
    }

    .table-bordered td,
    .table-bordered th {
        border: 1px solid black;
    }

    .table {
        border-collapse: collapse !important;
    }

    .pb-10 {
        padding-bottom: 10px;
    }

    .pb-20 {
        padding-bottom: 20px;
    }

    .pb-30 {
        padding-bottom: 30px;
    }

    .pb-40 {
        padding-bottom: 40px;
    }

    .pb-50 {
        padding-bottom: 50px;
    }

    #assetLiabilitiesBlock table {
        font-size: 12px;
    }

    .imgTickBox {
        height: 15px;
        width: 15px;
    }

</style>
