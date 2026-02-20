 <nav class="navbar navbar-expand-lg">
     <div class="offcanvas offcanvas-end" tabindex="-1" id="ppcanvasNavbar" aria-labelledby="ppcanvasNavbarLabel">
         <div class="offcanvas-header">
             <h5 class="offcanvas-title" id="ppcanvasNavbarLabel">Profile</h5>
             <button type="button" class="close-btn btn-color" data-bs-dismiss="offcanvas" aria-label="Close">
                 <i class="feather-x"></i>
             </button>
         </div>
         <div class="offcanvas-body">
             <ul class="navbar-nav justify-content-start flex-grow-1 pe_5">
                 <?php $currentPage = uri_string(); // gets the current URI segment 
                    ?>

                 <li class="nav-item">
                     <a class="nav-link <?= ($currentPage == '' ? 'active" aria-current="page' : '') ?>" href="<?= base_url(''); ?>">
                         <span class="nav-icon">
                             <i class="feather-align-right"></i>
                         </span>
                         Timeline
                     </a>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link <?= ($currentPage == 'sitedashboard' ? 'active" aria-current="page' : '') ?>" href="<?= base_url('sitedashboard'); ?>">
                         <span class="nav-icon">
                             <i class="feather-grid"></i>
                         </span>
                         Dashboard
                     </a>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link <?= ($currentPage == 'group' ? 'active" aria-current="page' : '') ?>" href="<?= base_url('group'); ?>">
                         <span class="nav-icon">
                             <i class="feather-users"></i>
                         </span>
                         Groups
                     </a>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link <?= ($currentPage == 'directory' ? 'active" aria-current="page' : '') ?>" href="<?= base_url('directory'); ?>">
                         <span class="nav-icon">
                             <i class="feather-briefcase"></i>
                         </span>
                         Directory
                     </a>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link <?= ($currentPage == 'history' ? 'active" aria-current="page' : '') ?>" href="<?= base_url('history'); ?>">
                         <span class="nav-icon">
                             <i class="feather-image"></i>
                         </span>
                         Certificates
                     </a>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link " href="<?= base_url(''); ?>">
                         <span class="nav-icon">
                             <i class="feather-message-square"></i>
                         </span>
                         Messages
                     </a>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link <?= ($currentPage == 'donate' ? 'active" aria-current="page' : '') ?>" href="<?= base_url('donate'); ?>">
                         <span class="nav-icon">
                             <i class="feather-file-text"></i>
                         </span>
                         Transactions
                     </a>
                 </li>
                  <li class="nav-item">
                     <a class="nav-link <?= ($currentPage == 'donate' ? 'active" aria-current="page' : '') ?>" href="<?= base_url('/userlogout'); ?>">
                         <span class="nav-icon">
                             <i class="feather-file-text"></i>
                         </span>
                        Logout
                     </a>
                 </li>

             </ul>
         </div>
     </div>
  
 </nav>

 