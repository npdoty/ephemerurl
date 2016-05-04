Ephemerurls are ephemeral redirection URLs, which only function for a limited period of time. Until the configured time, an ephemerurl 307 redirects to the original URL; after expiration, it's 410 GONE.

Why? Because users of the Web should have soft limits on sharing as well as hard security restrictions, and ephemerality of URLs is one such step. More specifically, if I want to point people to something that's in progress and not to be made publicly accessible, an ephemerurl can be archived in mailing lists or chat logs, or re-shared via email, without extending access forever.

### How To Use

2. Place the ephemerurl directory on your web server.
1. Create a sqlite database `urls.db` with a single table `Urlmaps`, with three text columns (`source`, `target`, `expiry`).
3. Configure a `.htaccess` file to direct all `/u/` and `/until*/` paths to ephemerurl.

### TODO

* create .htaccess / mod_rewrite rules
* create standalone .sql file to create the sqlite database

### Security

I couldn't successfully execute a trivial XSS attack, but I would welcome reports that such attacks are possible or recommendations for code to give stronger assurances that they aren't possible. Proof of concepts are great, but please don't intentionally do harm to users.