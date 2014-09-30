Instagrizzle - An Instagram Plugin for Statamic
===============================================

Fetch media from a public Instagram feed, without the need for the API. Yeah, it's a down and dirty scraping plugin. Enjoy!

## The Tag

```
{{ instagrizzle }}
  <img src="{{ images:high_resolution:url }}">
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

There are a lot of variables to access from the Instagram response object. You can use `{{ instagrizzle:debug }}` to explore the data available to you.

## Config

There are currently two config options.

### Username `username`

Set the default username for the plugin across your whole site.

```yaml
username: jackmcdade
```

### Cache Length `cache_length`

Set how many seconds you would like to cache the Instagram response object. Default is 3600 (1 hour).