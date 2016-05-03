Ephemerurls are ephemeral redirection URLs, which only function for a limited period of time. Until the configured time, an ephemerurl 302 redirects to the original URL; after expiration, it's 410 GONE.

### TODO

* create .htaccess / mod_rewrite rules
* create standalone .sql file to create the sqlite database

### Security

I couldn't successfully execute a trivial XSS attack, but I would welcome reports that such attacks are possible or recommendations for code to give stronger assurances that they aren't possible. Proof of concepts are great, but please don't intentionally do harm to users.