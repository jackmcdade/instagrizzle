Instagrizzle - An Instagram Plugin for Statamic
===============================================

Fetch media from a public Instagram feed, without the need for the API. Yeah, it's a down and dirty scraping plugin.

**You probably shouldn't use this on an important website because it breaks every time Instagram changes their markup.**

## The Tag

```
{{ instagrizzle username="jackmcdade" limit="5" offset="1" }}
  <a href="{{ link }}">
    <img src="{{ image }}">
  </a>
{{ /instagrizzle }}
```
    
## The Parameters

### Username `username`

Instagram username of the feed you want to pull.

```
username="jackmcdade"
```

### Limit `limit`

Limit the items returned.
```
limit="5"
```

### Offset `offset`

Offset the items returned.
```
offset="1"
```

## Debugger

There are a lot of variables to access from the Instagram response object. You can use the debug tag to explore the data available to you.

```
{{ instagrizzle:debug username="jackmcdade" }}
```

## Config

There are currently two config options.

### Username `username`

Set the default username for the plugin across your whole site.

```yaml
username: jackmcdade
```

### Cache Length `cache_length`

Set how many seconds you would like to cache the Instagram response object. Default is 3600 (1 hour).

```yaml
cache_length: 3600
```

---
v2 Note: Instagram changed their redesign on June 9th, 2015, and the data available to Instagrizzle is more limited. I did my best to add backwards compatibility for the basic image data, but other than that, use the `{{ instagram:debug }}` tag to see what you have to work with, and God Speed. This is a dirty hacky solution to avoid API authentication.