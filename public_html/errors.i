
Fatal error:
Uncaught MediaWiki\OAuthClient\Exception: Server returned error: An error occurred in the OAuth protocol: Invalid consumer in
/data/project/ncc2commons/public_html/ncc_to_c/vendor/mediawiki/oauthclient/src/Client.php:149

Stack trace:
#0 /data/project/ncc2commons/public_html/ncc_to_c/auth/login.php(55): MediaWiki\OAuthClient\Client->initiate()
#1 /data/project/ncc2commons/public_html/ncc_to_c/auth.php(32): require_once('/data/project/n...')
#2 {main} thrown in /data/project/ncc2commons/public_html/ncc_to_c/vendor/mediawiki/oauthclient/src/Client.php on line 149

