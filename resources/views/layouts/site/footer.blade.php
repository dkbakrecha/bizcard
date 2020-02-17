<div id="footer-bottom">
    <div class="container">
        <footer >
            <div class="row">
                <div class="col-lg-8">

                    <div class="links">
                        <a href="{{ route('about-us') }}" class="link">About</a>
                        <a href="" class="link">FAQ'S</a>
                        <a href="" class="link">Contact Us</a>
                        <a href="" class="link">Privacy &amp; Terms</a>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="social pull-right">
                        <a target="_blank" href="https://www.facebook.com/pages/Room247/1456229788028092" class="link">
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="copyright">
                        Copyright &copy; <?php echo date("Y"); ?>. <a href="http://classyarea.in/" target="_blank">ClassyAREA.in</a>
                    </div>
                </div>
            </div>
        </footer>


    </div>
</div>

<?php
if ($_SERVER['SERVER_NAME'] == 'localhost') {
    //echo $this->element('sql_dump');
}
?>