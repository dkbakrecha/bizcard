<div class="list-group">
    <a href="/home" class="list-group-item active">
        <span class="glyphicon glyphicon-home"></span> 
        Dashboard
    </a>


    <a href="" class="list-group-item hide">
        <span class="glyphicon glyphicon-comment"></span> 
        Enquiries <span class="badge">0</span>
    </a>

    <a href="/" class="list-group-item hide">
        <span class="fa fa-heart"></span> 
        ShortLists <span class="badge">
            <?php
            echo (!empty($favCount) ? $favCount : '0');
            ?>
        </span>
    </a>

    <a href="{{ route('feedbacks') }}"  class="list-group-item">
        <i class="glyphicon glyphicon-comment"></i>
        Chat Support
    </a>
     

    <a href="/" class="list-group-item hide">
        <span class="glyphicon glyphicon-user"></span>
        My Profile 
    </a>

    <a href="/" class="list-group-item">
        <span class="glyphicon glyphicon-off"></span>
        Logout
    </a>
</div>