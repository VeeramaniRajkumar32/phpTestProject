<div class="sidebar-wrapper sidebar-theme">
            
    <nav id="sidebar">
        <div class="profile-info">
            <figure class="user-cover-image"></figure>
            <div class="user-info">
                <img src="assets/img/gts1.png" alt="avatar">
                <h6 class="">Admin</h6>
            </div>
        </div>

        <div class="shadow-bottom"></div>
        <!-- <?php
            if($control_id == 0){
        ?> -->
                <ul class="list-unstyled menu-categories" id="accordionExample">
                    <li class="menu <?php echo $dashboard ?>">
                        <?php
                            if($dashboardBoolean != 'true'){
                                $dashboardBoolean = 'false';
                            }
                        ?>
                        <a href="dashboard.php"  aria-expanded="<?php echo $dashboardBoolean ; ?>" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                                <span>Dashboard</span>
                            </div>
                        </a>
                    </li>       
                    <li class="menu <?php echo $controls ?>">
                        <?php 
                            if($controlBoolean != 'true'){
                                $controlBoolean = 'false';
                            }
                        ?>
                        <a href="#control" data-toggle="collapse" aria-expanded="<?php echo $controlBoolean ?>" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-box"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>
                                <span>Employee</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled <?php echo $menuShow ?> " id="control" data-parent="#accordionExample">
                            <li class="<?php echo $employee ?>">
                                    <a href="employee.php"> All Employees </a>
                            </li>

                            <li class="<?php echo $department ?>">
                                <a href="department.php"> Department </a>
                            </li>
                            <li class="<?php echo $branch ?>">
                                <a href="branch.php"> Branch </a>
                            </li>
                            <li class="<?php echo $position ?>">
                                <a href="position.php"> Position </a>
                            </li>
                            <li class="<?php echo $holidays ?>">
                                    <a href="holidays.php"> Holidays </a>
                            </li>
                        </ul>
                    </li>
                    <li class="menu <?php echo $app ?>">
                        <?php
                            if($appBoolean != 'true'){
                                $appBoolean = 'false';
                            }
                        ?>
                        <a href="app_control.php"  aria-expanded="<?php echo $appBoolean ; ?>" class="dropdown-toggle">
                            <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
                                <span>App Controls</span>
                            </div>
                        </a>
                    </li>
                    
                </ul>
        <!-- <?php
            } else if($control_id == 1){
        ?>
                <ul class="list-unstyled menu-categories" id="accordionExample">
                    <li class="menu <?php echo $dashboard ?>">
                        <?php
                            if($dashboardBoolean != 'true'){
                                $dashboardBoolean = 'false';
                            }
                        ?>
                        <a href="dashboard.php"  aria-expanded="<?php echo $dashboardBoolean ; ?>" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                                <span>Dashboard</span>
                            </div>
                        </a>
                    </li>   
                    <li class="menu <?php echo $controls ?>">
                        <?php 
                            if($controlBoolean != 'true'){
                                $controlBoolean = 'false';
                            }
                        ?>
                        <a href="#control" data-toggle="collapse" aria-expanded="<?php echo $controlBoolean ?>" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-box"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>
                                <span>Controls</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled <?php echo $menuShow ?> " id="control" data-parent="#accordionExample">
                            <li class="<?php echo $club ?>">
                                <a href="view-all-rotary_club.php"> Rotary Club </a>
                            </li>
                            <li class="<?php echo $member ?>">
                                <a href="view-all-member.php">  Member  </a>
                            </li>
                        </ul>
                    </li>
                </ul>
        <?php
            } else{
        ?>
                <ul class="list-unstyled menu-categories" id="accordionExample"> 
                    <li class="menu <?php echo $dashboard ?>">
                        <?php
                            if($dashboardBoolean != 'true'){
                                $dashboardBoolean = 'false';
                            }
                        ?>
                        <a href="dashboard.php"  aria-expanded="<?php echo $dashboardBoolean ; ?>" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                                <span>Dashboard</span>
                            </div>
                        </a>
                    </li>   
                    <li class="menu <?php echo $controls ?>">
                        <?php 
                            if($controlBoolean != 'true'){
                                $controlBoolean = 'false';
                            }
                        ?>
                        <a href="#control" data-toggle="collapse" aria-expanded="<?php echo $controlBoolean ?>" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-box"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>
                                <span>Controls</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled <?php echo $menuShow ?> " id="control" data-parent="#accordionExample">
                            <li class="<?php echo $club ?>">
                                <a href="view-all-rotary_club.php"> Rotary Club </a>
                            </li>
                            
                        </ul>
                    </li>
                </ul>
        <?php
            }
        ?> -->
    </nav>
</div>