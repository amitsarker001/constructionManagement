<?php
/**
 * Created By: Amit Sarker
 * Created Date: 20-08-2020
 */
?>

<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">
            <div class="sb-sidenav-menu-heading"></div>
            <a class="nav-link" href="{{route('dashboard')}}">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Dashboard
            </a>
            <?php $arr = array(1, 3); ?>
            @if(in_array(session()->get('userSession')->user_type_id, $arr))
                <a class="nav-link" href="{{route('adminUser')}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                    Users
                </a>
            @endif
            {{--            @if(in_array(session()->get('userSession')->user_type_id, $arr))--}}
            <a class="nav-link" href="{{route('step')}}">
                <div class="sb-nav-link-icon"><i class="fas fa-product-hunt"></i></div>
                Steps
            </a>
            <a class="nav-link" href="{{route('item')}}">
                <div class="sb-nav-link-icon"><i class="fas fa-product-hunt"></i></div>
                Items
            </a>
            <a class="nav-link" href="{{route('supplier')}}">
                <div class="sb-nav-link-icon"><i class="fas fa-product-hunt"></i></div>
                Suppliers
            </a>
            <a class="nav-link" href="{{route('cost')}}">
                <div class="sb-nav-link-icon"><i class="fas fa-product-hunt"></i></div>
                Material Cost
            </a>
            <a class="nav-link" href="{{route('miscellaneous')}}">
                <div class="sb-nav-link-icon"><i class="fas fa-product-hunt"></i></div>
                Miscellaneous
            </a>
            <a class="nav-link" href="{{route('letter')}}">
                <div class="sb-nav-link-icon"><i class="fas fa-product-hunt"></i></div>
                Letters
            </a>
            {{--            @endif--}}

            {{--            <div class="sb-sidenav-menu-heading">Interface</div>--}}
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts"
               aria-expanded="false" aria-controls="collapseLayouts">
                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                Reports
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne"
                 data-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="{{route('miscellaneous')}}">Report</a>
                </nav>
            </div>
        </div>
    </div>
    <div class="sb-sidenav-footer">
        <div class="small">Logged in as:</div>
        {{session()->get('userSession')->user_name}}
    </div>
</nav>
