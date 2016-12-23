<?php

##########################################################################
##########################################################################
##########################################################################
/*

Author: Peter Vogelmann
Title: attribution.php

Files in the modules folder are used for handling the visible content

*/
##########################################################################
##########################################################################
##########################################################################
/*

   1 Attribution

*/
##########################################################################
##########################################################################
##########################################################################

if(isset($_GET['page']) and $_GET['page']=='attribution') {
    echo '<div class="basicPage">';
    echo "   <p class='paragraphTitle'><b>Attribution</b></p>";
    echo "   <p><a href='http://www.freepik.com/free-vector/silhouette-flying-birds_720337.htm'>Birddesign by Freepik</a></p>";
    echo '   <p class="buttonMargin"><a href="index.php" class="button" id="small">'.$lang['buttons']['back'].'</a></p><br />';
    echo '</div>';
}

?>
