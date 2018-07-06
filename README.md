# SilverShop Demo

This repository contains the source code, composer and related files for 
https://demo.silvershop.io. The demo is basically a setup of 
[recipe-silvershop](https://github.com/silvershop/recipe-silvershop) with the
default content populated.

Demo will reset every hour, on the hour via a cron job. Every hour it will pull
down the `1.0.x-dev` version of `recipe-silvershop` down and wipe the database.

## CMS Login

CMS login details are:

	user: `silvershopcore`
	pass: `silvershopcore`

Any users spamming the system or found to be putting up content which is 
inappropriate will have their IP addresses banned.

## Hosting

The demo is managed by Wilr @ [Fullscreen.io](https://www.fullscreen.io). If you
would like to help manage the demo please email your SSH key. Deployment to the
container is done via [Beam](https://github.com/heyday/beam) and you must have
a SSH alias setup as the following

	Host silvershop
  	  User silvershopcore
  	  HostName 139.162.198.61
  	  ForwardAgent true

Then deployment is triggered by `beam up prod`