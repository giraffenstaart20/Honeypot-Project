# Honeypot Project - Config files

Written By Sebastiaan Sillis, Senne Vandecasteele en Symon Huybrecht

## List Of Contents

[ 00 Intro](./readme.md)

[ 01 Setting up webserver](./readmes/setting-up-webserver.md)

[ 02 Setting up elkserver](./readmes/setting-up-elkserver.md)

## Setting up requirements

Start by running the elkserver-set-up playbook:

```bash
ansible-playbook elkserver-set-up.yml -u killerb -K
```

Before installing elastic add a file on path: 
"/etc/elasticsearch/jvm.options.d/heap.options"

```bash
-Xms1g
-Xmx1g
```

## Setting up elasticsearch

Then continue by running the elkserver-install-elastic: 

```bash
ansible-playbook elkserver-install-elastic.yml -u killerb -K
```

After succesfull run test ssh into the server and set the new userpass using:

```bash
sudo /usr/share/elasticsearch/bin/elasticsearch-reset-password -u elastic
```

Save this userpass!

## Testing elasticsearch
Execute the next two curl commands on your ansible controller AND in the actual elastic stack!

```bash
# command in elastic stack VM
sudo curl --cacert /etc/elasticsearch/certs/http_ca.crt -u elastic:YOUR_GENERATED_PASSWORD https://localhost:9200

# command in host machine
curl -u "elastic:YOUR_GENERATED_PASSWORD" https://group14elk.hp.ti.howest.be -k

# output of both commands should be:
{
  "name" : "elastic-stack-part-I",
  "cluster_name" : "elasticsearch",
  "cluster_uuid" : "UH0uIoTCQD-0OxEc7W83Lw",
  "version" : {
    "number" : "8.4.0",
    "build_flavor" : "default",
    "build_type" : "deb",
    "build_hash" : "f56126089ca4db89b631901ad7cce0a8e10e2fe5",
    "build_date" : "2022-08-19T19:23:42.954591481Z",
    "build_snapshot" : false,
    "lucene_version" : "9.3.0",
    "minimum_wire_compatibility_version" : "7.17.0",
    "minimum_index_compatibility_version" : "7.0.0"
  },
  "tagline" : "You Know, for Search"
}
```

## setting up kibana

You are now ready to install kibana on the elkserver

run the playbook for setting up kibana:

```bash
ansible-playbook elkserver-install-kibana.yml -u killerb -K
```

## Create enrollment token

after this create an enrollment token with the kibana create enrollment playbook

```bash
ansible-playbook kibana-create-enrollment.yml -u killerb -K
```

## Test kibana setup

Surf to https://group14elk.hp.ti.howest.be

- Paste the enrollment token created
- enter the verification token

This can be grabbed by running the following playbook:

```bash
ansible-playbook kibana-get-status.yml -u killerb -K
```

Login on Kibana with
- user:elastic
- password: ELASTIC_GENERATED_PASSWORD from part 01

## Set up logstash

run the install logstash playbook

```bash
ansible-playbook elkserver-install-logstash.yml -u killerb -K --extra-vars "[ELASTIC_GENERATED_PASSWORD]”
```

## All configuration finished on elkstack
