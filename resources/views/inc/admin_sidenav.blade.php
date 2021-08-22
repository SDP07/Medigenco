<!--MAIN NAVIGATION-->
<!--===================================================-->
<nav id="mainnav-container">
    <div id="mainnav">

        <!--Menu-->
        <!--================================-->
        <div id="mainnav-menu-wrap">
            <div class="nano">
                <div class="nano-content">
                    <!--Shortcut buttons-->
                    <!--================================-->
                    <div id="mainnav-shortcut" class="hidden">
                        <ul class="list-unstyled shortcut-wrap">
                            <li class="col-xs-3" data-content="My Profile">
                                <a class="shortcut-grid" href="#">
                                    <div class="icon-wrap icon-wrap-sm icon-circle bg-mint">
                                    <i class="demo-pli-male"></i>
                                    </div>
                                </a>
                            </li>
                            <li class="col-xs-3" data-content="Messages">
                                <a class="shortcut-grid" href="#">
                                    <div class="icon-wrap icon-wrap-sm icon-circle bg-warning">
                                    <i class="demo-pli-speech-bubble-3"></i>
                                    </div>
                                </a>
                            </li>
                            <li class="col-xs-3" data-content="Activity">
                                <a class="shortcut-grid" href="#">
                                    <div class="icon-wrap icon-wrap-sm icon-circle bg-success">
                                    <i class="demo-pli-thunder"></i>
                                    </div>
                                </a>
                            </li>
                            <li class="col-xs-3" data-content="Lock Screen">
                                <a class="shortcut-grid" href="#">
                                    <div class="icon-wrap icon-wrap-sm icon-circle bg-purple">
                                    <i class="demo-pli-lock-2"></i>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!--================================-->
                    <!--End shortcut buttons-->


                    <ul id="mainnav-menu" class="list-group">

                        <!--Category name-->
                        {{-- <li class="list-header">Navigation</li> --}}

                        <!--Menu list item-->
                        <li class="{{ areActiveRoutes(['admin_dashboard'])}}">
                            <a class="nav-link" href="{{route('admin_dashboard')}}">
                                <i class="fa fa-home"></i>
                                <span class="menu-title">{{translate('Dashboard')}}</span>
                            </a>
                        </li>

                        @if (\App\Addon::where('unique_identifier', 'pos_system')->first() != null && \App\Addon::where('unique_identifier', 'pos_system')->first()->activated)

                            <li>
                                <a href="#">
                                    <i class="fa fa-print"></i>
                                    <span class="menu-title">{{translate('POS Manager')}}</span>
                                    <i class="arrow"></i>
                                </a>

                                <!--Submenu-->
                                <ul class="collapse">
                                    <li class="">
                                        <a class="nav-link" href="">{{translate('POS Manager')}}</a>
                                    </li>
                                    <li class="">
                                        <a class="nav-link" href="">{{translate('POS Configuration')}}</a>
                                    </li>
                                </ul>
                            </li>
                        @endif

                        <!-- Product Menu -->
                        @if(Auth::user()->user_type == '1' )
                        <li class="">
                            <a class="nav-link" href="{{ route('locations.index','locations.create','locations.edit') }}">
                                <i class="fas fa-location-arrow"></i>
                                <span class="menu-title">{{translate('Locations')}}
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-briefcase"></i>
                                <span class="menu-title">{{translate('Doctors')}}</span>
                                <i class="arrow"></i>
                            </a>

                            <!--Submenu-->
                            <ul class="collapse">
                                <li class="{{ areActiveRoutes(['doctors.index','doctors.create','doctors.edit'])}}">
                                    <a class="nav-link" href="{{route('doctors.index')}}">{{translate('Doctor List')}}</a>
                                </li>
                                <li class="{{ areActiveRoutes(['clinic.doctor','doctors.create','doctors.edit'])}} }}">
                                    <a class="nav-link" href="{{ route('clinic.doctor') }}">{{translate('Clinic Timings')}}</a>
                                </li>
                            </ul>
                        </li>

                        <li class="">
                            <a class="nav-link" href="{{ route('clinics.index','clinics.create','clinics.edit') }}">
                                <i class="fa fa-stethoscope"></i>
                                <span class="menu-title">{{translate('Clinics')}}
                            </a>
                        </li>
                         <li>
                            <a href="#">
                                <i class="fa fa-h-square"></i>
                                <span class="menu-title">{{translate('Hospital')}}</span>
                                <i class="arrow"></i>
                            </a>

                            <!--Submenu-->
                            <ul class="collapse">
                                <li class="{{ areActiveRoutes(['hospitals.index','hospitals.create','hospitals.edit'])}}">
                                    <a class="nav-link" href="{{route('hospitals.index')}}">{{translate('Hospital List')}}</a>
                                </li>
                                <li class="{{ areActiveRoutes(['clinic.doctor','doctors.create','doctors.edit'])}} }}">
                                    <a class="nav-link" href="{{ route('clinic.doctor') }}">{{translate('Clinic Timings')}}</a>
                                </li>
                            </ul>
                        </li>
                        @endif

                       
                      

                       

                       

                        @if (\App\Addon::where('unique_identifier', 'refund_request')->first() != null)
                            <li>
                                <a href="#">
                                    <i class="fa fa-refresh"></i>
                                    <span class="menu-title">{{translate('Refund Request')}}</span>
                                    <i class="arrow"></i>
                                </a>

                                <!--Submenu-->
                                
                            </li>
                        @endif
                        

                       
                        
                        @if(Auth::user()->user_type == 'admin' )
                        <li>
                            <a href="#">
                                <i class="fa fa-briefcase"></i>
                                <span class="menu-title">{{translate('Business Settings')}}</span>
                                <i class="arrow"></i>
                            </a>

                            <!--Submenu-->
                            <ul class="collapse">
                                <li class="{{ areActiveRoutes(['activation.index'])}}">
                                    <a class="nav-link" href="{{route('activation.index')}}">{{translate('Activation')}}</a>
                                </li>
                                <li class="{{ areActiveRoutes(['payment_method.index'])}}">
                                    <a class="nav-link" href="{{ route('payment_method.index') }}">{{translate('Payment method')}}</a>
                                </li>
                                <li class="{{ areActiveRoutes(['smtp_settings.index'])}}">
                                    <a class="nav-link" href="{{ route('smtp_settings.index') }}">{{translate('SMTP Settings')}}</a>
                                </li>
                                <li class="{{ areActiveRoutes(['google_analytics.index'])}}">
                                    <a class="nav-link" href="{{ route('google_analytics.index') }}">{{translate('Google Analytics')}}</a>
                                </li>
                                <li class="{{ areActiveRoutes(['google_recaptcha.index'])}}">
                                    <a class="nav-link" href="{{ route('google_recaptcha.index') }}">{{translate('Google reCAPTCHA')}}</a>
                                </li>
                                <li class="{{ areActiveRoutes(['facebook_chat.index'])}}">
                                    <a class="nav-link" href="{{ route('facebook_chat.index') }}">{{translate('Facebook Chat & Pixel')}}</a>
                                </li>
                                <li class="{{ areActiveRoutes(['social_login.index'])}}">
                                    <a class="nav-link" href="{{ route('social_login.index') }}">{{translate('Social Media Login')}}</a>
                                </li>
                                <li class="{{ areActiveRoutes(['currency.index'])}}">
                                    <a class="nav-link" href="{{route('currency.index')}}">{{translate('Currency')}}</a>
                                </li>
                                <li class="{{ areActiveRoutes(['languages.index', 'languages.create', 'languages.store', 'languages.show', 'languages.edit'])}}">
                                    <a class="nav-link" href="{{route('languages.index')}}">{{translate('Languages')}}</a>
                                </li>
                            </ul>
                        </li>
                        @endif

                        @if(Auth::user()->user_type == 'admin' )
                        <li>
                            <a href="#">
                                <i class="fa fa-desktop"></i>
                                <span class="menu-title">{{translate('Frontend Settings')}}</span>
                                <i class="arrow"></i>
                            </a>

                            <!--Submenu-->
                        
                        </li>
                        @endif

                        @if(Auth::user()->user_type == 'admin')
                        <li>
                            <a href="#">
                                <i class="fa fa-gear"></i>
                                <span class="menu-title">{{translate('E-commerce Setup')}}</span>
                                <i class="arrow"></i>
                            </a>

                            <!--Submenu-->
                            <ul class="collapse">
                                <li class="{{ areActiveRoutes(['attributes.index','attributes.create','attributes.edit'])}}">
                                    <a class="nav-link" href="{{route('attributes.index')}}">{{translate('Attribute')}}</a>
                                </li>
                                <li class="{{ areActiveRoutes(['coupon.index','coupon.create','coupon.edit'])}}">
                                    <a class="nav-link" href="{{route('coupon.index')}}">{{translate('Coupon')}}</a>
                                </li>
                                <li>
                                    <li class="{{ areActiveRoutes(['pick_up_points.index','pick_up_points.create','pick_up_points.edit'])}}">
                                        <a class="nav-link" href="{{route('pick_up_points.index')}}">{{translate('Pickup Point')}}</a>
                                    </li>
                                </li>
                                <li>
                                    <li class="{{ areActiveRoutes(['shipping_configuration.index','shipping_configuration.edit','shipping_configuration.update'])}}">
                                        <a class="nav-link" href="{{route('shipping_configuration.index')}}">{{translate('Shipping Configuration')}}</a>
                                    </li>
                                </li>
                                <li>
                                    <li class="{{ areActiveRoutes(['countries.index','countries.edit','countries.update'])}}">
                                        <a class="nav-link" href="{{route('countries.index')}}">{{translate('Shipping Countries')}}</a>
                                    </li>
                                </li>
                            </ul>
                        </li>
                        @endif
					

                        @if (\App\Addon::where('unique_identifier', 'affiliate_system')->first() != null)
                            <li>
                                <a href="#">
                                    <i class="fa fa-link"></i>
                                    <span class="menu-title">{{translate('Affiliate System')}}</span>
                                    <i class="arrow"></i>
                                </a>

                                <!--Submenu-->
                                <ul class="collapse">
                                    <li class="{{ areActiveRoutes(['affiliate.configs'])}}">
                                        <a class="nav-link" href="{{route('affiliate.configs')}}">{{translate('Affiliate Configurations')}}</a>
                                    </li>
                                    <li class="{{ areActiveRoutes(['affiliate.index'])}}">
                                        <a class="nav-link" href="{{route('affiliate.index')}}">{{translate('Affiliate Options')}}</a>
                                    </li>
                                    <li class="{{ areActiveRoutes(['affiliate.users', 'affiliate_users.show_verification_request', 'affiliate_user.payment_history'])}}">
                                        <a class="nav-link" href="{{route('affiliate.users')}}">{{translate('Affiliate Users')}}</a>
                                    </li>
                                    <li class="{{ areActiveRoutes(['refferals.users'])}}">
                                        <a class="nav-link" href="{{route('refferals.users')}}">{{translate('Refferal Users')}}</a>
                                    </li>
                                    <li class="{{ areActiveRoutes(['affiliate.withdraw_requests'])}}">
                                        <a class="nav-link" href="{{route('affiliate.withdraw_requests')}}">{{translate('Affiliate Withdraw Request')}}</a>
                                    </li>

                                </ul>
                            </li>
                        @endif

                        @if (\App\Addon::where('unique_identifier', 'offline_payment')->first() != null)
                            <li>
                                <a href="#">
                                    <i class="fa fa-bank"></i>
                                    <span class="menu-title">{{translate('Offline Payment System')}}</span>
                                    <i class="arrow"></i>
                                </a>

                                <!--Submenu-->
                                <ul class="collapse">
                                    <li class="{{ areActiveRoutes(['manual_payment_methods.index', 'manual_payment_methods.create', 'manual_payment_methods.edit'])}}">
                                        <a class="nav-link" href="{{ route('manual_payment_methods.index') }}">{{translate('Manual Payment Methods')}}</a>
                                    </li>
                                    <li class="{{ areActiveRoutes(['offline_wallet_recharge_request.index'])}}">
                                        <a class="nav-link" href="{{ route('offline_wallet_recharge_request.index') }}">{{translate('Offline Wallet Rechage')}}</a>
                                    </li>
                                    <li class="{{ areActiveRoutes(['offline_seller_package_payment_request.index'])}}">
                                        <a class="nav-link" href="{{ route('offline_seller_package_payment_request.index') }}">{{translate('Offline Seller Package Payment')}}</a>
                                    </li>
                                    <li class="{{ areActiveRoutes(['offline_customer_package_payment_request.index'])}}">
                                        <a class="nav-link" href="{{ route('offline_customer_package_payment_request.index') }}">{{translate('Offline Customer Package Payment')}}</a>
                                    </li>
                                </ul>
                            </li>
                        @endif

                        @if (\App\Addon::where('unique_identifier', 'paytm')->first() != null)
                            <li>
                                <a href="#">
                                    <i class="fa fa-mobile"></i>
                                    <span class="menu-title">{{translate('Paytm Payment Gateway')}}</span>
                                    <i class="arrow"></i>
                                </a>

                                <!--Submenu-->
                                <ul class="collapse">
                                    <li class="{{ areActiveRoutes(['paytm.index'])}}">
                                        <a class="nav-link" href="{{route('paytm.index')}}">{{translate('Set Paytm Credentials')}}</a>
                                    </li>
                                </ul>
                            </li>
                        @endif

                        @if (\App\Addon::where('unique_identifier', 'club_point')->first() != null)
                            <li>
                                <a href="#">
                                    <i class="fa fa-btc"></i>
                                    <span class="menu-title">{{translate('Club Point System')}}</span>
                                    <i class="arrow"></i>
                                </a>

                                <!--Submenu-->
                                <ul class="collapse">
                                    <li class="{{ areActiveRoutes(['club_points.configs'])}}">
                                        <a class="nav-link" href="{{route('club_points.configs')}}">{{translate('Club Point Configurations')}}</a>
                                    </li>
                                    <li class="{{ areActiveRoutes(['set_product_points', 'product_club_point.edit'])}}">
                                        <a class="nav-link" href="{{route('set_product_points')}}">{{translate('Set Product Point')}}</a>
                                    </li>
                                    <li class="{{ areActiveRoutes(['club_points.index', 'club_point.details'])}}">
                                        <a class="nav-link" href="{{route('club_points.index')}}">{{translate('User Points')}}</a>
                                    </li>
                                </ul>
                            </li>
                        @endif

                        {{-- 
@if (\App\Addon::where('unique_identifier', 'otp_system')->first() != null)
                            <li>
                                <a href="#">
                                    <i class="fa fa-mobile"></i>
                                    <span class="menu-title">{{translate('OTP System')}}</span>
                                    <i class="arrow"></i>
                                </a>

                                <!--Submenu-->
                                <ul class="collapse">
                                    <li class="{{ areActiveRoutes(['otp.configconfiguration'])}}">
                                        <a class="nav-link" href="{{route('otp.configconfiguration')}}">{{translate('OTP Configurations')}}</a>
                                    </li>
                                    <li class="{{ areActiveRoutes(['otp_credentials.index'])}}">
                                        <a class="nav-link" href="{{route('otp_credentials.index')}}">{{translate('Set OTP Credentials')}}</a>
                                    </li>
                                </ul>
                            </li>
                        @endif --}}
                         
                         <li> 
                            <a href="#">
                                <i class="fa fa-database"></i>
                                <span class="menu-title">{{translate('Busy Control')}}</span>
                                <i class="arrow"></i>
                            </a>

                            <!--Submenu-->
                            <ul class="collapse">
                                <li class="">
                                    <a class="nav-link" href="">{{translate('Get Categories')}}</a> 
                                </li>
                                <li class="">
                                    <a class="nav-link" href="">{{translate('Get Sub Categories')}}</a>
                                </li>
                                <li class="">
                                    <a class="nav-link" href="">{{translate('Get All Units')}}</a>
                                </li>
                                <li class="">
                                    <a class="nav-link" href="">{{translate('Get All Tax Categories')}}</a>
                                </li>
                                <li class="">
                                    <a class="nav-link" href="">{{translate('Get Brands')}}</a>
                                </li>
                                  <li class="">
                                    <a class="nav-link" href="">{{translate('Get Products')}}</a>
                                </li>   
                            </ul>
                        </li>
                     

                        @if(Auth::user()->user_type == 'admin' )
                            @php
                                $support_ticket = DB::table('tickets')
                                            ->where('viewed', 0)
                                            ->select('id')
                                            ->count();
                            @endphp
                        <li class="{{ areActiveRoutes(['support_ticket.admin_index', 'support_ticket.admin_show'])}}">
                            <a class="nav-link" href="{{ route('support_ticket.admin_index') }}">
                                <i class="fa fa-support"></i>
                                <span class="menu-title">{{translate('Support Ticket')}} @if($support_ticket > 0)<span class="pull-right badge badge-info">{{ $support_ticket }}</span>@endif</span>
                            </a>
                        </li>
                        @endif

                        @if(Auth::user()->user_type == 'admin' )
                        <li class="{{ areActiveRoutes(['seosetting.index'])}}">
                            <a class="nav-link" href="{{ route('seosetting.index') }}">
                                <i class="fa fa-search"></i>
                                <span class="menu-title">{{translate('SEO Setting')}}</span>
                            </a>
                        </li>
                        @endif

                        @if(Auth::user()->user_type == 'admin' )
                        <li>
                            <a href="#">
                                <i class="fa fa-user"></i>
                                <span class="menu-title">{{translate('Staffs')}}</span>
                                <i class="arrow"></i>
                            </a>

                            <!--Submenu-->
                            <ul class="collapse">
                                <li class="{{ areActiveRoutes(['staffs.index', 'staffs.create', 'staffs.edit'])}}">
                                    <a class="nav-link" href="{{ route('staffs.index') }}">{{translate('All staffs')}}</a>
                                </li>
                                <li class="{{ areActiveRoutes(['roles.index', 'roles.create', 'roles.edit'])}}">
                                    <a class="nav-link" href="{{route('roles.index')}}">{{translate('Staff permissions')}}</a>
                                </li>
                            </ul>
                        </li>
                        @endif
                        @if(Auth::user()->user_type == 'admin' )
                            <li class="{{ areActiveRoutes(['addons.index', 'addons.create'])}}">
                                <a class="nav-link" href="{{ route('addons.index') }}">
                                    <i class="fa fa-wrench"></i>
                                    <span class="menu-title">{{translate('Addon Manager')}}</span>
                                </a>
                            </li>
                        @endif

                    </ul>
                </div>
            </div>
        </div>
        <!--================================-->
        <!--End menu-->

    </div>
</nav>
