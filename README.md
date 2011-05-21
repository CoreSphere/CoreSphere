CoreSphere
==========

What's inside?
--------------

CoreSphere comes pre-configured with the following bundles:

 * FrameworkBundle
 * SensioFrameworkExtraBundle
 * DoctrineBundle
 * TwigBundle
 * SwiftmailerBundle
 * MonologBundle
 * AsseticBundle
 * ConsoleBundle
 * WebProfilerBundle (in dev/test env)
 * TwigProfilerBundle (in dev/test env)
 * SymfonyWebConfiguratorBundle (in dev/test env)
 * AcmeDemoBundle (in dev/test env)

Installation from an Archive
----------------------------

The easiest way to get started is to download an archive with vendors included.
Unpack it somewhere under your web server root directory and you're done.

If you have downloaded an archive without the vendors, run the
`bin/vendors.sh` script (`git` must be installed on your machine). If you
don't have git, download the version with the vendors included.

Installation from Git
---------------------

We highly recommend you that you download the packaged version of this
distribution. If you still want to use Git, your are on your own.

Run the following scripts:

 * `bin/vendors.sh` (use `--min` if you don't want all the history)

Configuration
-------------

Check that everything is working fine by going to the `web/config.php` page in a
browser and follow the instructions.

The distribution is configured with the following defaults:

 * Twig is the only configured template engine;
 * Doctrine ORM/DBAL is configured;
 * Swiftmailer is configured;
 * Annotations for everything are enabled.

Configure the distribution by editing `app/config/parameters.ini` or by
accessing `web/config.php` in a browser.

If you want to use the CLI, a console application is available at
`app/console`. Check first that your PHP is correctly configured for the CLI
by running `app/check.php`.

Also note that this console is available via web, make sure to properly
protect it

Enjoy!
