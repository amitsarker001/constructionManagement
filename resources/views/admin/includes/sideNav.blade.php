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
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts1"
               aria-expanded="false" aria-controls="collapseLayouts1">
                <div class="sb-nav-link-icon"><i class="fas fa-bars"></i></div>
                Settings
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapseLayouts1" aria-labelledby="headingOne"
                 data-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="{{route('step')}}">
                        <div class="sb-nav-link-icon"><i class="fas fa-product-hunt"></i></div>
                        Steps
                    </a>
                </nav>
            </div>
            <div class="collapse" id="collapseLayouts1" aria-labelledby="headingOne"
                 data-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="{{route('item')}}">
                        <div class="sb-nav-link-icon"><i class="fas fa-product-hunt"></i></div>
                        Items
                    </a>
                </nav>
            </div>
            <div class="collapse" id="collapseLayouts1" aria-labelledby="headingOne"
                 data-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="{{route('supplier')}}">
                        <div class="sb-nav-link-icon"><i class="fas fa-product-hunt"></i></div>
                        Suppliers
                    </a>
                </nav>
            </div>
            <div class="collapse" id="collapseLayouts1" aria-labelledby="headingOne"
                 data-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <?php $arr = array(1, 3); ?>
                    @if(in_array(session()->get('userSession')->user_type_id, $arr))
                        <a class="nav-link" href="{{route('adminUser')}}">
                            <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                            Users
                        </a>
                    @endif
                </nav>
            </div>
            {{--            @if(in_array(session()->get('userSession')->user_type_id, $arr))--}}



            <a class="nav-link" href="{{route('cost')}}">
                <div class="sb-nav-link-icon"><i class="fas fa-product-hunt"></i></div>
                Material Cost
            </a>
            <a class="nav-link" href="{{route('miscellaneous')}}">
                <div class="sb-nav-link-icon"><i class="fas fa-product-hunt"></i></div>
                Miscellaneous
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
                    <a class="nav-link" href="{{route('supplierwiseReport')}}">Supplier Report</a>
                </nav>
            </div>
            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne"
                 data-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="{{route('costSummaryReport')}}">Cost Report</a>
                </nav>
            </div>
            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne"
                 data-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="{{route('stepwiseCostReport')}}">Stepwsie Cost Report</a>
                </nav>
            </div>
            <a class="nav-link" href="{{route('budget')}}">
                <div class="sb-nav-link-icon"><i class="fas fa-product-hunt"></i></div>
                Budget
            </a>
            <a class="nav-link" href="{{route('letter')}}">
                <div class="sb-nav-link-icon"><i class="fas fa-product-hunt"></i></div>
                Letters
            </a>
        </div>
    </div>
    <div class="sb-sidenav-footer">
        <div class="small">Logged in as:</div>
        {{session()->get('userSession')->user_name}}
    </div>
</nav>
