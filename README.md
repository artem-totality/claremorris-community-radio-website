# CCR 94.6 — WordPress Theme

Custom WordPress theme developed for **Claremorris Community Radio (CCR 94.6 FM)**. The theme provides a modern frontend for the station website, including programme listings, live radio playback, schedule information, and supporter sections.

## Features

### 1. Custom Theme and Responsive Layout

- Custom `ccr946` theme developed independently of the legacy WordPress theme.
- Shared interface components, including the site header and navigation.
- Styling built around the Inter typeface and the theme's own CSS assets.
- Responsive layout designed for different screen sizes.
- A foundation for continued frontend development without relying on the previous theme's implementation.

### 2. Navigation and User Experience

- JavaScript-based partial navigation for internal pages, reducing the need for full document reloads.
- Browser history support, including Back and Forward navigation.
- Click handling that preserves normal browser behaviour for external links, downloads, links opened in a new tab, and administrative or login pages.
- Scroll-position handling during page transitions. Upon navigating to a new page, the content scrolls to the top.
- Reinitialisation of page-specific scripts after dynamically loading content.
- Audio-player state is designed to persist across supported internal navigation.
- Mobile navigation (hamburger menu) has been implemented; special attention is paid to minimizing the volume of CSS and JavaScript.

### 3. Live Radio Player

- Integration with the CCR live audio stream.
- Playback controls connected to the player state.
- Synchronisation of play-button labels and playback state.
- Support for keeping playback active while navigating between supported internal pages.

### 4. Shows and Presenters

- Custom post type for radio shows, using the `show` post type.
- Advanced Custom Fields (ACF) support for show information, including:
  - Genre
  - On-air days
  - Start and end times
  - Presenter name and role
  - Presenter avatar
- Show archive at `/show/` and a dedicated single-show template.
- Show cards use featured images where available, with a fallback presentation when an image is missing.

### 5. Schedule and On-Air Information

- Integration with Google Calendar API as the source of schedule events.
- A PHP synchronisation script imports schedule data into the WordPress database.
- Schedule events are stored locally in the `wp_schedule` table for use by the site.
- Scheduled synchronisation keeps the local schedule updated.
- Frontend scripts refresh on-air information periodically, supporting the display of the current and next programmes.
- The schedule and on-air components are designed to work with the site's Dublin-time configuration.

### 6. Funders, Sponsors, and Partners

- ACF-based content structure for supporter cards.
- Supporter categories:
  - Funders
  - Sponsors
  - Partners
- Cards are automatically grouped into their corresponding sections.
- Empty categories are hidden to avoid displaying blank sections.

## Summary

The `ccr946` theme brings the station's main website features together in a custom WordPress frontend. It combines responsive layouts, partial page navigation, live radio playback, structured show and presenter content, locally synchronised schedule data, and flexible supporter sections. The theme is designed to provide a maintainable foundation for further improvements to the station's website and user experience.

## Technologies

- WordPress
- PHP
- JavaScript
- CSS
- Advanced Custom Fields (ACF)
- Google Calendar API
