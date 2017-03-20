#!/bin/bash
vendor/bin/tester -p php -c tests/php.ini -l tests/tmp/tests.log -j 1 $1
cat tests/tmp/*.log
