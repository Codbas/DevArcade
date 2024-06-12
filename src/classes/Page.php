<?php
// Each page under /public has a Page class. Generates HTML content
// for the header and footer. Logic for adding page views and site hits.
class Page {
    private string $title;
    private int $pageId;
    private PDO $dbConn;

    function __construct(string $title, $dbConn) {
        $this->title = $title;
        $this->dbConn = $dbConn;
        $this->setPageId();
    }

    private function setPageId() : void {
        $sql = 'select distinct id from Pages where name = :title';
        $stmt = $this->dbConn->prepare($sql);
        $stmt->bindParam('title', $this->title);
        $stmt->execute();

        if ($stmt->rowCount() != 1) {
            $this->pageId = -1;
            error_log("ERROR: pageId could not be set on page $this->title");
            return;
        }

        $row = $stmt->fetch();
        if (!$row) {
            $this->pageId = -1;
            return;
        }

        $this->pageId = $row['id'];
    }

    public function getPageViews() : int {
        $sql = 'select count(*) as views
        from PageViews 
        where pageId = :pageId';
        $stmt = $this->dbConn->prepare($sql);
        $stmt->bindParam('pageId', $this->pageId);
        $stmt->execute();

        if ($stmt->rowCount() != 1) {
            return 0;
        }

        $row = $stmt->fetch();
        if (!$row) {
            return 0;
        }

        $views = $row['views'];
        if ($views== null) {
            return 0;
        }

        return $views;
    }

    public function getUniqueVisitors() : int {
        $sql = 'select count(distinct ip) as count
                from SiteHits';
        $stmt = $this->dbConn->prepare($sql);
        $stmt->execute();

        if ($stmt->rowCount() != 1) {
            return 0;
        }

        $row = $stmt->fetch();
        if (!$row) {
            return 0;
        }

        $visitors = $row['count'];
        if ($visitors == null) {
            return 0;
        }

        return $visitors;
    }
    public function getSiteHits() : int {
        $sql = 'select count(*) as hits
        from SiteHits';
        $stmt = $this->dbConn->prepare($sql);
        $stmt->execute();

        if ($stmt->rowCount() != 1) {
            return 0;
        }

        $row = $stmt->fetch();
        if (!$row) {
            return 0;
        }

        $hits = $row['hits'];
        if ($hits == null) {
            return 0;
        }

        return $hits;
    }

    public function addPageView(string $ip): bool {
        if ($this->pageId == -1) {
            error_log("ERROR in Page.php: Invalid pageId (-1). Unable to increase page views");
            return false;
        }
        $sql = 'insert into PageViews (timestamp, ip, pageId)
                values(now(), :ip, :pageId)';
        $stmt = $this->dbConn->prepare($sql);
        $stmt->bindParam('ip', $ip);
        $stmt->bindParam('pageId', $this->pageId);

        if ($stmt->execute()) {
            return true;
        }

        error_log("ERROR in Page.php: error increasing page view of page id: $this->pageId");
        return true;
    }

    public function addSiteHit($ip): bool {
        $sql = 'insert into SiteHits(timestamp, ip)
                values(now(), :ip)';
        $stmt = $this->dbConn->prepare($sql);
        $stmt->bindParam('ip', $ip);

        if ($stmt->execute()) {
            return true;
        }
        error_log("ERROR in Page.php: could not add site hit. ip: $ip");
        return false;
    }

    public function secondsSinceLastPageView(string $ip): int {
        if ($this->pageId == -1) {
            error_log("ERROR in Page.php: Invalid pageId (-1). Unable to check seconds since last page view.");
            return 0;
        }

        $sql = 'select timestamp
                from PageViews
                where pageId = :pageId and ip = :ip
                order by timestamp desc
                limit 1';
        $stmt = $this->dbConn->prepare($sql);
        $stmt->bindParam('pageId', $this->pageId);
        $stmt->bindParam('ip', $ip);
        $stmt->execute();

        if ($stmt->rowCount() != 1) {
            return 999999999;
        }

        $row = $stmt->fetch();

        if (!$row) {
            return 999999999;
        }

        try {
            $lastView = new DateTime($row['timestamp']);
        } catch (Exception $e) {
            error_log("$e: Error getting lastView timestamp in page.php");
            return 999999999;
        }

        $now = (new DateTime('now'));
        return abs($now->getTimestamp() - $lastView->getTimestamp());
    }

    public function secondsSinceLastSiteActivity(string $ip): int {
        $sql = 'select timestamp
                from PageViews
                where ip = :ip
                order by timestamp desc
                limit 1';
        $stmt = $this->dbConn->prepare($sql);
        $stmt->bindParam('ip', $ip);
        $stmt->execute();

        if ($stmt->rowCount() != 1) {
            return 999999999;
        }

        $row = $stmt->fetch();

        if (!$row) {

            return 999999999;
        }

        try {
            $lastView = new DateTime($row['timestamp']);
        } catch (Exception $e) {
            error_log("$e: Error getting last activity timestamp in page.php");
            return 999999999;
        }

        $now = (new DateTime('now'));
        return abs($now->getTimestamp() - $lastView->getTimestamp());
    }

    public function secondsSinceLastActiveSession(string $sessionId, string $username): int {
        $sql = 'select lastActive 
                from Sessions join Users on Sessions.username = Users.username 
                where Users.username = :username and Sessions.sessionId = :sessionId
                order by Sessions.lastActive desc limit 1';
        $stmt = $this->dbConn->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':sessionId', $sessionId);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            try {
                $lastActive = new DateTime($result['lastActive']);
            } catch (Exception $e) {
                echo "ERROR:1100 - If this issue persists, contact website administrator.";
                $lastActive = (new DateTime())->setTimestamp(0);
                error_log('error assigning date to $lastActive in Page.php');
            }
        } else {
            echo "<script>console.log('no session found for $username')</script>";
            $lastActive = (new DateTime())->setTimestamp(0);
        }

        $now = (new DateTime('now'));
        return abs($now->getTimestamp() - $lastActive->getTimestamp());
    }

    public function logout(string $sessionId): bool {
        $sql = 'delete from Sessions
                where sessionId = :sessionId
        ';
        $stmt = $this->dbConn->prepare($sql);
        $stmt->bindParam(':sessionId', $sessionId);
        $stmt->execute();

        session_unset();
        session_destroy();

        if ($stmt->rowCount() > 0) {
            return true;
        }

        return false;
    }

    public function updateLastActiveSession(string $sessionId): bool {
        $sql = 'update Sessions
         set lastActive = now()
         where sessionId = :sessionId';
        $stmt = $this->dbConn->prepare($sql);
        $stmt->bindParam(':sessionId', $sessionId);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return true;
        }

        return false;
    }
}
