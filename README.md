# Statamic Nocache Bug Reproduction

If you use a `nocache` tag while `STATAMIC_STATIC_CACHING_STRATEGY=null` or while `STATAMIC_STATIC_CACHING_STRATEGY=half` and you are on an excluded page, your nocache session will add an entry with every page load.

To reproduce:

- Clone repository
- Copy `.env.example` to `.env`
- Run `composer install`
- Run `php artisan serve`
- Head to [http://localhost:8000](http://localhost:8000)

Every time you refresh the page, another entry will be added to your cache (for me, locally, this happens in `storage/framework/cache/data/e7/75/e775231134737af1b63e5be9e1a61cfd10dbd691`).

If you set `STATAMIC_STATIC_CACHING_STRATEGY=half`, you can still head to an excluded page ([http://localhost:8000/login](http://localhost:8000/login)) to reproduce the issue.