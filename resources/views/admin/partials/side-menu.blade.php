      <!-- Layout wrapper -->
      <div class="layout-wrapper layout-content-navbar">
          <div class="layout-container">
              <!-- Menu -->

              <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                  <div class="app-brand demo">
                      <a href="{{ route('admin.index') }}" class="app-brand-link">
                          <img src="{{ asset('assets/img/branding/watermark.png') }}" alt="">
                      </a>

                      <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
                          <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
                          <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
                      </a>
                  </div>

                  <div class="menu-inner-shadow"></div>

                  <ul class="menu-inner py-1">
                      <!-- Dashboards -->
                      <li class="menu-item {{ request()->is('admin*') ? 'active open' : '' }}">

                          <ul class="menu-sub">
                              <li class="menu-item {{ request()->routeIs('admin.index') ? 'active' : '' }}">
                                  <a href="{{ route('admin.index') }}" class="menu-link">
                                      <div data-i18n="Dashboard">Dashboard</div>
                                  </a>
                              </li>
                              <li class="menu-item {{ request()->routeIs('admin.hero') ? 'active' : '' }}">
                                  <a href="{{ route('admin.hero') }}" class="menu-link">
                                      <div data-i18n="Hero Images">Hero Images</div>
                                  </a>
                              </li>
                              <li class="menu-item {{ request()->routeIs('upcoming_events.index') ? 'active' : '' }}">
                                  <a href="{{ route('upcoming_events.index') }}" class="menu-link">
                                      <div data-i18n="Upcoming Events">Upcoming Events</div>
                                  </a>
                              </li>
                              <li class="menu-item {{ request()->routeIs('admin.race_types.index') ? 'active' : '' }}">
                                  <a href="{{ route('admin.race_types.index') }}" class="menu-link">
                                      <div data-i18n="Rider Category">Rider Category</div>
                                  </a>
                              </li>
                              <li class="menu-item {{ request()->routeIs('admin.drivers.index') ? 'active' : '' }}">
                                  <a href="{{ route('admin.drivers.index') }}" class="menu-link">
                                      <div data-i18n="Drivers">Drivers</div>
                                  </a>
                              </li>
                              <li class="menu-item {{ request()->routeIs('admin.stickers.index') ? 'active' : '' }}">
                                  <a href="{{ route('admin.stickers.index') }}" class="menu-link">
                                      <div data-i18n="Stickers">Stickers</div>
                                  </a>
                              </li>
                              <li class="menu-item {{ request()->routeIs('admin.feedbacks') ? 'active' : '' }}">
                                  <a href="{{ route('admin.feedbacks') }}" class="menu-link">
                                      <div data-i18n="User Feedback">User Feedback</div>
                                  </a>
                              </li>
                              <li class="menu-item {{ request()->routeIs('admin.users.index') ? 'active' : '' }}">
                                  <a href="{{ route('admin.users.index') }}" class="menu-link">
                                      <div data-i18n="Users List">Users</div>
                                  </a>
                              </li>

                              <li class="menu-item {{ request()->routeIs('admin.settings.index') ? 'active' : '' }}">
                                  <a href="{{ route('admin.settings.index') }}" class="menu-link">
                                      <div data-i18n="Settings">Settings</div>
                                  </a>
                              </li>
                          </ul>
                      </li>


                  </ul>
              </aside>
              <!-- / Menu -->
