<?php
/**
 * Created by PhpStorm.
 * User: dl07epif
 * Date: 12/11/2014
 * Time: 14:58
 */?>

<h1 class="page-header">Browse penpals</h1>


    <p>Thousands of people are looking forward to exchanging letters with you.</p>

    <div class="row">
        <?php include "randompals.php" ?>



            <nav class="col-xs-12 minuspadding">
                <ul class="pager">
                    <li class="previous disabled"><a href="#">&larr; Newer</a></li>
                    <li class="next"><a href="#">Older &rarr;</a></li>
                </ul>
            </nav>



    </div>


    <!--start countries /-->


    <h1 class="">Find friends by country</h1>
    <div class="panel panel-default">
        <div class="panel-body">
    <p>We have
        <b><?php include "countrycount.php" ?></b> countries in our database. Here are our top countries:</p>

    <div class="row">

        <?php include "topcountries.php" ?>



    </div>
</div>

