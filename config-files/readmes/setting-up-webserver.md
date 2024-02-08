# Honeypot Project - Config files

Written By Sebastiaan Sillis, Senne Vandecasteele en Symon Huybrecht

## List Of Contents

[ 00 Intro](./readme.md)

[ 01 Setting up webserver](./readmes/setting-up-webserver.md)

[ 02 Setting up elkserver](./readmes/setting-up-elkserver.md)

## Setting up webserver

Run the webserver set up yml:

```bash
ansible-playbook webserver-set-up.yml -u killerb -K
```

After that SSH into the webserver and run the secure mysql installation that will promt the basic setup. Set a root password and save this somewhere.
You will need this to set up a new user

```bash
Sudo mysql_secure_installation
```

## Installing mysqlserver

Run the webserver-mysql set up yml:

```bash
ansible-playbook webserver-mysql-set-up.yml -u killerb -K
```

after this make a new user by sshing into the server and running ""

```bash
#opening mysqlconsole
mysql -u root -p

#Adding new remote user
GRANT ALL PRIVILEGES ON *.* TO '{username}'@'%' IDENTIFIED BY '{password}' WITH GRANT OPTION;
```

you can now connect to this mysqlserver using this username and password

## Configuring Apache

You can now start configuring apache using the playbook

```bash
ansible-playbook webserver-apache-config.yml -u killerb -K
```

this playbook wil pull the config files from the configfiles directory is git pull is don inside the main user directory from the control node.

After this remove the server signature by adding in the apache.conf "ServerSignature Off"

## Pulling webcode

Using the clone repo script pull the code from the repo.

```bash
ansible-playbook webserver-clone-repo.yml -u killerb -K
```

## Configuring filebeat

Run the filebeat config script

```bash
ansible-playbook webserver-filebeat-config.yml -u killerb -K
```

## All configuration completed on webserver
