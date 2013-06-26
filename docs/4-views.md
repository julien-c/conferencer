# Views

A lot of views are provided by default with Conferencer, there are three kind of views :

- Layouts
- Partials
- Pages

All views can be overridden by the application using Conferencer by simply creating a view of the same name. The package will always look first for an user view, before relying on it's own.

## Layouts

### Global

At the core there is a basic layout called `global.blade.php` that all layouts extend. The core layouts as few hooks but these can be used to create new layouts :

- **title**
- **classes**
- **layout**

As well as two `css` and `js` sections that can be extended on a per-page basis.

### Layouts

From there you have two layouts, excluding the administration one : a layout with a sidebar, and one in unicol. These layouts have three hooks :

- **container-before**
- **content**, where most of your pages will be
- **container-after**

## Partials

A few partials are provided :

- **404**, a 404 page
- **grid-speaker**, a Speaker in a grid
- **grid-talk**, a Talk in a grid
- **partners** the core code of the Partners page
- **talk-youtube**, a partial with a Youtube embed code
- **talks**, a list of talks with thumbnails
- **timeline-controls**, controls for a timeline navigation (seen on some of the pages)

## Pages

Those are pages used by the various routes predefined, and most actually match the route they're presenting. These pages can be overridden as well.

- **articles/article**, a single Article
- **articles/articles**, all Articles
- **speakers/speaker**, a single Speaker
- **speakers/speakers**, all Speakers
- **talks/program**, Talks as a program
- **talks/program-pdf**, Talks as a PDF program
- **talks/talk**, a single Talk