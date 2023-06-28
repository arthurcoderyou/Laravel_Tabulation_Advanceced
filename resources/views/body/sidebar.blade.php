<aside class="left-sidebar" data-sidebarbg="skin6">
  <!-- Sidebar scroll-->
  <div class="scroll-sidebar">
      <!-- Sidebar navigation-->
      <nav class="sidebar-nav">
          <ul id="sidebarnav">
              <!-- User Profile-->
              @guest
                <li class="sidebar-item pt-2">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('user.dashboard') }}"
                        aria-expanded="false">
                        <i class="far fa-clock" aria-hidden="true"></i>
                        <span class="hide-menu">Contest Results</span>
                    </a>
                </li>
                
              @endguest

              @auth
                

                @if(auth()->user()->role == 'admin')
                {{-- for admin --}}
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/admin/contest"
                            aria-expanded="false">
                            <i class="fa fa-certificate" aria-hidden="true"></i>
                            <span class="hide-menu">Contest</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/admin/subcontest"
                            aria-expanded="false">
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <span class="hide-menu">Sub Contest</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/admin/contestants"
                            aria-expanded="false">
                            <i class="fa fa-user" aria-hidden="true"></i>
                            <span class="hide-menu">Contestants</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/admin/judges"
                            aria-expanded="false">
                            <i class="fa fa-table" aria-hidden="true"></i>
                            <span class="hide-menu">Judges</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/admin/criterias"
                            aria-expanded="false">
                            <i class="fa fa-info" aria-hidden="true"></i>
                            <span class="hide-menu">Criteria</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/admin/judgements"
                            aria-expanded="false">
                            <i class="fa fa-question" aria-hidden="true"></i>
                            <span class="hide-menu">Judgement</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/admin/awards"
                            aria-expanded="false">
                            <i class="fa fa-gift" aria-hidden="true"></i>
                            <span class="hide-menu">Awards</span>
                        </a>
                    </li>
                {{-- end of for admin --}}
                @elseif(auth()->user()->role == 'user' || auth()->user()->role == 'contestant') 
                {{-- for user --}}
                    <li class="sidebar-item pt-2">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('user.dashboard') }}"
                            aria-expanded="false">
                            <i class="far fa-award" aria-hidden="true"></i>
                            <span class="hide-menu">Contest Results</span>
                        </a>
                    </li>
                    
                {{-- end of for user --}}
                @elseif(auth()->user()->role == 'judge') 
                {{-- for judge --}}
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/admin/awards"
                            aria-expanded="false">
                            <i class="fa fa-gift" aria-hidden="true"></i>
                            <span class="hide-menu">Awards</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/judge/judgements/{{ auth()->user()->id }}"
                            aria-expanded="false">
                            <i class="fa fa-question" aria-hidden="true"></i>
                            <span class="hide-menu">Judgement</span>
                        </a>
                    </li>
                {{-- end of for judge --}}
                
                @endif
              @endauth
              
              
          </ul>

      </nav>
      <!-- End Sidebar navigation -->
  </div>
  <!-- End Sidebar scroll-->
</aside>