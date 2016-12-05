<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- styles -->
    <link href="/css/styles.css" rel="stylesheet">
    <link href="/css/jquery-ui.min.css" rel="stylesheet">

    <link href="/css/font-awesome.css" rel="stylesheet">
    <link href="/vendors/form-helpers/css/bootstrap-formhelpers.min.css" rel="stylesheet">
    <link href="/vendors/select/bootstrap-select.min.css" rel="stylesheet">
    <link href="/vendors/tags/css/bootstrap-tags.css" rel="stylesheet">
    <link href="/vendors/bootstrap-datetimepicker/datetimepicker.css" rel="stylesheet">

    <link href="/css/forms.css" rel="stylesheet">
    <style type="text/css">
    .text_bold {font-weight: bold !important; font-size: 14px;}
    .clear{ clear: both; }
    .p-l-0{padding-left: 0px !important;}
    .p-r-0{padding-right: 0px !important;}
    .m-b-15{margin-bottom: 15px !important;}
    </style>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Styles -->
    <!-- <link href="/css/app.css" rel="stylesheet"> -->

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
    <div class="header">
         <div class="container">
            <div class="row">
               <div class="col-md-5">
                  <!-- Logo -->
                  <div class="logo">
                     <h1><a href="/home">Unique Travel</a></h1>
                  </div>
               </div>
               @if (Auth::check())
               <div class="col-md-2 pull-right">
                  <div class="navbar navbar-inverse" role="banner">
                      <nav class="collapse navbar-collapse bs-navbar-collapse navbar-right" role="navigation">
                        <ul class="nav navbar-nav">
                          <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"> {{ Auth::user()->name }} <b class="caret"></b></a>
                            <ul class="dropdown-menu animated fadeInUp">
                                <li>
                                <a href="{{ url('/logout') }}"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                                </li>
                            </ul>
                          </li>
                        </ul>
                      </nav>
                  </div>
               </div>
               @endif
            </div>
         </div>
    </div>

    <div class="page-content">
        <div class="row">
          <div class="col-md-3">
            <!-- @if (Auth::check()) -->
            <div class="sidebar content-box" style="display: block;">
                <ul class="nav">
                    <!-- Main menu -->
                    <li class="current"><a href="/home"><i class="glyphicon glyphicon-home"></i> Dashboard</a></li>
                    <li class="submenu current {{ Request::is('profiles') ? 'open' : '' }} {{ Request::is('profiles/add') ? 'open' : '' }}">
                         <a href="#">
                            <i class="glyphicon glyphicon-list"></i> Manage Profile
                            <span class="caret pull-right"></span>
                         </a>
                         <!-- Sub menu -->
                         <ul>
                            <li class="current"><a href="/profiles/add">Create Profile</a></li>
                            <li><a href="/profiles">View/Edit Profile</a></li>
                        </ul>
                    </li>
                    <li class="submenu current {{ Request::is('users') ? 'open' : '' }} {{ Request::is('users/add') ? 'open' : '' }} {{ Request::is('users/index') ? 'open' : '' }}">
                         <a href="#">
                            <i class="glyphicon glyphicon-list"></i>Manage Users
                            <span class="caret pull-right"></span>
                         </a>
                         <!-- Sub menu -->
                         <ul>
                            <li class="current"><a href="/users/add">Create User</a></li>
                            <li><a href="/users">Edit/View User</a></li>
                        </ul>
                    </li>
                    <li class="submenu current {{ Request::is('parties') ? 'open' : '' }} {{ Request::is('parties/add') ? 'open' : '' }}">
                         <a href="#">
                            <i class="glyphicon glyphicon-list"></i> Manage Vendor/Client
                            <span class="caret pull-right"></span>
                         </a>
                         <!-- Sub menu -->
                         <ul>
                            <li class="current"><a href="/parties/add">Create Vendor/Client</a></li>
                            <li><a href="/parties">View/Edit Vendor/Client</a></li>
                        </ul>
                    </li>
                    <li class="submenu current {{ Request::is('vouchers') ? 'open' : '' }} {{ Request::is('vouchers/sale_voucher') ? 'open' : '' }} {{ Request::is('vouchers/list_sale_voucher') ? 'open' : '' }}">
                         <a href="#">
                            <i class="glyphicon glyphicon-list"></i> Manage Sale Vouchers
                            <span class="caret pull-right"></span>
                         </a>
                         <!-- Sub menu -->
                         <ul>
                            <li class="current"><a href="/vouchers/sale_voucher">Create Sale Vouchers</a></li>
                            <li class="current"><a href="/vouchers/list_sale_voucher">List Sale Vouchers</a></li>
                        </ul>
                    </li>
                    <li class="submenu current {{ Request::is('refund_vouchers') ? 'open' : '' }} {{ Request::is('refund_vouchers/refund_voucher') ? 'open' : '' }} {{ Request::is('refund_vouchers/list_refund_voucher') ? 'open' : '' }}">
                         <a href="#">
                            <i class="glyphicon glyphicon-list"></i> Manage Refund Vouchers
                            <span class="caret pull-right"></span>
                         </a>
                         <!-- Sub menu -->
                         <ul>
                            <li class="current"><a href="/refund_vouchers/refund_voucher">Create Refund Vouchers</a></li>
                            <li class="current"><a href="/refund_vouchers/list_refund_voucher">List Refund Vouchers</a></li>
                        </ul>
                    </li>
                    <li class="hide submenu current {{ Request::is('accounts') ? 'open' : '' }} {{ Request::is('accounts/frm_ledger') ? 'open' : '' }} {{ Request::is('accounts/view_ledger') ? 'open' : '' }} {{ Request::is('accounts/list_transections') ? 'open' : '' }}">
                         <a href="#">
                            <i class="glyphicon glyphicon-list"></i> Manage Accounts
                            <span class="caret pull-right"></span>
                         </a>
                         <!-- Sub menu -->
                         <ul>
                            <li class="current"><a href="/accounts/list_transections">List of Transections</a></li>
                            <li class="current"><a href="/accounts/frm_ledger">Journal Ledger</a></li>
                        </ul>
                    </li>
                    <li class="hide submenu current {{ Request::is('reports') ? 'open' : '' }} {{ Request::is('reports/view_purchase_stock') ? 'open' : '' }} {{ Request::is('reports/view_sale_stock') ? 'open' : '' }} {{ Request::is('reports/view_today_stock') ? 'open' : '' }}">
                         <a href="#">
                            <i class="glyphicon glyphicon-list"></i> Manage Reports
                            <span class="caret pull-right"></span>
                         </a>
                         <!-- Sub menu -->
                         <ul>
                            <li class="current"><a href="/reports/view_purchase_stock">Purchase Stock</a></li>
                            <li><a href="/reports/view_sale_stock">Sale Stock</a></li>
                            <li><a href="/reports/view_today_stock">Today Stock</a></li>
                        </ul>
                    </li>

                    <li class="submenu current {{ Request::is('payment_vouchers/receive_payment') ? 'open' : '' }} {{ Request::is('payment_vouchers/payment_voucher') ? 'open' : '' }} {{ Request::is('payment_vouchers/journal_voucher') ? 'open' : '' }} ">
                         <a href="#">
                            <i class="glyphicon glyphicon-list"></i> Manage Payment Vouchers
                            <span class="caret pull-right"></span>
                         </a>
                         <!-- Sub menu -->
                         <ul>
                            <li class="current"><a href="/payment_vouchers/receive_payment">Receive Payment</a></li>
                            <li><a href="/payment_vouchers/payment_voucher">Payment Voucher</a></li>
                            <li><a href="/payment_vouchers/journal_voucher">Journal Voucher</a></li>
                        </ul>
                    </li>

                    

                    <li class="submenu current {{ Request::is('permissions/add') ? 'open' : '' }} {{ Request::is('permissions/index') ? 'open' : '' }}">
                         <a href="#">
                            <i class="glyphicon glyphicon-list"></i> Manage Permission
                            <span class="caret pull-right"></span>
                         </a>
                         <!-- Sub menu -->
                         <ul>
                            <li class="current"><a href="/permissions/add">Create Permission</a></li>
                            <li><a href="/permissions">Edit/View Permission</a></li>
                        </ul>
                    </li>

                </ul>

                </ul>

             </div>
             <!-- @endif -->
          </div>
          @yield('content')
        </div>
    </div>

    <footer>
         <div class="container">
         
            <div class="copy text-center">
               Copyright {{ date("Y") }} <a href='#'>{{ config('app.name') }}</a>
            </div>
            
         </div>
      </footer>

    <!-- Scripts -->
    <!-- <script src="/js/app.js"></script> -->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="/js/jquery.js"></script>
    <script src="/js/jquery-ui.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/bootstrap/js/bootstrap.min.js"></script>
    <script src="/vendors/form-helpers/js/bootstrap-formhelpers.js"></script>

    <script src="/vendors/select/bootstrap-select.min.js"></script>

    <script src="/vendors/tags/js/bootstrap-tags.min.js"></script>

    <script src="/vendors/mask/jquery.maskedinput.min.js"></script>

    <script src="/vendors/moment/moment.min.js"></script>

    <script src="/vendors/wizard/jquery.bootstrap.wizard.min.js"></script>

     <!-- bootstrap-datetimepicker -->
     <script src="/vendors/bootstrap-datetimepicker/bootstrap-datetimepicker.js"></script> 


    <link href="/css/bootstrap-editable.css" rel="stylesheet"/>
    <script src="/js/bootstrap-editable.min.js"></script>

    <script src="/js/forms.js"></script>
    <script src="/js/custom.js"></script>
    <script type="text/javascript">
      $(document).ready(function () {
      $(".date-picker").datepicker('setDate', new Date());
      $(".form_datetime").datetimepicker('setDate', new Date());  
      // Numeric only control handler
      jQuery.fn.ForceNumericOnly =
      function()
      {
        return this.each(function()
        {
          $(this).keydown(function(e)
          {
            var key = e.charCode || e.keyCode || 0;
            // allow backspace, tab, delete, enter, arrows, numbers and keypad numbers ONLY
            // home, end, period, and numpad decimal
            return (
              key == 8 || 
              key == 9 ||
              key == 13 ||
              key == 46 ||
              key == 110 ||
              key == 190 ||
              (key >= 35 && key <= 40) ||
              (key >= 48 && key <= 57) ||
              (key >= 96 && key <= 105)
              );
          });
        });
      };   
      
      // Call Only numbers
      $(".number_only").ForceNumericOnly();
      
      // Keypress add commas in numbers
       $('input.number_only').keyup(function(event){
          // skip for arrow keys
          if(event.which >= 37 && event.which <= 40){
            event.preventDefault();
          }
          var $this = $(this);
          var num = $this.val().replace(/,/gi, "").split("").reverse().join("");
          var num2 = RemoveRougeChar(num.replace(/(.{3})/g,"$1,").split("").reverse().join(""));
          // the following line has been simplified. Revision history contains original.
          $this.val(num2);
        });
      });
      function RemoveRougeChar(convertString)
      {
        if(convertString.substring(0,1) == ",")
        {
          return convertString.substring(1, convertString.length)            
        }
        return convertString;
      }
    </script>
    @yield('custom_js')
</body>
</html>
