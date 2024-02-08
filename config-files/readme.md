# Honeypot Project - Config files

Written By Sebastiaan Sillis, Senne Vandecasteele en Symon Huybrecht

## List Of Contents

[ 00 Intro](./readme.md)

[ 01 Setting up webserver](./readmes/setting-up-webserver.md)

[ 02 Setting up elkserver](./readmes/setting-up-elkserver.md)

[ 03 Documentation](./Documentatie.md)


## Overview
In this section we are going to setup the ansible ssh connection.

With your ansible control node vm ssh into naruto. and copy the ssh keys.

Check if you can ssh succesfully without password.

Create also an SSH key in the webserver, this is for pulling from the gitserver.
Add this public key to your git account

Then you can start on setting up the webserver

Aftwards set up the elkserver
