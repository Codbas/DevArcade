<?php
// Each page under /public has a Page class. Generates HTML content
// for the header and footer. Logic for adding page views and site hits.
class Page {
    private string $title;
    private PDO $dbConn;

    private bool $loggedIn = false;

    function __construct(string $title, $dbConn) {
        $this->title = $title;
        $this->dbConn = $dbConn;
    }
    public function getNavbarHTMLString() : string {
        $title = $this->title;
        return strval(include('../includes/navbar.php'));
    }
    public function getHeaderHTMLString() : string {
        return include('../includes/header.php');
    }
    public function getFooterHTMLString() : string {
        return strval(include('../includes/footer.php'));
    }
    public function incPageViews(string $ip) : bool {
        // TODO: if page does not exist, create new in database?
        
        // TODO: use $dbConn add view (ip, datetime, pageName)
        return true;
    }
    public function incSiteHit() : bool {
        // TODO: use $dbConn to add a hit to the site (ip, datetime)
        return true;
    }
    public function secondsSinceLastPageView(string $ip) : int {
        // TODO: check database for the last page view time. calculate seconds since and return

        // TODO: if no view found, return -1
        return -1;
    }
    public function secondsSinceLastSiteHit(string $ip) : int {
        // TODO: check database for most recent page view for this ip and calculate and return seconds since

        // TODO: if no view found, return -1
        return -1;
    }
    public function secondsSinceLastActiveSession(string $sessionId, string $username) : int {
        // DB test code
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
                echo "ERROR:1100 - contact website administrator.";
                $lastActive = (new DateTime())->setTimestamp(0);
                error_log('error assigning date to $lastActive in Page.php');
            }
        }
        else {
            echo "no session found for $username";
            $lastActive = (new DateTime())->setTimestamp(0);
        }

        $now = (new DateTime('now'));;
        $interval = abs($now->getTimestamp() - $lastActive->getTimestamp());

        return $interval;
    }

    public function logout(string $sessionId) : bool {
        $sql = 'delete from Sessions
                where sessionId = :sessionId
        ';
        $stmt = $this->dbConn->prepare($sql);
        $stmt->bindParam(':sessionId', $sessionId);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            session_unset();
            session_destroy();
            return true;
        }

        return false;
    }
}