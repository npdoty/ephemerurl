Ephemerurls are ephemeral redirection URLs, which only function for a limited period of time. Until the configured time, an ephemerurl 307 redirects to the original URL; after expiration, it's 410 GONE.

Why? Because users of the Web should have soft limits on sharing as well as hard security restrictions, and ephemerality of URLs is one such step. More specifically, if I want to point people to something that's in progress and not to be made publicly accessible, an ephemerurl can be archived in mailing lists or chat logs, or re-shared via email, without extending access forever.

### How To Use

1. Go to a URL at (for example) `https://npdoty.name`.
2. Add "until6pm/" between the domain and the rest of the URL, e.g. https://npdoty.name/**until6pm**/test-url.
3. Get the provided `/u/` URL and share it with your friends -- it'll only work until the specified time.

### How To Install

2. Place the ephemerurl directory on your web server.
1. Create a sqlite database `urls.db` with a single table `Urlmaps`, with three text columns (`source`, `target`, `expiry`).
3. Configure a `.htaccess` file to direct all `/u/` and `/until*/` paths to `ephemerurl/index.php`. (See `htaccess.sample`.)

### TODO

* create standalone .sql file to create the sqlite database

### Security

I couldn't successfully execute a trivial XSS attack, but I would welcome reports that such attacks are possible or recommendations for code to give stronger assurances that they aren't possible. Proof of concepts are great, but please don't intentionally do harm to users.

There's no app-level protection against denial of service (e.g. authentication or rate-limiting), an attacker could use up all the nice short URLs or create collisions.