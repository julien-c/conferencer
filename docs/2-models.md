# Models

The models provided by Conferencer are the following :

- Article : an article of news
- Partner : a partner or sponsor for the conference
- Speaker : a speaker to a talk
- Tag : a tag/category to bind on talks
- Talk : the conference's talks

## Methods and attributes

All models share a few common methods and/or attributes :

### Common attributes

- id
- name
- created_at
- updated_at

### Common methods

- If the model has a _slug_ attribute, it will automatically be set and updated when the _name_ is
- The dates use Carbon, a DateTime superset, so you can do `$talk->created_at->format('H:i:s')`
- All models have a static `slugOrFail` helper that matches the `findOrFail` method but with the _slug_
- Models implement the Illuminage package that allows the creation and caching of thumbnails, `$talk->thumb(200, 300)`

### Model-specific methods

- `Speaker->relatedSpeakers()` returns all the Speakers that shared Talks with this Speaker
- `Talk->relatedTalks()` returns all the Talks happening the same day
- `Talk->hasYoutubePlaylist` returns a boolean of if the Youtube video provided is a playlist or a video
- `Talk->interestingLinks` returns an array of url/title link pairs from the `interesting_links` field
- `Talk::whereYear(year)` scopes the query to the Talks of a year
- `Talk::whereDay(day)` scopes the query to the Talks of a day
- `Talk::latest()` orders the query by latest Talk happening first

## Entity, Service and Repository

Some of the models have Services or Repository classes :

**Articles**

- `Article\Repository::getCalendar` returns a multidimensional array of the articles in the form of `array[YEAR][MONTH][DAY][ARTICLE]`

**Speakers**

- `Speaker\Services::getFiltered(filter)` returns a filtered array of all the speakers according to predefined filters

**Talks**

- `Talk\Services::getFiltered(filter)` is the same thing as above but for Talks
- `Talk\Repository::forHomepage` returns the Talks that are defined to be on the homepage
- `Talk\Repository::getProgram(year)` returns an array in the form of `array[YEAR-MONTH-DAY][ID][TALK]`
- `Talk\Repository::getYears` returns an array of years for which Talks exist
- `Talk\Repository::getDays(year)` is the same thing as above but for the days of a year
- `Talk\Repository::sanitizeYear(year)` checks if Talk exist for a year, and if not, return the latest year in the database
- `Talk\Repository::sanitizeDay(year, day)` is the same thing as above but for days