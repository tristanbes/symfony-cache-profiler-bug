Cache profiler bug ?
====================

bin/console server:run

http://127.0.0.1:8000/app_dev.php

1. Go to profiler cache pannel : show 0 calls for pool app.cache.statistics 
2. Go to profiler performance, select subrequest Menu, it shows x calls for pool app.cache.statistics 

It's **disturbing** because the cache call were made on the main request (not on the sub request), so I don't get why it's ont the sub request profiler that the data is showing
