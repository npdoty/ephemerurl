Friends,

I welcome feedback on an experimental feature, exploring ephemerality and URLs, or "ephemerurls". Here's the idea: sometimes I've posted something on my website that I want to share with some colleagues, but the thing isn't quite finished yet. I might want to post the URL in some forum (an IRC or Slack channel, an archived mailing list, or on Twitter), but I don't want the generally accessible URL to be permanently, publicly archived in one of those settings. That is, I want to give out a URL, but the URL should only work temporarily.

Ephemerurl is a service I've built and deployed on my own site. Here's how it works. Let's say I've been working on a piece of writing, a static HTML page, that I want to share just for a little while for some feedback. Maybe I'm presenting the in-progress work to a group of people at an in-person or virtual meeting and want to share a link in the group's chatroom. Here's a screenshot of that page, at its permanent URL:

![Screen shot of the in-progress page I want to share](https://npdoty.name/images/Screen+Shot+2016-06-17+at+4.56.34+PM.png)

I decide I want to share a link that will only work until 6pm this afternoon. So I change the URL, and add "/until6pm/" between "npdoty.name" and the rest of the URL. My site responds:

![Screen shot of the ephemeral URL creation page](https://npdoty.name/images/Screen+Shot+2016-06-17+at+4.57.19+PM.png)

_"Okay, Nick, here's an ephemeral URL you can use"_ Great, I copy and paste this opaque, short URL into the chatroom: **[https://npdoty.name/u/vepu](https://npdoty.name/u/vepu)**

Right now, that URL will redirect to the original page. (But if you don't see this email until after 6pm my time, you'll instead get a 410 Gone error message.) But if the chatroom logs are archived after our meeting (which they often are in groups where I work), the permanent link won't be useful.

Of course, if you follow a URL like that, you might not realize that it's intended to be a time-boxed URL. So the static page provides a little disclosure to you, letting you know this might not be public, and suggesting that if you share the URL, you use the same ephemeral URL that you received.

![Screen shot of the landing page with nudge](https://npdoty.name/images/Screen+Shot+2016-06-17+at+4.57.40+PM.png)

This builds on a well-known pattern. [Private, "unguessable" links](http://privacypatterns.org/patterns/Private-link) are a common way of building in a kind of flexible privacy/access-control into our use of the Web. They're examples of [Capability URLs](https://www.w3.org/TR/capability-urls/). Sites will often, when accessing a private or capability URL, provide a warning to the user letting them know about the sharing norms that might apply:

![YouTube screenshot with warning about private URL](https://npdoty.name/images/Screen+Shot+2016-02-08+at+10.50.03+PM.png)

But ephemerurls also provide a specific, informal ephemerality, another increasingly popular privacy feature. It's not effective against a malicious attacker -- if I don't want you to see my content or I don't trust you to follow some basic norms of sharing, then this feature won't stop you, and I'm not sure anything on the Web really could -- but it uses norms and the way we often share URLs to introduce another layer of control over sharing information. Snapchat is great not because it could somehow prevent a malicious recipient from taking a screenshot, but because it introduces a norm of disappearance, which makes a certain kind of informal sharing easier. 

I'd like to see the same kinds of sharing available on the Web. Disappearing URLs might be one piece, but folks are also talking about easy ways to make social media posts have a pre-determined lifetime where they'll automatically disappear.

What do you think? [Code, documentation, issues, etc. on Github](https://github.com/npdoty/ephemerurl). 

**Update:** it's been pointed out (thanks Seb, Andrew) that while I've built and deployed this for my own domain, it would also make sense to have a standalone service (you know, like [bit.ly](https://bitly.com/)) that created ephemeral URLs that could work for any page on the Web without having to install some PHP. It's like [perma.cc](https://perma.cc/), but the opposite. See [issue #1](https://github.com/npdoty/ephemerurl/issues/1).

Cheers,<br>
Nick

P.S. Thanks to the [Homebrew Website Club for their useful feedback](http://indiewebcamp.com/events/2016-05-04-homebrew-website-club) when I presented some of this last month.