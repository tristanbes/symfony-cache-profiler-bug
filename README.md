Cache profiler bug ?
====================

bin/console server:start

1. Visit the default url to populate the cache [http://127.0.0.1:8000/app_dev.php](http://127.0.0.1:8000/app_dev.php)
2. Execute `bin/console test:clear:tags tag1` 
3. Check your redis (for example with phpRedisAdmin) and see that the keys are still present, in addition, a new namespace is created.




