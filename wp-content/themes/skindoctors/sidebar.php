<div class="sidebar">
    <? include('menu_side.php'); ?>

    <div class="well top10">
        <div class="input-group"> 
            <span class="input-group-addon">
                <i class="fa fa-search"></i>
            </span> 
            <form method="get" action="<? echo get_site_url(); ?>">
                <?
                    if(get_search_query() != null && get_search_query() != "") {
                        $s = get_search_query();
                    } else {
                        $s = "-";
                    }
                ?>
                <input class="form-control" id="s" name="s" placeholder="Wyszukaj" value="<? echo get_search_query(); ?>" aria-describedby="inputGroupSuccess2Status">
            </form>
        </div>

        <hr>
       
        <script>
            jQuery(function(){
                loadTabsContent("<?php echo get_page_link(143); ?>","<?php echo get_page_link(147); ?>");
            });
        </script>

        <hr style="margin-bottom: 0px">

        <h4>ZAPISZ SIĘ NA NEWSLETTER</h4>

        <script type="text/javascript">
        //<![CDATA[
        if (typeof newsletter_check !== "function") {
        window.newsletter_check = function (f) {
            var re = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-]{1,})+\.)+([a-zA-Z0-9]{2,})+$/;
            if (!re.test(f.elements["ne"].value)) {
                alert("E-mail jest niepoprawny");
                return false;
            }
            for (var i=1; i<20; i++) {
            if (f.elements["np" + i] && f.elements["np" + i].required && f.elements["np" + i].value == "") {
                alert("");
                return false;
            }
            }
            if (f.elements["ny"] && !f.elements["ny"].checked) {
                alert("Musisz zaakceptować politykę prywatności");
                return false;
            }
            return true;
        }
        }
        //]]>
        </script>

        <form action="http://serwer1625248.home.pl/preibisz_wp/?na=s" onsubmit="return newsletter_check(this)" method="post" class="inline-form">
            <div class="input-group">
                <input type="hidden" name="nr" value="widget">
                <input class="newsletter-email form-control" placeholder="adres email" type="email" required="" name="ne" value="Email" onclick="if (this.defaultValue==this.value) this.value=''" onblur="if (this.value=='') this.value=this.defaultValue">
                <span class = "input-group-btn">
                    <button class = "btn btn-default btn-skindoctor-dark" type = "button">
                        subskrybuj
                    </button>
                </span>
            </div>
        </form>
    </div>

    <div class="contact top10">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2443.815850030178!2d21.07341351612911!3d52.22856337975998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x471ecda1ce2cdf61%3A0xe211e3c4546d8f7a!2sPREIBISZ+SkinDoctors!5e0!3m2!1spl!2spl!4v1475161057228" width="100%" height="250" frameborder="0" style="border:0" allowfullscreen></iframe>

        <div style="padding-left: 30px">
            <p class="h3-like">PREIBISZ SKINDOCTORS</p>
            <p><a href="#">email:recepcja@preibisz.com</a></p>
            <p>Nowaka-Jeziorańskiego 51 lok.<br>
            u9 03-982 Warszawa (Gocław/Saska Kępa)</p>
            <p class="h3-like">(22) 126 80 00</p>
            <p class="h3-like">+48 505 314 747</p>
            <p class="h4-like" style="padding: 0px; margin: 0px">GODZINY PRACY</p>
            PON-PT 9:00 - 21:00<br>
            SOB 9:00-15:00
        </div>
    </div>


    <hr>
</div>