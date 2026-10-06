<!--
This file is yours to edit. It was created from the Altis skeleton to give AI coding
agents an overview of an Altis project. Add details about your own application in the
"Project-specific notes" section at the end.
-->

# Agent instructions

## What this project is

This is a WordPress site built on [Altis](https://docs.altis-dxp.com/), the next-generation, enterprise-ready WordPress platform.
Altis is a set of Composer packages ("modules") that add features to WordPress. WordPress core and every module are installed by
Composer, so they are not part of this repository's own code.

When something here behaves differently from stock WordPress, check the Altis documentation before changing it. Start with
[Differences from WordPress](https://docs.altis-dxp.com/getting-started/differences-from-wp/).

## Architecture

The modules this project includes (each can be configured or turned off):

| Module            | What it provides                                                                                          |
| ----------------- | --------------------------------------------------------------------------------------------------------- |
| core              | The platform entry point: module loader and registry, configuration parsing, environment functions, CLI   |
| cms               | WordPress itself, plus extra enterprise features                                                          |
| cloud             | Connects the site to Altis hosting: email delivery, page and database caching, log shipping, scheduled tasks |
| media             | S3 uploads, dynamic image resizing and cropping (Tachyon), SVG sanitization, lazy loading                 |
| enhanced-search   | A mirrored Elasticsearch index of your content for faster, more relevant search                           |
| security          | Multi-factor authentication, password strength rules and audit logging                                    |
| privacy           | A framework for consent, user data management and privacy documentation                                   |
| seo               | SEO features, including redirect management                                                              |
| sso               | Single sign-on through an external identity provider (SAML 2.0)                                           |
| dev-tools         | Debugging and profiling (Query Monitor), testing, linting and CI tools. Not active in production          |
| documentation     | Shows the Altis documentation, and your own, inside the WordPress admin                                   |
| local-server      | Docker-based local environment that stands in for most hosted components (development only)               |
| advanced-security | (Optional) Patchstack-powered scanning of plugins and themes for known vulnerabilities                    |

### Where things live

- `content/mu-plugins/` — your project's own code, loaded automatically.
- `content/plugins/` — third-party plugins installed by Composer.
- `content/themes/` — themes. `content/themes/base` is a starting point you can replace. Or create one from scratch.
- `composer.json` — dependencies and Altis configuration.

Do not edit these generated or installed paths. Changes are overwritten by Composer:

- `vendor/`
- `wordpress/`
- the root `index.php` and `wp-config.php`

### Configuration

Altis is configured in the `extra.altis` section of the root `composer.json`, using the form
`extra.altis.modules.<module>.<setting>`. For example:

```json
{
    "extra": {
        "altis": {
            "modules": {
                "security": {
                    "require-login": true
                }
            },
            "environments": {
                "local": {
                    "modules": {
                        "security": {
                            "require-login": false
                        }
                    }
                }
            }
        }
    }
}
```

Settings under `environments.<name>` are merged over the global settings for that environment. Configuration in `composer.json`
takes precedence over anything set in the WordPress admin. Each module's documentation lists its settings.

The environment types are `local`, `development`, `staging` and `production`. The hosting platform sets the type, and it is
`local` when nothing sets it. Altis also merges settings under `environments.ci` when the `CI` environment variable is set. Those
settings extend the `local` ones.

## Local development

Local development needs Docker. Run these from the project root:

```sh
composer server start     # start the stack
composer server stop      # stop it
composer server status    # show what is running
composer server restart   # restart after changing configuration
```

The site is served at `https://<project-directory-name>.altis.dev/`. The default login is `admin` / `password`.

Run WP-CLI inside the stack, never with a `wp` installed on your own machine, and leave `wp` out of the command:

```sh
composer server cli -- post list
```

Other useful commands:

```sh
composer server exec -- <command>      # run a command in the web container
composer server db exec -- "<sql>"     # run SQL against the database
composer server logs <service>         # view a service's logs
```

`composer server shell`, `composer server db` (without `exec`) and `composer server logs` (without a service name) need an
interactive terminal. If you have no terminal, use the non-interactive forms above.

`composer server destroy` deletes the local environment and its data. Do not run it unless asked.

## Dependencies

- Add plugins and themes with `composer require`, not by copying files into `content/`. Composer places them in the right
  directory.
- Commit `composer.lock`. Do not commit `vendor/` or `wordpress/`.
- Do not delete `composer.lock` or run a full `composer update` to fix a problem. Update the specific package you need.

## Tests and code quality

Run tests through the Altis dev-tools module so they use the same environment as the rest of the stack:

```sh
composer dev-tools phpunit             # unit and integration tests
composer dev-tools codecept run        # acceptance tests
```

The test tooling creates and removes its own test databases, so do not create them by hand.

For linting and formatting, use the ruleset and scripts this project already configures (look in `composer.json` and for a
`phpcs.xml` or `.phpcs.xml.dist` file). Do not substitute a different coding standard.

## Common gotchas

- Altis modules start before WordPress has finished loading. Code that runs while a module bootstraps cannot call most
  WordPress functions yet. Wait for the `muplugins_loaded` or `init` hooks instead.
- The local stack only approximates the hosted platform. Locally, uploads go to a local S3-compatible service, email is caught
  by MailHog instead of being sent, and Elasticsearch runs only if Enhanced Search is installed. The CDN and page caching exist
  only on hosted environments. Check anything that depends on these on a non-production cloud environment before assuming it
  works.
- A setting changed in the WordPress admin will be overridden if the same setting is in `composer.json`.
- After switching to a branch with a different `composer.json`, run `composer update <package>` for the changed package. Running
  only `composer dump-autoload` is not enough.
- Check the reason for a pinned dependency version before changing it.

## Working conventions

- Follow the WordPress coding standards and use namespaces in PHP.
- Make changes on a branch and open a pull request.
- Ask before deleting data, dropping databases or running other destructive commands.

## More documentation

- Altis documentation: https://docs.altis-dxp.com/
- Each Altis module has a `docs/` directory in `vendor/altis/<module>/`, and the same pages appear in the WordPress admin through
  the documentation module.
- Upgrading Altis: read the [upgrading guides](https://docs.altis-dxp.com/guides/upgrading/) for the version you are moving to
  before running `composer update`.

## Project-specific notes

Add details about this application here: what it does, custom modules and plugins, deployment, environment variables, team
conventions and known issues.
