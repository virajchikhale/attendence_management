<aside class="menu-sidebar2">
<div class="logo">
    <a href="#">
        <img src="images/icon/logo-white.png" alt="Cool Admin" />
    </a>
</div>
<div class="menu-sidebar2__content js-scrollbar1">
    <div class="account2">
        <div class="image img-cir img-120">
            <img src="images/icon/avatar-big-01.jpg" alt="John Doe" />
        </div>
        <h4 class="name"><?php echo  ucfirst($ur['first_name'])."  ".ucfirst($ur['last_name']);?></h4>
        <a href="#"  data-toggle="modal" data-target="#logoutModal"><i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>Sign out</a>
    </div>
    <nav class="navbar-sidebar2">
        <ul class="list-unstyled navbar__list">
            <li class="active has-sub">
                <a class="js-arrow" href="index.php">
                    <i class="fas fa-plus"></i>Add Classroom
                </a>
            </li>
            <li class="active has-sub">
                <a class="js-arrow" href="subject_add.php">
                    <i class="fas fa-plus"></i>Add Subject
                </a>
            </li>
        </ul>
    </nav>
</div>
</aside>
<script src="https://kit.fontawesome.com/d543b2820b.js" crossorigin="anonymous"></script>


    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="../" >Logout</a>
                </div>
            </div>
        </div>
    </div>