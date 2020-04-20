<div class="list-group">
    <a href="{{ route('home') }}" class="list-group-item active">
        <span class="glyphicon glyphicon-home"></span> 
        Dashboard
    </a>


    <a href="" class="list-group-item hide">
        <span class="glyphicon glyphicon-comment"></span> 
        Enquiries <span class="badge">0</span>
    </a>

    <a href="/" class="list-group-item">
        <span class="fa fa-heart"></span> 
        Favorites <span class="badge">
            <?php
            echo (!empty($favCount) ? $favCount : '0');
            ?>
        </span>
    </a>

    <a href="/" class="list-group-item">
        <span class="fa fa-address-card"></span> 
        Address Book <span class="badge">
            <?php
            echo (!empty($favCount) ? $favCount : '0');
            ?>
        </span>
    </a>

    <a href="{{ route('feedbacks') }}"  class="list-group-item hide">
        <i class="glyphicon glyphicon-comment"></i>
        Chat Support
    </a>
     

    <a href="/" class="list-group-item hide">
        <span class="glyphicon glyphicon-user"></span>
        My Profile 
    </a>

    <a href="/" class="list-group-item hide">
        <span class="glyphicon glyphicon-off"></span>
        Logout
    </a>
</div>