<?php
/* @var string $scriptName
 * @var string $title
 * @var PDO $dbConn
 * @var Page $page
 */

if ($scriptName == 'DevLog' || $scriptName == 'Game') {
    echo '</body></html>';
    exit();
}

$views = number_format($page->getPageViews());

if ($scriptName == 'Home') {
    $hits = number_format($page->getSiteHits());
    $visitors = number_format($page->getUniqueVisitors());
    $hitsAndVisitorsText = "| Site Hits: $hits | Unique Visitors: $visitors";
}
else {
    $hitsAndVisitorsText = '';
}

echo "
          </div>
          <div id='footer-wrapper'>
              <div id ='footer'>Page Views: $views $hitsAndVisitorsText</div>
          </div>
      </div>
   </body>
</html>";
