#!/usr/bin/env bash
docker exec -i mysql-test-5.7 /usr/bin/mysql -uroot --password=elabstest123 -e "DROP DATABASE IF EXISTS elabstest; CREATE DATABASE elabstest"
zcat elabs-test.sql.gz | docker exec -i mysql-test-5.7 /usr/bin/mysql -uroot --password=elabstest123 elabstest
