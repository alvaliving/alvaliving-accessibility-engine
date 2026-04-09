# Alvaliving Accessibility & SEO Engine

A high-performance, zero-footprint **Must-Use (MU) Plugin** for WordPress designed to fix common accessibility (WCAG) and SEO issues programmatically. 

Developed by **Alvaliving Studio**, this engine was created to achieve a perfect 100/100 score in Google Lighthouse audits without the overhead of heavy third-party plugins.

## Key Features

* **Automated Alt Text:** Generates clean, descriptive image alternative text from filenames during upload, improving both SEO and screen reader compatibility.
* **Viewport Optimization:** Forwards accessibility by enabling user-scaling (zoom) on mobile devices, overriding restrictive theme defaults.
* **Semantic Landmark Injection:** Automatically identifies content structures and wraps them in `<main>` landmarks for better Assistive Technology (AT) navigation.
* **Dynamic ARIA Labels:** Injects discernible names into empty lightbox links and provides semantic context to repetitive "Read More" links.
* **RGPD/GDPR Friendly:** 100% local processing. No external API calls or data sharing.

## Installation

1. Create a folder named `mu-plugins` inside your `/wp-content/` directory (if it doesn't exist).
2. Upload the `alvaliving-accessibility-engine.php` file to that folder.
3. The plugin will be activated automatically.

## Performance Impact
Since this is an MU-Plugin, it loads before the standard plugin stack, ensuring the smallest possible footprint on server response time (TTFB).

---
*A project by [Alvaliving Studio](https://alvaliving.com)*
