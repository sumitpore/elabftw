<?php
/**
 * register.php
 *
 * @author Nicolas CARPi <nicolas.carpi@curie.fr>
 * @copyright 2012 Nicolas CARPi
 * @see https://www.elabftw.net Official website
 * @license AGPL-3.0
 * @package elabftw
 */
namespace Elabftw\Elabftw;

use Exception;

/**
 * Create an account
 *
 */
try {
    require_once 'app/init.inc.php';
    $pageTitle = _('Register');
    $selectedMenu = null;
    require_once 'app/head.inc.php';
    // DEMO BLOCK
    $message ="Thank you for trying eLabFTW. This is a demo. This is not a webservice: you need <a style='color:blue;' href='https://elabftw.readthedocs.io/en/latest/'>to install it</a> on a server or your computer.";
    echo Tools::displayMessage($message, 'ok', false);
    require_once 'app/footer.inc.php';
    die();
    // END DEMO BLOCK

    // Check if we're logged in
    if (isset($_SESSION['auth']) && $_SESSION['auth'] == 1) {
        throw new Exception(sprintf(
            _('Please %slogout%s before you register another account.'),
            "<a style='alert-link' href='app/logout.php'>",
            "</a>"
        ));
    }

    $Teams = new Teams();
    $teamsArr = $Teams->readAll();
    echo $twig->render('register.html', array(
        'teamsArr' => $teamsArr
    ));

} catch (Exception $e) {
    echo Tools::displayMessage($e->getMessage(), 'ko', false);
} finally {
    require_once 'app/footer.inc.php';
}
