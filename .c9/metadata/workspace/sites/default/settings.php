{"changed":true,"filter":false,"title":"settings.php","tooltip":"/sites/default/settings.php","value":"<?php\n\n/**\n * @file\n * Drupal site-specific configuration file.\n *\n * IMPORTANT NOTE:\n * This file may have been set to read-only by the Drupal installation program.\n * If you make changes to this file, be sure to protect it again after making\n * your modifications. Failure to remove write permissions to this file is a\n * security risk.\n *\n * The configuration file to be loaded is based upon the rules below. However\n * if the multisite aliasing file named sites/sites.php is present, it will be\n * loaded, and the aliases in the array $sites will override the default\n * directory rules below. See sites/example.sites.php for more information about\n * aliases.\n *\n * The configuration directory will be discovered by stripping the website's\n * hostname from left to right and pathname from right to left. The first\n * configuration file found will be used and any others will be ignored. If no\n * other configuration file is found then the default configuration file at\n * 'sites/default' will be used.\n *\n * For example, for a fictitious site installed at\n * http://www.drupal.org:8080/mysite/test/, the 'settings.php' file is searched\n * for in the following directories:\n *\n * - sites/8080.www.drupal.org.mysite.test\n * - sites/www.drupal.org.mysite.test\n * - sites/drupal.org.mysite.test\n * - sites/org.mysite.test\n *\n * - sites/8080.www.drupal.org.mysite\n * - sites/www.drupal.org.mysite\n * - sites/drupal.org.mysite\n * - sites/org.mysite\n *\n * - sites/8080.www.drupal.org\n * - sites/www.drupal.org\n * - sites/drupal.org\n * - sites/org\n *\n * - sites/default\n *\n * Note that if you are installing on a non-standard port number, prefix the\n * hostname with that number. For example,\n * http://www.drupal.org:8080/mysite/test/ could be loaded from\n * sites/8080.www.drupal.org.mysite.test/.\n *\n * @see example.sites.php\n * @see conf_path()\n */\n\n/**\n * Database settings:\n *\n * The $databases array specifies the database connection or\n * connections that Drupal may use.  Drupal is able to connect\n * to multiple databases, including multiple types of databases,\n * during the same request.\n *\n * Each database connection is specified as an array of settings,\n * similar to the following:\n * @code\n * array(\n *   'driver' => 'mysql',\n *   'database' => 'databasename',\n *   'username' => 'username',\n *   'password' => 'password',\n *   'host' => 'localhost',\n *   'port' => 3306,\n *   'prefix' => 'myprefix_',\n *   'collation' => 'utf8_general_ci',\n * );\n * @endcode\n *\n * The \"driver\" property indicates what Drupal database driver the\n * connection should use.  This is usually the same as the name of the\n * database type, such as mysql or sqlite, but not always.  The other\n * properties will vary depending on the driver.  For SQLite, you must\n * specify a database file name in a directory that is writable by the\n * webserver.  For most other drivers, you must specify a\n * username, password, host, and database name.\n *\n * Some database engines support transactions.  In order to enable\n * transaction support for a given database, set the 'transactions' key\n * to TRUE.  To disable it, set it to FALSE.  Note that the default value\n * varies by driver.  For MySQL, the default is FALSE since MyISAM tables\n * do not support transactions.\n *\n * For each database, you may optionally specify multiple \"target\" databases.\n * A target database allows Drupal to try to send certain queries to a\n * different database if it can but fall back to the default connection if not.\n * That is useful for master/slave replication, as Drupal may try to connect\n * to a slave server when appropriate and if one is not available will simply\n * fall back to the single master server.\n *\n * The general format for the $databases array is as follows:\n * @code\n * $databases['default']['default'] = $info_array;\n * $databases['default']['slave'][] = $info_array;\n * $databases['default']['slave'][] = $info_array;\n * $databases['extra']['default'] = $info_array;\n * @endcode\n *\n * In the above example, $info_array is an array of settings described above.\n * The first line sets a \"default\" database that has one master database\n * (the second level default).  The second and third lines create an array\n * of potential slave databases.  Drupal will select one at random for a given\n * request as needed.  The fourth line creates a new database with a name of\n * \"extra\".\n *\n * For a single database configuration, the following is sufficient:\n * @code\n * $databases['default']['default'] = array(\n *   'driver' => 'mysql',\n *   'database' => 'databasename',\n *   'username' => 'username',\n *   'password' => 'password',\n *   'host' => 'localhost',\n *   'prefix' => 'main_',\n *   'collation' => 'utf8_general_ci',\n * );\n * @endcode\n *\n * You can optionally set prefixes for some or all database table names\n * by using the 'prefix' setting. If a prefix is specified, the table\n * name will be prepended with its value. Be sure to use valid database\n * characters only, usually alphanumeric and underscore. If no prefixes\n * are desired, leave it as an empty string ''.\n *\n * To have all database names prefixed, set 'prefix' as a string:\n * @code\n *   'prefix' => 'main_',\n * @endcode\n * To provide prefixes for specific tables, set 'prefix' as an array.\n * The array's keys are the table names and the values are the prefixes.\n * The 'default' element is mandatory and holds the prefix for any tables\n * not specified elsewhere in the array. Example:\n * @code\n *   'prefix' => array(\n *     'default'   => 'main_',\n *     'users'     => 'shared_',\n *     'sessions'  => 'shared_',\n *     'role'      => 'shared_',\n *     'authmap'   => 'shared_',\n *   ),\n * @endcode\n * You can also use a reference to a schema/database as a prefix. This may be\n * useful if your Drupal installation exists in a schema that is not the default\n * or you want to access several databases from the same code base at the same\n * time.\n * Example:\n * @code\n *   'prefix' => array(\n *     'default'   => 'main.',\n *     'users'     => 'shared.',\n *     'sessions'  => 'shared.',\n *     'role'      => 'shared.',\n *     'authmap'   => 'shared.',\n *   );\n * @endcode\n * NOTE: MySQL and SQLite's definition of a schema is a database.\n *\n * Advanced users can add or override initial commands to execute when\n * connecting to the database server, as well as PDO connection settings. For\n * example, to enable MySQL SELECT queries to exceed the max_join_size system\n * variable, and to reduce the database connection timeout to 5 seconds:\n *\n * @code\n * $databases['default']['default'] = array(\n *   'init_commands' => array(\n *     'big_selects' => 'SET SQL_BIG_SELECTS=1',\n *   ),\n *   'pdo' => array(\n *     PDO::ATTR_TIMEOUT => 5,\n *   ),\n * );\n * @endcode\n *\n * WARNING: These defaults are designed for database portability. Changing them\n * may cause unexpected behavior, including potential data loss.\n *\n * @see DatabaseConnection_mysql::__construct\n * @see DatabaseConnection_pgsql::__construct\n * @see DatabaseConnection_sqlite::__construct\n *\n * Database configuration format:\n * @code\n *   $databases['default']['default'] = array(\n *     'driver' => 'mysql',\n *     'database' => 'databasename',\n *     'username' => 'username',\n *     'password' => 'password',\n *     'host' => 'localhost',\n *     'prefix' => '',\n *   );\n *   $databases['default']['default'] = array(\n *     'driver' => 'pgsql',\n *     'database' => 'databasename',\n *     'username' => 'username',\n *     'password' => 'password',\n *     'host' => 'localhost',\n *     'prefix' => '',\n *   );\n *   $databases['default']['default'] = array(\n *     'driver' => 'sqlite',\n *     'database' => '/path/to/databasefilename',\n *   );\n * @endcode\n */\n$databases = array (\n  'default' => \n  array (\n    'default' => \n    array (\n      'database' => 'c9',\n      'username' => 'gurghet_1',\n      'password' => '',\n      'host' => '127.0.0.1',\n      'port' => '',\n      'driver' => 'mysql',\n      'prefix' => '',\n    ),\n  ),\n);\n\n/**\n * Access control for update.php script.\n *\n * If you are updating your Drupal installation using the update.php script but\n * are not logged in using either an account with the \"Administer software\n * updates\" permission or the site maintenance account (the account that was\n * created during installation), you will need to modify the access check\n * statement below. Change the FALSE to a TRUE to disable the access check.\n * After finishing the upgrade, be sure to open this file again and change the\n * TRUE back to a FALSE!\n */\n$update_free_access = FALSE;\n\n/**\n * Salt for one-time login links and cancel links, form tokens, etc.\n *\n * This variable will be set to a random value by the installer. All one-time\n * login links will be invalidated if the value is changed. Note that if your\n * site is deployed on a cluster of web servers, you must ensure that this\n * variable has the same value on each server. If this variable is empty, a hash\n * of the serialized database credentials will be used as a fallback salt.\n *\n * For enhanced security, you may set this variable to a value using the\n * contents of a file outside your docroot that is never saved together\n * with any backups of your Drupal files and database.\n *\n * Example:\n *   $drupal_hash_salt = file_get_contents('/home/example/salt.txt');\n *\n */\n$drupal_hash_salt = 'qP1R0HiUKNAvm2CXQ5NxSCGwggiY7t2U4Wx2HsnJlnw';\n\n/**\n * Base URL (optional).\n *\n * If Drupal is generating incorrect URLs on your site, which could\n * be in HTML headers (links to CSS and JS files) or visible links on pages\n * (such as in menus), uncomment the Base URL statement below (remove the\n * leading hash sign) and fill in the absolute URL to your Drupal installation.\n *\n * You might also want to force users to use a given domain.\n * See the .htaccess file for more information.\n *\n * Examples:\n *   $base_url = 'http://www.example.com';\n *   $base_url = 'http://www.example.com:8888';\n *   $base_url = 'http://www.example.com/drupal';\n *   $base_url = 'https://www.example.com:8888/drupal';\n *\n * It is not allowed to have a trailing slash; Drupal will add it\n * for you.\n */\n# $base_url = 'http://www.example.com';  // NO trailing slash!\n\n/**\n * PHP settings:\n *\n * To see what PHP settings are possible, including whether they can be set at\n * runtime (by using ini_set()), read the PHP documentation:\n * http://www.php.net/manual/ini.list.php\n * See drupal_environment_initialize() in includes/bootstrap.inc for required\n * runtime settings and the .htaccess file for non-runtime settings. Settings\n * defined there should not be duplicated here so as to avoid conflict issues.\n */\n\n/**\n * Some distributions of Linux (most notably Debian) ship their PHP\n * installations with garbage collection (gc) disabled. Since Drupal depends on\n * PHP's garbage collection for clearing sessions, ensure that garbage\n * collection occurs by using the most common settings.\n */\nini_set('session.gc_probability', 1);\nini_set('session.gc_divisor', 100);\n\n/**\n * Set session lifetime (in seconds), i.e. the time from the user's last visit\n * to the active session may be deleted by the session garbage collector. When\n * a session is deleted, authenticated users are logged out, and the contents\n * of the user's $_SESSION variable is discarded.\n */\nini_set('session.gc_maxlifetime', 200000);\n\n/**\n * Set session cookie lifetime (in seconds), i.e. the time from the session is\n * created to the cookie expires, i.e. when the browser is expected to discard\n * the cookie. The value 0 means \"until the browser is closed\".\n */\nini_set('session.cookie_lifetime', 2000000);\n\n/**\n * If you encounter a situation where users post a large amount of text, and\n * the result is stripped out upon viewing but can still be edited, Drupal's\n * output filter may not have sufficient memory to process it.  If you\n * experience this issue, you may wish to uncomment the following two lines\n * and increase the limits of these variables.  For more information, see\n * http://php.net/manual/pcre.configuration.php.\n */\n# ini_set('pcre.backtrack_limit', 200000);\n# ini_set('pcre.recursion_limit', 200000);\n\n/**\n * Drupal automatically generates a unique session cookie name for each site\n * based on its full domain name. If you have multiple domains pointing at the\n * same Drupal site, you can either redirect them all to a single domain (see\n * comment in .htaccess), or uncomment the line below and specify their shared\n * base domain. Doing so assures that users remain logged in as they cross\n * between your various domains. Make sure to always start the $cookie_domain\n * with a leading dot, as per RFC 2109.\n */\n# $cookie_domain = '.example.com';\n$cookie_domain = '.c9.io';\n\n/**\n * Variable overrides:\n *\n * To override specific entries in the 'variable' table for this site,\n * set them here. You usually don't need to use this feature. This is\n * useful in a configuration file for a vhost or directory, rather than\n * the default settings.php. Any configuration setting from the 'variable'\n * table can be given a new value. Note that any values you provide in\n * these variable overrides will not be modifiable from the Drupal\n * administration interface.\n *\n * The following overrides are examples:\n * - site_name: Defines the site's name.\n * - theme_default: Defines the default theme for this site.\n * - anonymous: Defines the human-readable name of anonymous users.\n * Remove the leading hash signs to enable.\n */\n# $conf['site_name'] = 'My Drupal site';\n# $conf['theme_default'] = 'garland';\n# $conf['anonymous'] = 'Visitor';\n\n/**\n * A custom theme can be set for the offline page. This applies when the site\n * is explicitly set to maintenance mode through the administration page or when\n * the database is inactive due to an error. It can be set through the\n * 'maintenance_theme' key. The template file should also be copied into the\n * theme. It is located inside 'modules/system/maintenance-page.tpl.php'.\n * Note: This setting does not apply to installation and update pages.\n */\n# $conf['maintenance_theme'] = 'bartik';\n\n/**\n * Reverse Proxy Configuration:\n *\n * Reverse proxy servers are often used to enhance the performance\n * of heavily visited sites and may also provide other site caching,\n * security, or encryption benefits. In an environment where Drupal\n * is behind a reverse proxy, the real IP address of the client should\n * be determined such that the correct client IP address is available\n * to Drupal's logging, statistics, and access management systems. In\n * the most simple scenario, the proxy server will add an\n * X-Forwarded-For header to the request that contains the client IP\n * address. However, HTTP headers are vulnerable to spoofing, where a\n * malicious client could bypass restrictions by setting the\n * X-Forwarded-For header directly. Therefore, Drupal's proxy\n * configuration requires the IP addresses of all remote proxies to be\n * specified in $conf['reverse_proxy_addresses'] to work correctly.\n *\n * Enable this setting to get Drupal to determine the client IP from\n * the X-Forwarded-For header (or $conf['reverse_proxy_header'] if set).\n * If you are unsure about this setting, do not have a reverse proxy,\n * or Drupal operates in a shared hosting environment, this setting\n * should remain commented out.\n *\n * In order for this setting to be used you must specify every possible\n * reverse proxy IP address in $conf['reverse_proxy_addresses'].\n * If a complete list of reverse proxies is not available in your\n * environment (for example, if you use a CDN) you may set the\n * $_SERVER['REMOTE_ADDR'] variable directly in settings.php.\n * Be aware, however, that it is likely that this would allow IP\n * address spoofing unless more advanced precautions are taken.\n */\n# $conf['reverse_proxy'] = TRUE;\n\n/**\n * Specify every reverse proxy IP address in your environment.\n * This setting is required if $conf['reverse_proxy'] is TRUE.\n */\n# $conf['reverse_proxy_addresses'] = array('a.b.c.d', ...);\n\n/**\n * Set this value if your proxy server sends the client IP in a header\n * other than X-Forwarded-For.\n */\n# $conf['reverse_proxy_header'] = 'HTTP_X_CLUSTER_CLIENT_IP';\n\n/**\n * Page caching:\n *\n * By default, Drupal sends a \"Vary: Cookie\" HTTP header for anonymous page\n * views. This tells a HTTP proxy that it may return a page from its local\n * cache without contacting the web server, if the user sends the same Cookie\n * header as the user who originally requested the cached page. Without \"Vary:\n * Cookie\", authenticated users would also be served the anonymous page from\n * the cache. If the site has mostly anonymous users except a few known\n * editors/administrators, the Vary header can be omitted. This allows for\n * better caching in HTTP proxies (including reverse proxies), i.e. even if\n * clients send different cookies, they still get content served from the cache.\n * However, authenticated users should access the site directly (i.e. not use an\n * HTTP proxy, and bypass the reverse proxy if one is used) in order to avoid\n * getting cached pages from the proxy.\n */\n# $conf['omit_vary_cookie'] = TRUE;\n\n/**\n * CSS/JS aggregated file gzip compression:\n *\n * By default, when CSS or JS aggregation and clean URLs are enabled Drupal will\n * store a gzip compressed (.gz) copy of the aggregated files. If this file is\n * available then rewrite rules in the default .htaccess file will serve these\n * files to browsers that accept gzip encoded content. This allows pages to load\n * faster for these users and has minimal impact on server load. If you are\n * using a webserver other than Apache httpd, or a caching reverse proxy that is\n * configured to cache and compress these files itself you may want to uncomment\n * one or both of the below lines, which will prevent gzip files being stored.\n */\n# $conf['css_gzip_compression'] = FALSE;\n# $conf['js_gzip_compression'] = FALSE;\n\n/**\n * String overrides:\n *\n * To override specific strings on your site with or without enabling the Locale\n * module, add an entry to this list. This functionality allows you to change\n * a small number of your site's default English language interface strings.\n *\n * Remove the leading hash signs to enable.\n */\n# $conf['locale_custom_strings_en'][''] = array(\n#   'forum'      => 'Discussion board',\n#   '@count min' => '@count minutes',\n# );\n\n/**\n *\n * IP blocking:\n *\n * To bypass database queries for denied IP addresses, use this setting.\n * Drupal queries the {blocked_ips} table by default on every page request\n * for both authenticated and anonymous users. This allows the system to\n * block IP addresses from within the administrative interface and before any\n * modules are loaded. However on high traffic websites you may want to avoid\n * this query, allowing you to bypass database access altogether for anonymous\n * users under certain caching configurations.\n *\n * If using this setting, you will need to add back any IP addresses which\n * you may have blocked via the administrative interface. Each element of this\n * array represents a blocked IP address. Uncommenting the array and leaving it\n * empty will have the effect of disabling IP blocking on your site.\n *\n * Remove the leading hash signs to enable.\n */\n# $conf['blocked_ips'] = array(\n#   'a.b.c.d',\n# );\n\n/**\n * Fast 404 pages:\n *\n * Drupal can generate fully themed 404 pages. However, some of these responses\n * are for images or other resource files that are not displayed to the user.\n * This can waste bandwidth, and also generate server load.\n *\n * The options below return a simple, fast 404 page for URLs matching a\n * specific pattern:\n * - 404_fast_paths_exclude: A regular expression to match paths to exclude,\n *   such as images generated by image styles, or dynamically-resized images.\n *   If you need to add more paths, you can add '|path' to the expression.\n * - 404_fast_paths: A regular expression to match paths that should return a\n *   simple 404 page, rather than the fully themed 404 page. If you don't have\n *   any aliases ending in htm or html you can add '|s?html?' to the expression.\n * - 404_fast_html: The html to return for simple 404 pages.\n *\n * Add leading hash signs if you would like to disable this functionality.\n */\n$conf['404_fast_paths_exclude'] = '/\\/(?:styles)\\//';\n$conf['404_fast_paths'] = '/\\.(?:txt|png|gif|jpe?g|css|js|ico|swf|flv|cgi|bat|pl|dll|exe|asp)$/i';\n$conf['404_fast_html'] = '<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML+RDFa 1.0//EN\" \"http://www.w3.org/MarkUp/DTD/xhtml-rdfa-1.dtd\"><html xmlns=\"http://www.w3.org/1999/xhtml\"><head><title>404 Not Found</title></head><body><h1>Not Found</h1><p>The requested URL \"@path\" was not found on this server.</p></body></html>';\n\n/**\n * By default the page request process will return a fast 404 page for missing\n * files if they match the regular expression set in '404_fast_paths' and not\n * '404_fast_paths_exclude' above. 404 errors will simultaneously be logged in\n * the Drupal system log.\n *\n * You can choose to return a fast 404 page earlier for missing pages (as soon\n * as settings.php is loaded) by uncommenting the line below. This speeds up\n * server response time when loading 404 error pages and prevents the 404 error\n * from being logged in the Drupal system log. In order to prevent valid pages\n * such as image styles and other generated content that may match the\n * '404_fast_html' regular expression from returning 404 errors, it is necessary\n * to add them to the '404_fast_paths_exclude' regular expression above. Make\n * sure that you understand the effects of this feature before uncommenting the\n * line below.\n */\n# drupal_fast_404();\n\n/**\n * External access proxy settings:\n *\n * If your site must access the Internet via a web proxy then you can enter\n * the proxy settings here. Currently only basic authentication is supported\n * by using the username and password variables. The proxy_user_agent variable\n * can be set to NULL for proxies that require no User-Agent header or to a\n * non-empty string for proxies that limit requests to a specific agent. The\n * proxy_exceptions variable is an array of host names to be accessed directly,\n * not via proxy.\n */\n# $conf['proxy_server'] = '';\n# $conf['proxy_port'] = 8080;\n# $conf['proxy_username'] = '';\n# $conf['proxy_password'] = '';\n# $conf['proxy_user_agent'] = '';\n# $conf['proxy_exceptions'] = array('127.0.0.1', 'localhost');\n\n/**\n * Authorized file system operations:\n *\n * The Update manager module included with Drupal provides a mechanism for\n * site administrators to securely install missing updates for the site\n * directly through the web user interface. On securely-configured servers,\n * the Update manager will require the administrator to provide SSH or FTP\n * credentials before allowing the installation to proceed; this allows the\n * site to update the new files as the user who owns all the Drupal files,\n * instead of as the user the webserver is running as. On servers where the\n * webserver user is itself the owner of the Drupal files, the administrator\n * will not be prompted for SSH or FTP credentials (note that these server\n * setups are common on shared hosting, but are inherently insecure).\n *\n * Some sites might wish to disable the above functionality, and only update\n * the code directly via SSH or FTP themselves. This setting completely\n * disables all functionality related to these authorized file operations.\n *\n * @see http://drupal.org/node/244924\n *\n * Remove the leading hash signs to disable.\n */\n# $conf['allow_authorize_operations'] = FALSE;\n","undoManager":{"mark":-1,"position":31,"stack":[[{"group":"doc","deltas":[{"action":"insertText","range":{"start":{"row":337,"column":34},"end":{"row":338,"column":0}},"text":"\n"}]}],[{"group":"doc","deltas":[{"action":"insertText","range":{"start":{"row":338,"column":0},"end":{"row":338,"column":1}},"text":"$"}]}],[{"group":"doc","deltas":[{"action":"insertText","range":{"start":{"row":338,"column":1},"end":{"row":338,"column":2}},"text":"c"}]}],[{"group":"doc","deltas":[{"action":"insertText","range":{"start":{"row":338,"column":2},"end":{"row":338,"column":3}},"text":"o"}]}],[{"group":"doc","deltas":[{"action":"insertText","range":{"start":{"row":338,"column":3},"end":{"row":338,"column":4}},"text":"o"}]}],[{"group":"doc","deltas":[{"action":"insertText","range":{"start":{"row":338,"column":4},"end":{"row":338,"column":5}},"text":"b"}]}],[{"group":"doc","deltas":[{"action":"removeText","range":{"start":{"row":338,"column":4},"end":{"row":338,"column":5}},"text":"b"}]}],[{"group":"doc","deltas":[{"action":"insertText","range":{"start":{"row":338,"column":4},"end":{"row":338,"column":5}},"text":"k"}]}],[{"group":"doc","deltas":[{"action":"insertText","range":{"start":{"row":338,"column":5},"end":{"row":338,"column":6}},"text":"i"}]}],[{"group":"doc","deltas":[{"action":"insertText","range":{"start":{"row":338,"column":6},"end":{"row":338,"column":7}},"text":"e"}]}],[{"group":"doc","deltas":[{"action":"insertText","range":{"start":{"row":338,"column":7},"end":{"row":338,"column":8}},"text":"-"}]}],[{"group":"doc","deltas":[{"action":"removeText","range":{"start":{"row":338,"column":7},"end":{"row":338,"column":8}},"text":"-"}]}],[{"group":"doc","deltas":[{"action":"insertText","range":{"start":{"row":338,"column":7},"end":{"row":338,"column":8}},"text":"_"}]}],[{"group":"doc","deltas":[{"action":"insertText","range":{"start":{"row":338,"column":8},"end":{"row":338,"column":9}},"text":"d"}]}],[{"group":"doc","deltas":[{"action":"insertText","range":{"start":{"row":338,"column":9},"end":{"row":338,"column":10}},"text":"o"}]}],[{"group":"doc","deltas":[{"action":"insertText","range":{"start":{"row":338,"column":10},"end":{"row":338,"column":11}},"text":"m"}]}],[{"group":"doc","deltas":[{"action":"insertText","range":{"start":{"row":338,"column":11},"end":{"row":338,"column":12}},"text":"a"}]}],[{"group":"doc","deltas":[{"action":"insertText","range":{"start":{"row":338,"column":12},"end":{"row":338,"column":13}},"text":"i"}]}],[{"group":"doc","deltas":[{"action":"insertText","range":{"start":{"row":338,"column":13},"end":{"row":338,"column":14}},"text":"n"}]}],[{"group":"doc","deltas":[{"action":"insertText","range":{"start":{"row":338,"column":14},"end":{"row":338,"column":15}},"text":" "}]}],[{"group":"doc","deltas":[{"action":"insertText","range":{"start":{"row":338,"column":15},"end":{"row":338,"column":16}},"text":"="}]}],[{"group":"doc","deltas":[{"action":"insertText","range":{"start":{"row":338,"column":16},"end":{"row":338,"column":17}},"text":" "}]}],[{"group":"doc","deltas":[{"action":"insertText","range":{"start":{"row":338,"column":17},"end":{"row":338,"column":19}},"text":"''"}]}],[{"group":"doc","deltas":[{"action":"insertText","range":{"start":{"row":338,"column":18},"end":{"row":338,"column":19}},"text":"/"}]}],[{"group":"doc","deltas":[{"action":"removeText","range":{"start":{"row":338,"column":18},"end":{"row":338,"column":19}},"text":"/"}]}],[{"group":"doc","deltas":[{"action":"insertText","range":{"start":{"row":338,"column":18},"end":{"row":338,"column":19}},"text":"."}]}],[{"group":"doc","deltas":[{"action":"insertText","range":{"start":{"row":338,"column":19},"end":{"row":338,"column":20}},"text":"c"}]}],[{"group":"doc","deltas":[{"action":"insertText","range":{"start":{"row":338,"column":20},"end":{"row":338,"column":21}},"text":"9"}]}],[{"group":"doc","deltas":[{"action":"insertText","range":{"start":{"row":338,"column":21},"end":{"row":338,"column":22}},"text":"."}]}],[{"group":"doc","deltas":[{"action":"insertText","range":{"start":{"row":338,"column":22},"end":{"row":338,"column":23}},"text":"i"}]}],[{"group":"doc","deltas":[{"action":"insertText","range":{"start":{"row":338,"column":23},"end":{"row":338,"column":24}},"text":"o"}]}],[{"group":"doc","deltas":[{"action":"insertText","range":{"start":{"row":338,"column":25},"end":{"row":338,"column":26}},"text":";"}]}]]},"ace":{"folds":[],"scrolltop":5180.5,"scrollleft":0,"selection":{"start":{"row":338,"column":26},"end":{"row":338,"column":26},"isBackwards":false},"options":{"guessTabSize":true,"useWrapMode":false,"wrapToView":true},"firstLineState":{"row":322,"state":"php-doc-start","mode":"ace/mode/php"}},"timestamp":1413467694652}