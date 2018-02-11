<?php
    /*
    Copyright (c) 2018, Maikel Enrique Pernia Matos
    Contact: perniamatos@infomed.sld.cu

    All rights reserved.

    This file is part of the Y News website.

    BSD License
    You may use this file under the terms of the BSD license as follows:

    Redistribution and use in source and binary forms, with or without
    modification, are permitted provided that the following conditions
    are met:
    1. Redistributions of source code must retain the above copyright
        notice, this list of conditions and the following disclaimer.
    2. Redistributions in binary form must reproduce the above copyright
        notice, this list of conditions and the following disclaimer in the
        documentation and/or other materials provided with the distribution.
    3. Neither the name of copyright holders nor the names of its
        contributors may be used to endorse or promote products derived
        from this software without specific prior written permission.

    THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
    "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED
    TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR
    PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL COPYRIGHT HOLDERS OR CONTRIBUTORS
    BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
    CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF
    SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
    INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN
    CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
    ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
    POSSIBILITY OF SUCH DAMAGE.
    */
    
    if (isset($_POST['inqvoting'])) { $inqvoting = (int)$_POST['inqvoting']; }
    
    if (isset($_POST['inqscore'])) { $inqscore = (int)$_POST['inqscore']; }
    
    if (isset($_POST['idnews'])) { $idnews = (int)$_POST['idnews']; }

    if (isset($_POST['inslike'])) { $inslike = (int)$_POST['inslike']; }
    
    if (isset($_POST['insshare'])) { $insshare = (int)$_POST['insshare']; }

    include("database.php");

    function show_news_page($uuid)
    {
        $id_channel = get_id("channels", "id_channel", $uuid);
        
        if ($id_channel > 0)
        {
            $sql_news = "SELECT news.title, news.description, news.pubdate, news.link,
                         shares.idshares, likes.id_likes FROM news 
                         INNER JOIN feeds ON feeds.id_feeds = news.feeds_id_feeds
                         LEFT OUTER JOIN shares ON  news.id_news = shares.id_news
                         LEFT OUTER JOIN likes on news.id_news = likes.id_news
                         WHERE feeds.id_channel = $id_channel ORDER BY pubdate DESC LIMIT 100;";

            $sql_carousel = "SELECT * FROM news INNER JOIN feeds ON feeds.id_feeds = news.feeds_id_feeds
                             WHERE feeds.id_channel = $id_channel ORDER BY pubdate DESC LIMIT 5 ;";
        }else{
            $sql_news = "SELECT * FROM news ORDER BY pubdate DESC LIMIT 100;";
            $sql_carousel = "SELECT * FROM news ORDER BY pubdate DESC LIMIT 5 ;";
        }

        include_once("header.php");        
        include_once("page.php");
        include_once("news.php");
        include_once("footer.php");
    }

    function show_select_news_page($uuid, $parent){
        $id_categorie = get_id("categories", "id_categories", $uuid);
        $id_channel = get_id("channels", "id_channel", $parent);

        if ($id_channel > 0)
        {
            $sql_carousel = "SELECT * FROM news INNER JOIN feeds ON feeds.id_feeds = news.feeds_id_feeds
                             WHERE feeds.categories_id_categories = $id_categorie AND feeds.id_channel = $id_channel 
                             ORDER BY pubdate DESC LIMIT 5";
            
            $sql_news = "SELECT * FROM news INNER JOIN feeds ON feeds.id_feeds = news.feeds_id_feeds
                         WHERE feeds.categories_id_categories = $id_categorie AND feeds.id_channel = $id_channel 
                         ORDER BY pubdate DESC;";
        }else{
            $sql_carousel = "SELECT * FROM news INNER JOIN feeds ON feeds.id_feeds = news.feeds_id_feeds
                             WHERE feeds.categories_id_categories = $id_categorie ORDER BY pubdate DESC LIMIT 5";
            
            $sql_news = "SELECT * FROM news INNER JOIN feeds ON feeds.id_feeds = news.feeds_id_feeds
                         WHERE feeds.categories_id_categories = $id_categorie ORDER BY pubdate DESC;";                         
        }

        include_once("header.php");        
        include_once("page.php");
        include_once("news.php");
        include_once("footer.php");
    }

    function show_contact_page(){

        include_once("header.php");
        include_once("page.php");
        include_once("contact.php");
        include_once("footer.php");
    }
    
    function show_static_page($uuid)
    {   
        $result = exec_query("SELECT * FROM static_pages WHERE uuid = '$uuid';");
        $row = mysqli_fetch_array($result);
        $title = $row["title"];
        $content = $row["content"];
        mysqli_free_result($result);        

        include_once("header.php");
        include_once("page.php");

        echo "<div class=\"row\"><h1>$title</h1>$content</div>"; 

        include_once("footer.php");
    }

    function show_search_page($text)
    {
        include_once("header.php");
        include_once("page.php");

        $result = exec_query("SELECT * FROM news WHERE description LIKE '%$text%' OR description LIKE '%$text%';");
        $count = mysqli_num_rows($result);

        for ($i=0; $i < $count; $i++) 
        {
            @mysqli_data_seek($result, $i);
            $row = mysqli_fetch_array($result);
        ?>
        
        <div class="col-md-12">
            <h3><a href="<?php echo $row["link"] ?>"><?php echo $row["title"] ?></a></h3> 
            <div class="row">
                <div class="col-md-4 news-date"><?php echo $row["pubdate"] ?></div>
                <div class="col-md-5">
                    <label>Reviews:<span class="badge"><?php echo get_review($row["id_news"]); ?></span></label>&nbsp;&nbsp;&nbsp;
                    <label>Rating:<span class="badge"><?php echo get_score($row["id_news"]); ?></span></label>
                </div>
                <div class="btn-toolbar" role="toolbar"> 
                    <div class="btn-group" role="group"> 
                        <div id="inq<?php echo $row["id_news"]; ?>">
                            <a href="javascript:vote(1, <?php echo $row["id_news"]; ?>)"><span class="glyphicon glyphicon-star-empty text-warning"></span></a>
                            <a href="javascript:vote(2, <?php echo $row["id_news"]; ?>)"><span class="glyphicon glyphicon-star-empty text-warning"></span></a>
                            <a href="javascript:vote(3, <?php echo $row["id_news"]; ?>)"><span class="glyphicon glyphicon-star-empty text-warning"></span></a>
                            <a href="javascript:vote(4, <?php echo $row["id_news"]; ?>)"><span class="glyphicon glyphicon-star-empty text-warning"></span></a>
                            <a href="javascript:vote(5, <?php echo $row["id_news"]; ?>)"><span class="glyphicon glyphicon-star-empty text-warning"></span></a>
                        </div>
                    </div>                                     
                </div>
            </div>
            <p><?php echo $row["description"] ?></p>
            <div class="fluid-row" style="margint-top: 20px; float: right;">
                <div class="col-md-4">
                    <a href="javascript:likes(<?php echo $row["id_news"]; ?>)" class="btn btn-primary" type="button"> Like 
                        <span class="glyphicon glyphicon-thumbs-up" aria-hidden="true">&nbsp;</span>
                        <span id="lik<?php echo $row["id_news"]; ?>">
                            <?php 
                                $likeid = count_rows("likes", "idlikes", "news_id_news = " . $row["id_news"]);
                            ?>
                            <span class="badge"><?php echo $likeid; ?></span>
                        </span>
                    </a>                     
                </div>&nbsp;
            <div class="col-md-4 col-md-offset-1">
                <a href="javascript:share(<?php echo $row["id_news"]; ?>)" class="btn btn-primary" type="button"> Share 
                    <span class="glyphicon glyphicon-share" aria-hidden="true">&nbsp;</span>
                    <span id="sha<?php echo $row["id_news"]; ?>">
                        <?php
                            $shaid = count_rows("shares", "idshares", "news_id_news = " . $row["id_news"]);
                        ?>
                        <span class="badge"><?php echo $shaid; ?></span>
                    </span>
                </a>                     
            </div>
        </div>            
        </div>

        <?php
        }
        ?>
        
        
        <?php
        mysqli_free_result($result);
        include_once("footer.php");
    }

    if ($inqvoting ==  1)  inquest_news($inqscore, $idnews);

    $username = "guest";

    if ($inslike == 1) like_news($idnews, $username);
    
    if ($insshare == 1) shared_news($idnews, $username);
?>