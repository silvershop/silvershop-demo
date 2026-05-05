# SilverShop Demo

This repository contains the source code, composer and related files for
https://demo.silvershop.io. The demo is basically a setup of
[recipe-silvershop](https://github.com/silvershop/recipe-silvershop) with the
default content populated.

The demo environment resets every hour, on the hour, via a **cron job on the
demo server** (see [Cron job](#cron-job) below). Each run refreshes Composer
dependencies (including the SilverShop recipe) and rebuilds the database from
scratch so public CMS changes do not accumulate.

## CMS Login

CMS login details are:

	user: `silvershopcore`
	pass: `silvershopcore`

Any users spamming the system or found to be putting up content which is
inappropriate will have their IP addresses banned.

## Local Development

Local development is handled by [DDEV](https://ddev.com/). To start the
application run

```sh
ddev start
```

Then load the project

```sh
ddev composer install
ddev sake db:build
```

## Hosting

The demo is managed by Wilr @ [Fullscreen.io](https://www.fullscreen.io). If you
would like to help manage the demo please email your SSH key. Deployment to the
container is done via [Beam](https://github.com/heyday/beam) and you must have
a SSH alias setup as the following

```
Host silvershop
  User silvershopcore
  HostName kobe.fullscreen.io
  ForwardAgent true
```

Then deployment is triggered by `beam up prod`

### Cron job

The hourly reset is **not defined in this repository**; it is installed in the
server crontab for the demo host ([Fullscreen.io](https://www.fullscreen.io),
see [Hosting](#hosting)). It is scheduled to run **at minute 0 of every hour**
(i.e. `0 * * * *` in cron syntax—confirm the live entry with whoever maintains
the container).

From the application root on the server (`/container/application`, matching
`webroot` in `beam.json`), the job runs the same **`setup`** script that Beam
executes after a deploy (`phase: post` in `beam.json`). That script:

1. Puts the site into a short “updating” state by swapping `public/.htaccess`
   for `public/.htaccess-updating`.
2. Runs `composer update --no-interaction`.
3. On success: drops every table in the `silvershopcore` MySQL database, runs
   `dev/build`, runs `dev/tasks/PopulateShopTask`, then restores the normal
   `.htaccess`.
4. On Composer failure: restores `.htaccess` and leaves the database unchanged.

For the exact shell command the cron uses (e.g. `cd /container/application &&
./setup`), check the server configuration.


