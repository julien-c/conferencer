# Controllers

Conferencer exposes a few controllers to layout the routes of the application.

The public ones are :
- ArticlesController
- SpeakersController
- TalksController

And the administration ones are :
- AdminController
- ArticlesResource
- PartnersResource
- SpeakersResource
- TagsResource
- TalksResources

All *Resources* extend a base *BaseResource* class that maps out all the basic actions of a resource in the admin : listing existing entries, editing one, adding one, deleting one etc.

## Routes

Here is a schema of the routes mapped by Conferencer :

| Method   | URI                                            | Name                     | Action                                                      |
| -------- | ---------------------------------------------- | ------------------------ | ----------------------------------------------------------- |
| GET      | /                                              |                          | Closure                                                     |
| GET      | /admin                                         |                          | Conferencer\Controllers\Admin\AdminController@getIndex      |
| GET      | /admin/articles                                | admin.articles.index     | Conferencer\Controllers\Admin\ArticlesResource@index        |
| POST     | /admin/articles                                | admin.articles.store     | Conferencer\Controllers\Admin\ArticlesResource@store        |
| GET      | /admin/articles/create                         | admin.articles.create    | Conferencer\Controllers\Admin\ArticlesResource@create       |
| DELETE   | /admin/articles/{articles}                     | admin.articles.destroy   | Conferencer\Controllers\Admin\ArticlesResource@destroy      |
| GET      | /admin/articles/{articles}                     | admin.articles.show      | Conferencer\Controllers\Admin\ArticlesResource@show         |
| PATCH    | /admin/articles/{articles}                     |                          | Conferencer\Controllers\Admin\ArticlesResource@update       |
| PUT      | /admin/articles/{articles}                     | admin.articles.update    | Conferencer\Controllers\Admin\ArticlesResource@update       |
| GET      | /admin/articles/{articles}/edit                | admin.articles.edit      | Conferencer\Controllers\Admin\ArticlesResource@edit         |
| GET      | /admin/index                                   |                          | Conferencer\Controllers\Admin\AdminController@getIndex      |
| GET      | /admin/login                                   |                          | Conferencer\Controllers\Admin\AdminController@getLogin      |
| POST     | /admin/login                                   |                          | Conferencer\Controllers\Admin\AdminController@postLogin     |
| GET      | /admin/logout                                  |                          | Conferencer\Controllers\Admin\AdminController@getLogout     |
| GET      | /admin/partners                                | admin.partners.index     | Conferencer\Controllers\Admin\PartnersResource@index        |
| POST     | /admin/partners                                | admin.partners.store     | Conferencer\Controllers\Admin\PartnersResource@store        |
| GET      | /admin/partners/create                         | admin.partners.create    | Conferencer\Controllers\Admin\PartnersResource@create       |
| DELETE   | /admin/partners/{partners}                     | admin.partners.destroy   | Conferencer\Controllers\Admin\PartnersResource@destroy      |
| GET      | /admin/partners/{partners}                     | admin.partners.show      | Conferencer\Controllers\Admin\PartnersResource@show         |
| PATCH    | /admin/partners/{partners}                     |                          | Conferencer\Controllers\Admin\PartnersResource@update       |
| PUT      | /admin/partners/{partners}                     | admin.partners.update    | Conferencer\Controllers\Admin\PartnersResource@update       |
| GET      | /admin/partners/{partners}/edit                | admin.partners.edit      | Conferencer\Controllers\Admin\PartnersResource@edit         |
| GET      | /admin/speakers                                | admin.speakers.index     | Conferencer\Controllers\Admin\SpeakersResource@index        |
| POST     | /admin/speakers                                | admin.speakers.store     | Conferencer\Controllers\Admin\SpeakersResource@store        |
| GET      | /admin/speakers/create                         | admin.speakers.create    | Conferencer\Controllers\Admin\SpeakersResource@create       |
| DELETE   | /admin/speakers/{speakers}                     | admin.speakers.destroy   | Conferencer\Controllers\Admin\SpeakersResource@destroy      |
| GET      | /admin/speakers/{speakers}                     | admin.speakers.show      | Conferencer\Controllers\Admin\SpeakersResource@show         |
| PATCH    | /admin/speakers/{speakers}                     |                          | Conferencer\Controllers\Admin\SpeakersResource@update       |
| PUT      | /admin/speakers/{speakers}                     | admin.speakers.update    | Conferencer\Controllers\Admin\SpeakersResource@update       |
| GET      | /admin/speakers/{speakers}/edit                | admin.speakers.edit      | Conferencer\Controllers\Admin\SpeakersResource@edit         |
| GET      | /admin/tags                                    | admin.tags.index         | Conferencer\Controllers\Admin\TagsResource@index            |
| POST     | /admin/tags                                    | admin.tags.store         | Conferencer\Controllers\Admin\TagsResource@store            |
| GET      | /admin/tags/create                             | admin.tags.create        | Conferencer\Controllers\Admin\TagsResource@create           |
| DELETE   | /admin/tags/{tags}                             | admin.tags.destroy       | Conferencer\Controllers\Admin\TagsResource@destroy          |
| GET      | /admin/tags/{tags}                             | admin.tags.show          | Conferencer\Controllers\Admin\TagsResource@show             |
| PATCH    | /admin/tags/{tags}                             |                          | Conferencer\Controllers\Admin\TagsResource@update           |
| PUT      | /admin/tags/{tags}                             | admin.tags.update        | Conferencer\Controllers\Admin\TagsResource@update           |
| GET      | /admin/tags/{tags}/edit                        | admin.tags.edit          | Conferencer\Controllers\Admin\TagsResource@edit             |
| GET      | /admin/talks                                   | admin.talks.index        | Conferencer\Controllers\Admin\TalksResource@index           |
| POST     | /admin/talks                                   | admin.talks.store        | Conferencer\Controllers\Admin\TalksResource@store           |
| GET      | /admin/talks/create                            | admin.talks.create       | Conferencer\Controllers\Admin\TalksResource@create          |
| DELETE   | /admin/talks/{talks}                           | admin.talks.destroy      | Conferencer\Controllers\Admin\TalksResource@destroy         |
| GET      | /admin/talks/{talks}                           | admin.talks.show         | Conferencer\Controllers\Admin\TalksResource@show            |
| PATCH    | /admin/talks/{talks}                           |                          | Conferencer\Controllers\Admin\TalksResource@update          |
| PUT      | /admin/talks/{talks}                           | admin.talks.update       | Conferencer\Controllers\Admin\TalksResource@update          |
| GET      | /admin/talks/{talks}/edit                      | admin.talks.edit         | Conferencer\Controllers\Admin\TalksResource@edit            |
| GET      | /admin/talks/{talk}/add-speaker/{speaker}      |                          | Conferencer\Controllers\Admin\TalksResource@addSpeaker      |
| GET      | /admin/talks/{talk}/add-tag/{tag}              |                          | Conferencer\Controllers\Admin\TalksResource@addTag          |
| DELETE   | /admin/talks/{talk}/remove-speaker/{speaker}   |                          | Conferencer\Controllers\Admin\TalksResource@removeSpeaker   |
| DELETE   | /admin/talks/{talk}/remove-tag/{tag}           |                          | Conferencer\Controllers\Admin\TalksResource@removeTag       |
| GET      | /articles                                      |                          | Conferencer\Controllers\ArticlesController@getIndex         |
| GET      | /articles/archives/{date}                      |                          | Conferencer\Controllers\ArticlesController@getArchives      |
| GET      | /articles/article/{slug}                       |                          | Conferencer\Controllers\ArticlesController@getArticle       |
| GET      | /articles/index                                |                          | Conferencer\Controllers\ArticlesController@getIndex         |
| GET      | /partners                                      |                          | Closure                                                     |
| GET      | /speaker/{slug}                                |                          | Conferencer\Controllers\SpeakersController@getSpeaker       |
| GET      | /speakers                                      |                          | Conferencer\Controllers\SpeakersController@getIndex         |
| GET      | /speakers/index/{filter?}                      |                          | Conferencer\Controllers\SpeakersController@getIndex         |
| GET      | /speakers/speaker/{slug}                       |                          | Conferencer\Controllers\SpeakersController@getSpeaker       |
| GET      | /talks                                         |                          | Conferencer\Controllers\TalksController@getIndex            |
| GET      | /talks/index/{filter?}                         |                          | Conferencer\Controllers\TalksController@getIndex            |
| GET      | /talks/program-pdf/{year?}                     |                          | Conferencer\Controllers\TalksController@getProgramPdf       |
| GET      | /talks/program/{year?}/{day?}                  |                          | Conferencer\Controllers\TalksController@getProgram          |
| GET      | /talks/tag/{tag}                               |                          | Conferencer\Controllers\TalksController@getTag              |
| GET      | /talks/talk/{slug}                             |                          | Conferencer\Controllers\TalksController@getTalk             |

