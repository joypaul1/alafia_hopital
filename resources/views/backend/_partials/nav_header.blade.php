<nav class="navbar navbar-fixed-top">
  <div class="container-fluid">
      <div class="navbar-btn">
          <button type="button" class="btn-toggle-offcanvas"><i class="lnr lnr-menu fa fa-bars"></i></button>
      </div>
      <div class="navbar-brand">
          <a href="{{ url('admin/dashboard')}}">
            {{-- <img src="{{ asset('template_1') }}/imgs/theme/logo.png" alt="Logo" class="img-responsive logo" /> --}}
        </a>
      </div>
      <div class="navbar-right">

          <div id="navbar-menu">
              <ul class="nav navbar-nav">
                <li>
                    <a href="{{ route('backend.pos.index')}}"
                        target="_blank"
                    class="icon-menu d-none d-sm-block" data-toggle="tooltip" data-placement="bottom" title="POS">
                      <img src="{{ asset('assets/backend/pos.png') }}" alt="" style="width:22px;transform: scale(1.8)">

                    </a>
                </li>
                  <li>
                      <a href="{{ route('backend.siteConfig.filemanager')}}" class="icon-menu d-none d-sm-block d-md-none d-lg-block"><i class="fa fa-folder-open-o"></i></a>
                  </li>
                  <li>
                      <a href="{{ route('backend.personal-locker.index')}}"  class="icon-menu d-none d-sm-block d-md-none d-lg-block"><i class="icon-drawer"></i></a>
                  </li>
                  <li>
                      <a href="#" class="icon-menu d-none d-sm-block"><i class="icon-bubbles"></i></a>
                  </li>

                  <li class="dropdown">
                      <a href="javascript:void(0);" class="dropdown-toggle icon-menu" data-toggle="dropdown">
                          <i class="icon-bell"></i>
                          <span class="notification-dot"></span>
                      </a>
                      <ul class="dropdown-menu notifications">
                          <li class="header"><strong>You have 4 new Notifications</strong></li>
                          <li>
                              <a href="javascript:void(0);">
                                  <div class="media">
                                      <div class="media-left">
                                          <i class="icon-info text-warning"></i>
                                      </div>
                                      <div class="media-body">
                                          <p class="text">Campaign <strong>Holiday Sale</strong> is nearly reach budget limit.</p>
                                          <span class="timestamp">10:00 AM Today</span>
                                      </div>
                                  </div>
                              </a>
                          </li>
                          <li>
                              <a href="javascript:void(0);">
                                  <div class="media">
                                      <div class="media-left">
                                          <i class="icon-like text-success"></i>
                                      </div>
                                      <div class="media-body">
                                          <p class="text">Your New Campaign <strong>Holiday Sale</strong> is approved.</p>
                                          <span class="timestamp">11:30 AM Today</span>
                                      </div>
                                  </div>
                              </a>
                          </li>
                          <li>
                              <a href="javascript:void(0);">
                                  <div class="media">
                                      <div class="media-left">
                                          <i class="icon-pie-chart text-info"></i>
                                      </div>
                                      <div class="media-body">
                                          <p class="text">Website visits from Twitter is 27% higher than last week.</p>
                                          <span class="timestamp">04:00 PM Today</span>
                                      </div>
                                  </div>
                              </a>
                          </li>
                          <li>
                              <a href="javascript:void(0);">
                                  <div class="media">
                                      <div class="media-left">
                                          <i class="icon-info text-danger"></i>
                                      </div>
                                      <div class="media-body">
                                          <p class="text">Error on website analytics configurations</p>
                                          <span class="timestamp">Yesterday</span>
                                      </div>
                                  </div>
                              </a>
                          </li>
                          <li class="footer"><a href="javascript:void(0);" class="more">See all notifications</a></li>
                      </ul>
                  </li>
                  <li class="dropdown">
                      <a href="javascript:void(0);" class="dropdown-toggle icon-menu" data-toggle="dropdown"><i class="icon-equalizer"></i></a>
                      <ul class="dropdown-menu user-menu menu-icon">
                          <li class="menu-heading">ACCOUNT SETTINGS</li>
                          <li>
                              <a href="javascript:void(0);"><i class="icon-note"></i> <span>Basic</span></a>
                          </li>
                          <li>
                              <a href="javascript:void(0);"><i class="icon-equalizer"></i> <span>Preferences</span></a>
                          </li>
                          <li>
                              <a href="javascript:void(0);"><i class="icon-lock"></i> <span>Privacy</span></a>
                          </li>
                          <li>
                              <a href="javascript:void(0);"><i class="icon-bell"></i> <span>Notifications</span></a>
                          </li>
                          <li class="menu-heading">BILLING</li>
                          <li>
                              <a href="javascript:void(0);"><i class="icon-credit-card"></i> <span>Payments</span></a>
                          </li>
                          <li>
                              <a href="javascript:void(0);"><i class="icon-printer"></i> <span>Invoices</span></a>
                          </li>
                          <li>
                              <a href="javascript:void(0);"><i class="icon-refresh"></i> <span>Renewals</span></a>
                          </li>
                      </ul>
                  </li>
                  <li>
                      <a href="{{ route('backend.admin.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="icon-menu"><i class="icon-login"></i></a>
                        <form id="logout-form" action="{{ route('backend.admin.logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                  </li>
              </ul>
          </div>
      </div>
  </div>
</nav>
